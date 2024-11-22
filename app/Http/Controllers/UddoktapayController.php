<?php

namespace App\Http\Controllers;

use App\Library\UddoktaPay;
use App\Models\Domain;
use App\Models\Order;
use App\Models\PaymentHistory;

use App\Models\RenewDomain;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UddoktapayController extends Controller {

    public function pay( Request $request) {

        $apiKey = config('uddoktapay.api_key');
        $apiBaseURL = config('uddoktapay.api_url');
        $uddoktaPay = new UddoktaPay($apiKey, $apiBaseURL);

        // dd($uddoktaPay);
        $amount = $request->input('total');

//        dd($amount);
        $type = session('type');
        //dd($type);

        $invoice = session('invoice');
//        dd($invoice);
//        $user = User::find($userid);
//        dd(Auth::user()->user_id);


        $requestData = [
            'full_name' => Auth::user()->name, // Replace with actual user name
            'email' => Auth::user()->email, // Replace with actual user email
            'amount' => $amount,
            'metadata' => [
                'invoice_id' => $invoice,
                'user_id' => Auth::user()->user_id,
            ],
            'redirect_url' => route('uddoktapay.success'), // add your success route
            'return_type' => 'GET',
            'cancel_url' => route('uddoktapay.cancel'), // add your cancel route
            'webhook_url' => route('uddoktapay.webhook'), // add your ipn route
        ];
//        dd($requestData);

            try{

            $paymentUrl = $uddoktaPay->initPayment($requestData);
            return redirect($paymentUrl);

            }

            catch (\Exception $e)
            {
                dd($e->getMessage());
            }
            // dd($paymentUrl);


    }

    /**
     * Reponse from sever
     *
     * @param Request $request
     * @return void
     */
    public function webhook(Request $request) {
        $headerApi = isset($_SERVER['RT_UDDOKTAPAY_API_KEY']) ? $_SERVER['RT_UDDOKTAPAY_API_KEY'] : null;

        if ($headerApi == null) {
            return response("Api key not found", 403);
        }

        if ($headerApi != config('uddoktapay.api_key')) {
            return response("Unauthorized Action", 403);
        }

        $data = $request->all();
        $invoiceId = $data['metadata']['invoice_id'];
        $transactionId = $data['transaction_id'];
        $paymentMethod = $data['payment_method'];

        // Use the invoice ID to update the order status
        Order::where('invoice_id', $invoiceId)->update([
            'payment_method' => $paymentMethod,
            'order_status' => 'Processing',
            'transaction_id' => $transactionId,
        ]);

        return response('Database Updated', 200);
    }

    public function success(Request $request) {
        $invoiceId = $request->invoice_id;
        $type = session('type');
        $amount = session('amount');
        $invoice = session('invoice');
        $domainid = session('domain_id');
        $registerDate = Carbon::now('Asia/Dhaka')->format('Y-m-d');
        $now = Carbon::now('Asia/Dhaka');
        $domainid = session('domain_id');
        $date = Domain::where('domain_id',$domainid)->first();

        if ($type == 'renew'){
            if ($date) {
                $renew = $now->addMonths($date->expiration_months)->format('Y-m-d');
            } else {
                $renew = null;
            }
        }
        else {
            if ($date) {
                $expireAt = $now->addMonths($date->expiration_months)->format('Y-m-d');
            } else {
                $expireAt = null;
            }
        }

        try{
        $apiKey = config('uddoktapay.api_key');
        $apiBaseURL = config('uddoktapay.api_url');
        $uddoktaPay = new UddoktaPay($apiKey, $apiBaseURL);

        $response = $uddoktaPay->verifyPayment($invoiceId);
        } catch (\Exception $e)
        {
            dd($e->getMessage());
        }


        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            if ($type == 'renew'){
                $order = RenewDomain::create([
                    'order_id' => $invoice,
                    'customer_id' => Auth::user()->user_id,
                    'domain_id' => $domainid,
                    'register_date' => $registerDate,
                    'expire_date' => $renew,
                    'domain_type' => $type,
                    'price' => $amount,
                    'status' => 'In Progress',

                ]);

                $payment = PaymentHistory::create([
                    'payment_id' => $request->invoice_id,
                    'renew_order_table' => $invoice,
                    'amount' => $amount,
                    'fee' => $response['fee'],
                    'charged_amount' => $response['charged_amount'],
                    'payment_method' => $response['payment_method'],
                    'sender_number' => $response['sender_number'],
                    'transaction_id' => $response['transaction_id'],
                    'date' => $response['date'],
                    'status' => $response['status'],
                ]);

                $order->update(['payment_id' => $payment->payment_id]);
            }

            else {
                $order = Order::create([
                    'order_id' => $invoice,
                    'customer_id' => Auth::user()->user_id,
                    'domain_id' => $domainid,
                    'register_date' => $registerDate,
                    'expire_date' => $expireAt,
                    'domain_type' => $type,
                    'price' => $amount,
                    'status' => 'In Progress',

                ]);

                $payment = PaymentHistory::create([
                    'payment_id' => $request->invoice_id,
                    'order_id' => $invoice,
                    'amount' => $amount,
                    'fee' => $response['fee'],
                    'charged_amount' => $response['charged_amount'],
                    'payment_method' => $response['payment_method'],
                    'sender_number' => $response['sender_number'],
                    'transaction_id' => $response['transaction_id'],
                    'date' => $response['date'],
                    'status' => $response['status'],
                ]);

                $order->update(['payment_id' => $payment->payment_id]);
            }
//            dd($response['metadata']['invoice_id']);
            $invoice = $response['metadata']['invoice_id'];
//            dd($invoice);
            return redirect()->route('order.invoice',['id'=>$invoice]);
        } else {
            return 'Payment verification failed.';
        }
    }

    public function invoice($id)
    {
        $type = session('type');
        if ($type == 'renew'){
            $order = RenewDomain::where('renew_domains.order_id',$id)
                ->join('domains','domains.domain_id','=','renew_domains.domain_id')
                ->join('company_infos','company_infos.user_id','=','renew_domains.customer_id')
                ->join('payment_histories','payment_histories.renew_order_table','=','renew_domains.order_id')
                ->first();
            return view('user.invoice',['order'=>$order]);
        }
        else {
            $order = Order::where('orders.order_id', $id)
                ->join('domains', 'domains.domain_id', '=', 'orders.domain_id')
                ->join('company_infos', 'company_infos.user_id', '=', 'orders.customer_id')
                ->join('payment_histories', 'payment_histories.order_id', '=', 'orders.order_id')
                ->first();
            return view('user.invoice', ['order' => $order]);
        }
    }

    /**
     * Cancel URL
     *
     * @return void
     */
    public function cancel() {
        return 'Payment is cancelled.';
    }

}

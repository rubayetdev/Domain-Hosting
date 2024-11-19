<?php

namespace App\Http\Controllers;

use App\Library\UddoktaPay;
use App\Models\Domain;
use App\Models\Order;
use App\Models\PaymentInfo;
use App\Models\Test;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UddoktapayController extends Controller {



//    public function insertPayment(Request $request)
//    {
//
//        $userid = $request->input('id');
//        $shipping = $request->input('address');
//        $projectid = $request->input('city');
//        $projectname = $request->input('zip');
//        $service = $request->input('paymentBkash');
//        $amount = $request->input('total');
//        $order = $request->input('paymentCOD');
//        $invoice = rand(1000,9999);
//
//        $request->session()->put('id', $userid);
////        $request->session()->put('project_id', $projectid);
//        $request->session()->put('invoice',$invoice);
//
//        if ($order) {
//            Order::where('user_id', $userid)->where('order_status', 'Pending')->update([
//                'invoice_id' => $invoice,
//                'order_status' => 'Processing',
//                'payment_method' => 'COD',
//                'shipping_address' => $shipping,
//                'shipping_city' => $projectid,
//                'zip_code' => $projectname,
//            ]);
//
//            return redirect()->back();
//        }
//
//        elseif ($service) {
//
//            Order::where('user_id', $userid)->where('order_status', 'Pending')->update([
//                'invoice_id' => $invoice,
//
//
//                'shipping_address' => $shipping,
//                'shipping_city' => $projectid,
//                'zip_code' => $projectname,
//            ]);
//
//
//            return $this->pay($request);
//        }
//    }

    // public function show() {
    //     $amount = \request('amounts');
    //     return view( 'uddoktapay.payment-form',['amount'=>$amount]);
    // }




    public function pay( Request $request) {

        $apiKey = config('uddoktapay.api_key');
        $apiBaseURL = config('uddoktapay.api_url');
        $uddoktaPay = new UddoktaPay($apiKey, $apiBaseURL);

        // dd($uddoktaPay);
        $amount = $request->input('total');

//        dd($amount);
        $type = session('type');

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
        $now = Carbon::now('Asia/Dhaka');
        $domainid = session('domain_id');
        $date = Domain::where('domain_id',$domainid)->first();

        if ($date) {

            $expireAt = $now->addMonths($date->expiration_months)->format('Y-m-d');
//            dd($expireAt);
        } else {
            $expireAt = null; // Handle case where no domain is found
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
            // Update order status based on the invoice ID
            Order::create([
                'order_id'=> $invoice,
                'customer_id'=>Auth::user()->user_id,
                'domain_id'=>$domainid,
                'register_date'=>$now->format('Y-m-d'),
                'expire_date'=>$expireAt,
                'domain_type'=>$type,
                'price'=>$amount,
                'status'=>'In Progress'
            ]);

            PaymentInfo::create([
                'payment_id'=>$request->invoice_id,
                'order_id'=>$invoice,
                'amount'=>$amount,
                'fee'=>$response['fee'],
                'charged_amount'=>$response['charged_amount'],
                'payment_method'=>$response['payment_method'],
                'sender_number'=>$response['sender_number'],
                'transaction_id'=>$response['transaction_id'],
                'date'=>$response['date'],
                'status'=>$response['status'],
//                'message'=>$response['message']
            ]);
//            dd($response['metadata']['invoice_id']);
            $invoice = $response['metadata']['invoice_id'];
//            dd($invoice);
            return redirect()->route('dashboard');
        } else {
            return 'Payment verification failed.';
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

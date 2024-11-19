<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" media="all" />
</head>

<body>
<div>
    <div class="py-4">
        <div class="px-14 py-6">
            <table class="w-full border-collapse border-spacing-0">
                <tbody>
                <tr>
                    <td class="w-full align-top">
                        <a href="{{ route('dashboard') }}">
                            <div>
                                <img src="{{asset('Asset 1.svg')}}" class="h-12" />
                            </div>
                        </a>
                    </td>

                    <td class="align-top">
                        <div class="text-sm">
                            <table class="border-collapse border-spacing-0">
                                <tbody>
                                <tr>
                                    <td class="border-r pr-4">
                                        <div>
                                            <p class="whitespace-nowrap text-slate-400 text-right">Date</p>
                                            <p class="whitespace-nowrap font-bold text-main text-right">{{ \Carbon\Carbon::now('Asia/Dhaka')->format('F j, Y') }}</p>
                                        </div>
                                    </td>
                                    <td class="pl-4">
                                        <div>
                                            <p class="whitespace-nowrap text-slate-400 text-right">Invoice #</p>
                                            <p class="whitespace-nowrap font-bold text-main text-right">{{$order->order_id}}</p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-slate-100 px-14 py-6 text-sm">
            <table class="w-full border-collapse border-spacing-0">
                <tbody>
                <tr>
                    <td class="w-1/2 align-top">
                        <div class="text-sm text-neutral-600">
                            <p class="font-bold">Supplier Company INC</p>
                            <p>{{config('app.name')}}</p>
                            <p>{{env('ADMIN_GMAIL')}}</p>
                            <p>{{env('ADMIN_PHONE')}}</p>
                            <p>{{env('ADMIN_ADDRESS')}}</p>
                            <p>Bangladesh</p>
                        </div>
                    </td>
                    <td class="w-1/2 align-top text-right">
                        <div class="text-sm text-neutral-600">
                            <p class="font-bold">Customer Company</p>
                            <p>{{Auth::user()->companyInfo->companyName}}</p>
                            <p>{{Auth::user()->companyInfo->companyEmail}}</p>
                            <p>{{Auth::user()->companyInfo->phone}}</p>
                            <p>{{Auth::user()->companyInfo->city}}-{{Auth::user()->companyInfo->postal_code}}</p>
                            <p>{{Auth::user()->companyInfo->country}}</p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="px-14 py-10 text-sm text-neutral-700">
            <table class="w-full border-collapse border-spacing-0">
                <thead>
                <tr>
                    <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">#</td>
                    <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Domain Name</td>
                    <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Type</td>
                    <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Fee</td>
                    <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Price</td>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="border-b py-3 pl-3">1.</td>
                    <td class="border-b py-3 pl-2">{{$order->domain_name}}</td>
                    <td class="border-b py-3 pl-2 text-center">{{$order->domain_type}}</td>
                    <td class="border-b py-3 pl-2 text-right">{{$order->fee}}</td>
                    <td class="border-b py-3 pl-2 text-right">{{$order->price}}</td>

                </tr>
                </tbody>
            </table>
        </div>

        <div class="px-14 text-sm text-neutral-700">
            <p class="text-main font-bold">PAYMENT DETAILS</p>
            <p>Payment By: {{$order->payment_method}}</p>
            <p>Transaction Id: {{$order->transaction_id}}</p>
            <p>Account Number: {{$order->sender_number}}</p>
            <p>Payment Reference: {{$order->payment_id}}</p>
        </div>

        <div class="px-14 py-10 text-sm text-neutral-700">
            <p class="text-main font-bold">Notes</p>
            <p class="italic">
                Thank you for your business! This invoice serves as a confirmation of your recent purchase.
                Please review the details below and keep a copy for your records. If you have any questions,
                feel free to contact us.
            </p>
        </div>


            <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
                {{config('app.name')}}
                <span class="text-slate-300 px-2">|</span>
                {{env('ADMIN_GMAIL')}}
                <span class="text-slate-300 px-2">|</span>
                {{env('ADMIN_PHONE')}}
            </footer>
        </div>
    </div>
</body>

</html>

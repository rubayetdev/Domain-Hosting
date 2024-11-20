@extends('app')

@section('title','Dashboard')

@section('content')

    <main class="content">
        <h1>
            All Domain List
        </h1>
        <table class="table table-hover my-0">
            <thead>
            <tr>
                <th>Domain</th>
                <th class="d-none d-xl-table-cell">Registration Date</th>
                <th class="d-none d-xl-table-cell">Expired Date</th>
                <th>Status/Manage Domain</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->domain_name}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->register_date}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->expire_date}}</td>
                    <td>
                        @if($order->expire_date !== \Carbon\Carbon::today()->format('Y-m-d'))
                            <form action="{{ route('pay') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="type" value="renew">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="domain_id" value="{{ $order->domain_id }}">
                                <input type="hidden" name="amount" value="
                                    @if($order->domain_type == 'registration' || $order->domain_type == 'transfer')
                                        {{$order->domain_renew_price}}
                                    @else
                                        {{$order->reseller_domain_renew_price}}
                                    @endif
                                ">
                                <button type="submit" class="btn btn-danger">
                                    Renew Domain At
                                    @if($order->domain_type == 'registration' || $order->domain_type == 'transfer')
                                        {{$order->domain_renew_price}}
                                    @else
                                        {{$order->reseller_domain_renew_price}}
                                    @endif
                                </button>
                            </form>
                        @endif
                    </td>

                </tr>

            @endforeach
            </tbody>
        </table>
    </main>

@endsection


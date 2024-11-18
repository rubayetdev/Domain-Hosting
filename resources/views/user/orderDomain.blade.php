@extends('app')

@section('title','All Domains')

@section('content')
    <main class="content">
        <h1 >All Domain List</h1>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-hover my-0">
                            <thead>
                            <tr>
                                <th>Domain</th>
                                <th>Price</th>
                                <th>Expire Date</th>
                                <th>Transfer Price</th>
                                <th>Renew Price</th>
                                <th>Reseller Price</th>
                                <th>Reseller Transfer Price</th>
                                <th>Reseller Renew Price</th>
                                <th>Order Now</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($domains as $domain)
                                <tr>
                                    <td><strong>{{$domain->domain_name}}</strong></td>
                                    <td>৳ {{$domain->domain_price}}</td>
                                    <td>
                                        @php
                                            if ($domain->expiration_months % 12 === 0) {
                                                $years = $domain->expiration_months / 12;
                                                $expiration = $years . ' ' . ($years === 1 ? 'Year' : 'Years');
                                            } else {
                                                $months = $domain->expiration_months;
                                                $expiration = $months . ' ' . ($months === 1 ? 'Month' : 'Months');
                                            }
                                        @endphp
                                        {{ $expiration }}
                                    </td>
                                    <td>৳ {{$domain->domain_transfer_price}}</td>
                                    <td>৳ {{$domain->domain_renew_price}}</td>
                                    <td>৳ {{$domain->reseller_domain_price}}</td>
                                    <td>৳ {{$domain->reseller_domain_transfer_price}}</td>
                                    <td>৳ {{$domain->reseller_domain_renew_price}}</td>
                                    <td>
                                        <a href="{{ route('order.show',['id'=>$domain->id]) }}" class="btn btn-primary">Order</a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

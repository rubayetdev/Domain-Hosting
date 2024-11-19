@extends('app2')

@section('title','Dashboard')

@section('content')

    <main class="content">
        <h1>
            Order List
        </h1>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-hover my-0">
            <thead>
            <tr>
                <th>Domain</th>
                <th class="d-none d-xl-table-cell">Registration Date</th>
                <th class="d-none d-xl-table-cell">Expired Date</th>
                <th>Price</th>
                <th>Status/Manage Domain</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $orders)
            <tr>
                <td>{{$orders->domain_name}}</td>
                <td class="d-none d-xl-table-cell">{{$orders->register_date}}</td>
                <td class="d-none d-xl-table-cell">{{$orders->expire_date}}</td>
                <td>{{$orders->price}}</td>
                <td>
                    <a href="{{ route('admin.domain.manage',['id'=>$orders->id]) }}" class="btn btn-primary">Manage Domain</a>
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

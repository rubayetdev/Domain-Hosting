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
                    @if($order->status == 'In Progress')
                        <span class="badge bg-warning">In progress</span>
                    @else
                        <a href="{{ route('domainManage',['id'=>$order->id]) }}" class="btn btn-primary">Manage Domain</a>
                    @endif

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </main>

@endsection

@extends('app2')

@section('title','Dashboard')

@section('content')

    <main class="content">
        <h1>
            Order List
        </h1>

        <table class="table table-hover my-0">
            <thead>
            <tr>
                <th>Domain</th>
                <th class="d-none d-xl-table-cell">Registration Date</th>
                <th class="d-none d-xl-table-cell">Expired Date</th>
                <th>Price</th>
                <th>Payment Status</th>
                <th>Status/Manage Domain</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Hi</td>
                <td class="d-none d-xl-table-cell">Nov 17, 2024</td>
                <td class="d-none d-xl-table-cell">Nov 17, 2024</td>
                <td>$1000</td>
                <td>
                    <span class="badge bg-success">Done</span>
                </td>
                <td>
                    <a href="" class="btn btn-primary">Manage Domain</a>
                    <span class="badge bg-warning">In progress</span>
                </td>
            </tr>
            </tbody>
        </table>
    </main>
@endsection

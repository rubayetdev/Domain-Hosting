@extends('app2')

@section('title','All Customers')

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
                                <th>User Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Company Name</th>
                                <th>Company Email</th>
                                <th>Logo</th>
                                <th>Phone</th>
                                <th>WhatsApp</th>
                                <th>City</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $users)
                                <tr>
                                    <td>{{$users->user_id}}</td>
                                    <td>{{$users->fname}} {{$users->lname}}</td>
                                    <td>{{$users->email}}</td>
                                    <td>{{$users->companyName}}</td>
                                    <td>{{$users->companyEmail}}</td>
                                    <td>
                                        <img src="{{asset('storage/'.$users->companyLogo)}}" style="width: 50px; height: auto; border-radius: 50%"/>
                                    </td>
                                    <td>{{$users->phone}}</td>
                                    <td>{{$users->wpNumber}}</td>
                                    <td>{{$users->city}}</td>
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

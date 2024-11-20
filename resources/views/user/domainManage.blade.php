@extends('app')

@section('title','Manage Domain')

@section('content')
    <main class="content py-5">
        <div class="container">
            <h1 class="mb-4 text-center">Manage Domain</h1>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{route('manageDomain')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="domainName" class="form-label">Order No.</label>
                                            <input type="text" id="domainName1" name="orderno" class="form-control mb-2" value="{{$domain->order_id}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="domainName" class="form-label">Customer No.</label>
                                            <input type="text" id="domainName4" name="customerno" class="form-control mb-2" value="{{$domain->customer_id}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="domainName" class="form-label">Nameserver</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" id="domainName1" name="domain1" class="form-control mb-2" value="@if(isset($check->ns1)) {{$check->ns1}} @endif" placeholder="Enter Nameserver 1">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="domainName2" name="domain2" class="form-control mb-2" value="@if(isset($check->ns2)) {{$check->ns2}} @endif" placeholder="Enter Nameserver 2">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="domainName3" name="domain3" class="form-control mb-2" value="@if(isset($check->ns3)) {{$check->ns3}} @endif" placeholder="Enter Nameserver 3">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="domainName4" name="domain4" class="form-control mb-2" value="@if(isset($check->ns4)) {{$check->ns4}} @endif" placeholder="Enter Nameserver 4">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="epp_code">Epp Code</label>
                                    <textarea class="form-control" name="epp_code" readonly>@if(isset($check->eppcode)){{$check->eppcode}}@endif</textarea>
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

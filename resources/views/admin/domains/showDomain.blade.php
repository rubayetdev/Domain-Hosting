@extends('app2')

@section('title','Edit Domain'." ".$domain->domain_name)

@section('content')
    <main class="content py-5">
        <div class="container">
            <h1 class="mb-4 text-center">Edit Domain Details of <strong>{{$domain->domain_name}}</strong></h1>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-12">
                    <div class="card shadow-sm">
{{--                        <div class="card-header bg-primary text-white">--}}
{{--                            <h5 class="mb-0">Domain Information</h5>--}}
{{--                        </div>--}}
                        <div class="card-body">
                            <form action="{{route('admin.domain.update',['id'=>$domain->id])}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="domainName" class="form-label">Domain Name</label>
                                    <input type="text" id="domainName" name="domain" class="form-control" value="{{$domain->domain_name}}" placeholder="Enter domain name">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Domain Price</label>
                                    <input type="number" id="domainDetails" name="price" class="form-control" value="{{$domain->domain_price}}" placeholder="Enter domain price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Domain Transfer Price</label>
                                    <input type="number" id="domainDetails" name="tprice" class="form-control" value="{{$domain->domain_transfer_price}}" placeholder="Enter domain transfer price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Domain Renew Price</label>
                                    <input type="number" id="domainDetails" name="rprice" class="form-control" value="{{$domain->domain_renew_price}}" placeholder="Enter domain renew price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Reseller Domain Price</label>
                                    <input type="number" id="domainDetails" name="rdprice" class="form-control" value="{{$domain->reseller_domain_price}}" placeholder="Enter reseller domain price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Reseller Domain Transfer Price</label>
                                    <input type="number" id="domainDetails" name="rtprice" class="form-control" value="{{$domain->reseller_domain_transfer_price}}" placeholder="Enter reseller domain transfer price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Reseller Domain Renew Price</label>
                                    <input type="number" id="domainDetails" name="rdrprice" class="form-control" value="{{$domain->reseller_domain_renew_price}}" placeholder="Enter reseller domain renew price">
                                </div>
                                <div class="mb-3">
                                    <label for="expirationNumber" class="form-label">Expiration Period</label>
                                    <div class="input-group">
                                        <input type="number" id="expirationNumber" name="expiration_number" class="form-control" placeholder="Enter number (e.g., 1, 6)">
                                        <select id="expirationUnit" name="expiration_unit" class="form-select">
                                            <option value="month">Month(s)</option>
                                            <option value="year">Year(s)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('admin.domain.store') }}" class="btn btn-info">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

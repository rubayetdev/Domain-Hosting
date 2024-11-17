@extends('app2')

@section('title','Add Domain')

@section('content')
    <main class="content py-5">
        <div class="container">
            <h1 class="mb-4 text-center">Add Domain</h1>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Domain Information</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="domainName" class="form-label">Domain Name</label>
                                    <input type="text" id="domainName" class="form-control" placeholder="Enter domain name">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Domain Price</label>
                                    <input type="number" id="domainDetails" class="form-control" placeholder="Enter domain price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Domain Transfer Price</label>
                                    <input type="number" id="domainDetails" class="form-control" placeholder="Enter domain transfer price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Domain Renew Price</label>
                                    <input type="number" id="domainDetails" class="form-control" placeholder="Enter domain renew price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Reseller Domain Price</label>
                                    <input type="number" id="domainDetails" class="form-control" placeholder="Enter reseller domain price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Reseller Domain Transfer Price</label>
                                    <input type="number" id="domainDetails" class="form-control" placeholder="Enter reseller domain transfer price">
                                </div>
                                <div class="mb-3">
                                    <label for="domainDetails" class="form-label">Reseller Domain Renew Price</label>
                                    <input type="number" id="domainDetails" class="form-control" placeholder="Enter reseller domain renew price">
                                </div>
                                <div class="text-center">
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

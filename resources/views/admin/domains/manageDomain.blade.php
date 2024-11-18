@extends('app2')

@section('title','Manage Domain')

@section('content')
    <main class="content py-5">
        <div class="container">
            <h1 class="mb-4 text-center">Manage Domain</h1>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{route('admin.domain.create')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="domainName" class="form-label">Nameserver</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" id="domainName1" name="domain[]" class="form-control mb-2" placeholder="Enter Nameserver 1">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="domainName2" name="domain[]" class="form-control mb-2" placeholder="Enter Nameserver 2">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="domainName3" name="domain[]" class="form-control mb-2" placeholder="Enter Nameserver 3">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="domainName4" name="domain[]" class="form-control mb-2" placeholder="Enter Nameserver 4">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="registrationLock" class="form-label">Registration Lock</label>
                                    <div class="form-check form-switch">
                                        <input
                                            class="form-check-input toggle-switch"
                                            type="checkbox"
                                            id="registrationLock"
                                            name="registration_lock"
                                            value="1">
                                        <label class="form-check-label" for="registrationLock">On/Off</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="epp_code">Epp Code</label>
                                    <textarea class="form-control" id="epp_code" name="epp_code" rows="5" placeholder="Write your code here"></textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Your Code</label>
                                    <pre><code id="codeDisplay" class="language-javascript"></code></pre>

                                    <button type="button" class="btn btn-primary" id="copyButton">Copy Code</button>
                                </div>




                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

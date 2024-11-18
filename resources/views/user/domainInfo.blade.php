@extends('app')

@section('title','All Domains')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Domain Information</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Domain Info: <strong>{{ $domains->domain_name }}</strong></h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Domain Name:</strong> {{ $domains->domain_name }}</p>
                            <p><strong>Domain Price:</strong> ৳ {{ $domains->domain_price }}</p>
                            <p><strong>Expiration Duration:</strong>
                                @php
                                    if ($domains->expiration_months % 12 === 0) {
                                        $years = $domains->expiration_months / 12;
                                        $expiration = $years . ' ' . ($years === 1 ? 'Year' : 'Years');
                                    } else {
                                        $months = $domains->expiration_months;
                                        $expiration = $months . ' ' . ($months === 1 ? 'Month' : 'Months');
                                    }
                                @endphp
                                {{ $expiration }}
                            </p>
                            <p><strong>Expiration Date:</strong>
                                @php
                                    $registerDate = \Carbon\Carbon::now();
                                    $expireDate = $registerDate->addMonths($domains->expiration_months);
                                @endphp
                                {{ $expireDate->format('F j, Y') }}
                            </p>
                            <p><strong>Domain Transfer Price:</strong> ৳ {{ $domains->domain_transfer_price }}</p>
                            <p><strong>Domain Renew Price:</strong> ৳ {{ $domains->domain_renew_price }}</p>
                            <p><strong>Reseller Domain Price:</strong> ৳ {{ $domains->reseller_domain_price }}</p>
                            <p><strong>Reseller Domain Transfer Price:</strong> ৳ {{ $domains->reseller_domain_transfer_price }}</p>
                            <p><strong>Reseller Domain Renew Price:</strong> ৳ {{ $domains->reseller_domain_renew_price }}</p>

                            <!-- Payment Options -->
                            <div class="mt-4">
                                <h5 class="text-center mb-3">Choose Payment Option</h5>
                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    <!-- Domain Registration -->
                                    <form action="{{ route('order.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="type" value="registration">
                                        <input type="hidden" name="amount" value="{{ $domains->domain_price }}">
                                        <button type="submit" class="btn btn-primary">Pay for Domain Registration</button>
                                    </form>

                                    <!-- Domain Transfer -->
                                    <form action="{{ route('order.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="type" value="transfer">
                                        <input type="hidden" name="amount" value="{{ $domains->domain_transfer_price }}">
                                        <button type="submit" class="btn btn-secondary">Pay for Domain Transfer</button>
                                    </form>

                                    <!-- Reseller Domain -->
                                    <form action="{{ route('order.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="type" value="reseller_registration">
                                        <input type="hidden" name="amount" value="{{ $domains->reseller_domain_price }}">
                                        <button type="submit" class="btn btn-success">Pay for Reseller Domain</button>
                                    </form>

                                    <!-- Reseller Transfer -->
                                    <form action="{{ route('order.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="type" value="reseller_transfer">
                                        <input type="hidden" name="amount" value="{{ $domains->reseller_domain_transfer_price }}">
                                        <button type="submit" class="btn btn-warning">Pay for Reseller Transfer</button>
                                    </form>
                                    <a href="{{ route('order') }}" class="btn btn-info">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

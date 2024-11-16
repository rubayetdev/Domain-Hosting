@extends('app')

@section('title','Profile')

@section('content')

    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Profile</h1>
            </div>
            <div class="row">
                <!-- Profile Card -->
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Details</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ Auth::user()->companyInfo->companyLogo ? asset('storage/' . Auth::user()->companyInfo->companyLogo) : asset('default-avatar.png') }}"
                                 alt="{{ Auth::user()->name }}"
                                 class="img-fluid rounded-circle mb-2"
                                 width="128" height="128" />
                            <h5 class="card-title mb-0">{{ Auth::user()->companyInfo->fname }} {{ Auth::user()->companyInfo->lname }}</h5>
                            <div class="text-muted mb-2">{{ Auth::user()->companyInfo->companyName }}</div>

                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">Contact</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><span data-feather="mail"></span> {{ Auth::user()->email }}</li>
                                <li class="mb-1"><span data-feather="phone"></span> {{ Auth::user()->companyInfo->phone ?? 'N/A' }}</li>
                                <li class="mb-1"><span data-feather="map-pin"></span> {{ Auth::user()->companyInfo->city ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Profile Management -->
                <div class="col-md-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Manage Profile</h5>
                        </div>
                        <div class="card-body">
                            <!-- Profile Update Form -->
                            <form action="{{route('profile.update',['id'=>Auth::user()->user_id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="fname" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                               value="{{ Auth::user()->companyInfo->fname }}" required>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="lname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname"
                                               value="{{ Auth::user()->companyInfo->lname }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ Auth::user()->email }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Company Email</label>
                                        <input type="email" class="form-control" id="email" name="cemail"
                                               value="{{ Auth::user()->companyInfo->companyEmail }}" required>
                                    </div>
                                    <!-- Phone -->

                                </div>
                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               value="{{ Auth::user()->companyInfo->phone }}">
                                    </div>
                                    <!-- Phone -->
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">WhatsApp Number</label>
                                        <input type="text" class="form-control" id="phone" name="wphone"
                                               value="{{ Auth::user()->companyInfo->wpNumber }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Company Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="companyName" class="form-label">Company Name</label>
                                        <input type="text" class="form-control" id="companyName" name="companyName"
                                               value="{{ Auth::user()->companyInfo->companyName }}">
                                    </div>
                                    <!-- City -->
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                               value="{{ Auth::user()->companyInfo->city }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Profile Picture -->
                                    <div class="col-md-12 mb-3">
                                        <label for="companyLogo" class="form-label">Company Logo</label>
                                        <input type="file" class="form-control" id="companyLogo" name="companyLogo">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

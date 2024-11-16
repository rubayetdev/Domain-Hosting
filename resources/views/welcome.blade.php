<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="container">
    <div class="title">Registration</div>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <!-- Display Error Message -->
            @if(session('error'))
                <div class="alert alert-error alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{route('registration')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="user-details">
                <div class="input-box">
                    <span class="details"><i class="fas fa-building"></i> Company Name</span>
                    <input type="text" name="companyName" placeholder="Enter company name" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-envelope"></i> Company Email</span>
                    <input type="email" name="companyEmail" placeholder="Enter company email" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-image"></i> Company Logo</span>
                    <input type="file" name="photo" accept="image/*" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-user"></i> First Name</span>
                    <input type="text" name="fname" placeholder="Enter first name" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-user"></i> Last Name</span>
                    <input type="text" name="lname" placeholder="Enter last name" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-user-circle"></i> Username</span>
                    <input type="text" name="username" placeholder="Enter username" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-envelope"></i> User Email</span>
                    <input type="email" name="userEmail" placeholder="Enter email address" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-phone"></i> Phone Number</span>
                    <input type="tel" name="phone" placeholder="Enter phone number" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fab fa-whatsapp"></i> WhatsApp Number</span>
                    <input type="tel" name="wpNumber" placeholder="Enter WhatsApp number" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-city"></i> City</span>
                    <input type="text" name="city" placeholder="Enter city" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-mail-bulk"></i> Postal Code</span>
                    <input type="text" name="code" placeholder="Enter postal code" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-flag"></i> Country</span>
                    <input type="text" name="country" placeholder="Enter country" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-lock"></i> Password</span>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="input-box">
                    <span class="details"><i class="fas fa-lock"></i> Confirm Password</span>
                    <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register">
            </div>
        </form>
            <div class="register-link">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
    </div>
</div>
</body>
</html>

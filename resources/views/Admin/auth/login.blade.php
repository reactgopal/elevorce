<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Breathe</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('theme/images/favicon.png') }}" type="image/png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="h-100 bg-body">

    <!-- Blue wave background -->
    <div class="position-absolute top-0 start-0 w-100 wave-bg">
        <div class="container py-4 px-5">
            <img src="{{ asset('assets/images/breathe_logo.svg') }}" height="32" alt="Breathe Logo">
        </div>
    </div>

    <!-- Centered Login Card -->
    <div class="login-wrapper container">
        <div class="login_card p-4">
            <div class="text-center login-icon">
                <img src="{{ asset('assets/images/breathe_icon.svg') }}" alt="Login Icon">
            </div>
            <h2 class="text-center login-title">Log in to Breathe</h2>

            <!-- Login Form -->
            {{-- <form method="POST" action="{{ route('login') }}"> --}}
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                        required>
                </div>

                <div class="mb-3 password-wrapper">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required>
                    <span class="toggle-password" onclick="togglePassword()">
                        👁️</span>
                </div>

                <button type="submit" class="btn-login mt-2">Login</button>
            </form>

            <!-- Links -->
            <div class="login-links text-center">
                <a href="#">Forgot Password?</a>
                <a href="#">Create Account</a>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="footer__login position-absolute w-100  text-center small text-muted py-3 mt-auto ">
        <div class="footer__login_container">
            <div class="footer__login_flex-container">
                <div class="mb-2 d-flex">
                    <a href="#" class="footer_login_icon"><img src="{{ asset('assets/images/facebook.png') }}"
                            height="30" alt="Facebook"></a>
                    <a href="#" class="footer_login_icon"><img src="{{ asset('assets/images/linkedin.png') }}"
                            height="30" class="mx-2" alt="LinkedIn"></a>
                    <a href="#" class="footer_login_icon"><img src="{{ asset('assets/images/youtube.png') }}"
                            height="30" alt="YouTube"></a>
                </div>
                <div class="copyright">
                    <div class="footer-text">Registered in England, Company Number 3020608</div>
                    <div>2025 Centurion. All rights reserved.</div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            var input = document.getElementById("password");
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>

</html>

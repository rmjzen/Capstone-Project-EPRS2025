<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login | EPRS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/epasslogo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <a href="" class="logo d-flex align-items-center w-auto">
                                            <img src="assets/img/epasslogo.png" alt="">
                                            <span class="label text-sm">Login to EPRS</span>
                                        </a>
                                    </div>

                                    <form action="/login" method="POST" class="row g-3 needs-validation" novalidate>
                                        @csrf

                                        @if (session()->has('error'))
                                            <div class="position-fixed top-0 start-50 translate-middle-x mt-3 w-auto">
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ session('error') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            </div>
                                        @endif

                                        @if (session()->has('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <input value="{{ session('email') ?? old('email') }}" type="email"
                                                name="email" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">Please enter a valid Email address!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control"
                                                    id="yourPassword" required>
                                                <span class="input-group-text" onclick="togglePassword()">
                                                    <i id="password-icon" class="fas fa-eye-slash"></i>
                                                </span>
                                                <div class="invalid-feedback">Please enter your password!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have an account? <a href="/register">Create an
                                                    account</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </section>
        </div>

    </main>



    <x-admin.footerscript />

    <script type="text/javascript">
        function togglePassword() {
            const passwordInput = document.getElementById("yourPassword");
            const passwordIcon = document.getElementById("password-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.className = "fas fa-eye";
            } else {
                passwordInput.type = "password";
                passwordIcon.className = "fas fa-eye-slash";
            }
        }

        function togglePasswordConfirmation() {
            const passwordInputConfirmation = document.getElementById("yourPasswordConfirmation");
            const passwordIconConfirmation = document.getElementById("password-icon-confirmation");

            if (passwordInputConfirmation.type === "password") {
                passwordInputConfirmation.type = "text";
                passwordIconConfirmation.className = "fas fa-eye";
            } else {
                passwordInputConfirmation.type = "password";
                passwordIconConfirmation.className = "fas fa-eye-slash";
            }
        }
    </script>

</body>

</html>

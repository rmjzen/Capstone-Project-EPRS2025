<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register | EPRS</title>
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

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/epasslogo.png" alt="">
                                    <span class="d-none d-lg-block">E-PASS SLIP</span>
                                </a>
                            </div>



                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-1 pb-1">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="/register" method="POST" class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Name</label>
                                            <input value="{{ old('name') }}" type="text" name="name"
                                                class="form-control" id="yourName" required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="departmentSelect" class="form-label">Department</label>
                                            <select name="department" id="departmentSelect" class="form-control"
                                                required>
                                                <option value="" selected disabled>Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->dept_name }}"
                                                        {{ old('department') == $department->dept_name ? 'selected' : '' }}>
                                                        {{ $department->dept_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a department!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="designationSelect" class="form-label">Designation</label>
                                            <select name="designation" id="designationSelect" class="form-control"
                                                required>
                                                <option value="" selected disabled>Select Designation</option>
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation->designation_name }}"
                                                        {{ old('designation') == $designation->designation_name ? 'selected' : '' }}>
                                                        {{ $designation->designation_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a designation!</div>
                                        </div>


                                        <div class="col-12" id="headTypeContainer" style="display: none;">
                                            <label for="head_type" class="form-label">Head of Office Type</label>
                                            <select name="head_type" id="head_type" class="form-control">
                                                <option value="" selected disabled>Select Head of Office Type
                                                </option>
                                                @foreach ($pleaseheadtype as $head)
                                                    <option value="{{ $head->please_name }}">{{ $head->please_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <script>
                                            document.getElementById('designationSelect').addEventListener('change', function() {
                                                const selectedValue = this.value;
                                                const headTypeContainer = document.getElementById('headTypeContainer');

                                                // Show the head type dropdown only if the selected designation is "Head of Office"
                                                if (selectedValue === "Head of Office") {
                                                    headTypeContainer.style.display = "block";
                                                } else {
                                                    headTypeContainer.style.display = "none";
                                                }
                                            });
                                        </script>

                                        <div class="col-12">
                                            <label for="yourPhone" class="form-label">Phone Number</label>
                                            <input value="{{ old('phone_number') }}" type="text"
                                                name="phone_number" class="form-control" id="yourPhone" required
                                                pattern="[0-9]{11}">
                                            <div class="invalid-feedback">Please enter a valid 11-digit phone
                                                number!
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <input value="{{ old('email') }}" type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="yourEmail" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @else
                                                <div class="invalid-feedback">Please enter a valid Email address!</div>
                                            @enderror
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
                                                @error('password')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPasswordConfirmation" class="form-label">Confirm
                                                Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation"
                                                    class="form-control" id="yourPasswordConfirmation" required>
                                                <span class="input-group-text" onclick="togglePasswordConfirmation()">
                                                    <i id="password-icon-confirmation" class="fas fa-eye-slash"></i>
                                                </span>
                                                <div class="invalid-feedback">Please enter your password!</div>
                                                @error('password')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                    value="1" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and
                                                    accept
                                                    the
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#fullscreenModal">terms and
                                                        conditions</a></label>
                                                <div class="invalid-feedback">You must agree before submitting.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Full Screen Modal -->

                                        <!-- Fullscreen Modal Template -->
                                        <div class="modal fade" id="fullscreenModal" tabindex="-1">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Terms and Conditions</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>Welcome to E-Pass Slip Recording System!</h3>
                                                        <p>By accessing or using E-Pass Slip Recording System, you
                                                            agree
                                                            to
                                                            comply with and be bound by the following terms and
                                                            conditions. Please read these terms carefully.</p>

                                                        <h4>1. General Terms</h4>
                                                        <p><strong>1.1 Acceptance of Terms</strong><br>
                                                            Your access to and use of our website and its services
                                                            is
                                                            conditioned upon your acceptance of and compliance with
                                                            these Terms. These Terms apply to all visitors, users,
                                                            and
                                                            others who access or use our site.</p>

                                                        <p><strong>1.2 Eligibility</strong><br>
                                                            By using this website, you confirm that you are user
                                                            from
                                                            PIT-TABANGO CAMPUS
                                                        </p>

                                                        <h4>2. Information We Collect</h4>
                                                        <p><strong>2.1 Personal Information</strong><br>
                                                            To provide our services, we may collect basic
                                                            information
                                                            such as your name, email address, and contact details.
                                                            This
                                                            information is only collected with your consent and is
                                                            used
                                                            solely to enhance your experience on our site.</p>

                                                        <p><strong>2.2 Non-Personal Information</strong><br>
                                                            We may collect non-personal information like browser
                                                            type,
                                                            device information, and interaction data to help us
                                                            improve
                                                            our website's functionality and usability.</p>

                                                        <h4>3. Data Security</h4>
                                                        <p>We prioritize the security of your personal information
                                                            and
                                                            have implemented reasonable measures to safeguard it
                                                            from
                                                            unauthorized access, alteration, or disclosure. However,
                                                            please be aware that no method of online data
                                                            transmission
                                                            or storage is completely secure, and we cannot guarantee
                                                            absolute security.</p>

                                                        <h4>4. Use of Information</h4>
                                                        <p>Your information will only be used for purposes stated at
                                                            the
                                                            time of collection, such as improving user experience,
                                                            processing inquiries, or providing requested
                                                            information. We
                                                            do not share, sell, or disclose your information to
                                                            third
                                                            parties without your consent, except as required by law.
                                                        </p>

                                                        <h4>5. User Conduct</h4>
                                                        <p><strong>5.1 Prohibited Activities</strong><br>
                                                            You agree not to use our website for any unlawful
                                                            purpose or
                                                            any activity that could harm the website or disrupt
                                                            other
                                                            users' experience.</p>

                                                        <h4>6. Limitation of Liability</h4>
                                                        <p>E-Pass Slip Recording System is not liable for any
                                                            direct,
                                                            indirect,
                                                            incidental, or consequential damages arising from your
                                                            use
                                                            of, or inability to use, our website and services.</p>

                                                        <h4>7. Modifications to Terms</h4>
                                                        <p>We reserve the right to update or modify these Terms at
                                                            any
                                                            time. Changes will be posted on this page, and your
                                                            continued use of the site after such modifications will
                                                            constitute your acknowledgment and acceptance of the
                                                            updated
                                                            Terms.</p>

                                                        <h4>8. Contact Us</h4>
                                                        <p>If you have any questions about these Terms and
                                                            Conditions,
                                                            please contact us at 09317317321.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Full Screen Modal-->
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create
                                                Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a href="/login">Log
                                                    in</a>
                                            </p>
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

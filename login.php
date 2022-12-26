<?php include('libs/connect.inc.php')  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Livepetal | Login</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>
<body>
    <div id="page" class="page">
        <section id="login-2" class="login-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
                        <div class="login-page-logo">
                            <img class="img-fluid" src="assets/images/logo-01.png" alt="logo-image">
                        </div>
                        <!-- SIGN IN FORM -->
                        <div class="register-form">
                            <form name="signinform" class="row sign-in-form">
                                <div class="col-md-12">
                                    <div class="register-form-title text-center">
                                        <h4 class="h4-lg">Welcome Back!</h4>
                                        <p class="p-xl">Log in to your account</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input class="form-control email" type="email" name="email" placeholder="example@example.com">
                                </div>
                                <div class="col-md-12">
                                    <div class="wrap-input">
                                        <span class="btn-show-pass ico-20"><span class="flaticon-visible eye-pass"></span></span>
                                        <input class="form-control password" type="password" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-md btn-skyblue tra-black-hover submit">Log In</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-around align-items-center form-data">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                                        </div>
                                        <p class="forgot-password"><a href="reset-password-2.html">Forgot your password?</a></p>

                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <p class="create-account">
                                        Don't have an account? <a href="signup.php" class="skyblue-color">Sign up</a>
                                    </p>
                                </div>
                            </form>
                        </div> 
                        <div class="sign-in-notice text-center">
                            <p>By clicking “Log in”, you agree to our <a href="#">Terms</a> and that you have read our
                                <a href="#"> Privacy Policy</a>
                            </p>
                        </div>
                        <div class="sign-in-footer text-center">
                            <p>Copyright <?= date('Y') ?> LIVEPETAL. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Script -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
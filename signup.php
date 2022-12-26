<?php include('libs/connect.inc.php')  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Livepetal | Create Account</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>
<body>
    <div id="page" class="page">
        <section id="signup-2" class="signup-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
                        <div class="login-page-logo">
                            <img class="img-fluid" src="assets/images/logo-01.png" alt="logo-image">
                        </div>
                        <div class="register-form">
                            <form name="signupform" class="row sign-up-form">
                                <div class="col-md-12">
                                    <div class="register-form-title text-center">
                                        <h4 class="h4-lg">Create Account</h4>
                                        <p class="p-xl">Tell us a little about yourself</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input class="form-control name" type="text" name="name" placeholder="Your name">
                                </div>
                                <div class="col-md-12">
                                    <input class="form-control email" type="email" name="email" placeholder="Your email">
                                </div>
                                <div class="col-md-12">
                                    <div class="wrap-input">
                                        <span class="btn-show-pass ico-20"><span class="flaticon-visible eye-pass"></span></span>
                                        <input class="form-control password" type="password" name="password" placeholder="Create a Password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-md btn-skyblue tra-black-hover submit">Create Account</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-data">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                            <label class="form-check-label" for="exampleCheck1">
                                                <span>By clicking “Sign up”, you agree to our <a href="terms.php">Terms</a> and that you have
                                                    read our <a href="terms.php"> Privacy Policy</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <p class="create-account">
                                        Already have an account? <a href="login.php" class="skyblue-color">Log in</a>
                                    </p>
                                </div>
                            </form>
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
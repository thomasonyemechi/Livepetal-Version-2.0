<?php $current_page = basename($_SERVER["SCRIPT_FILENAME"], '.php') ?>
<header id="header" class="header tra-menu <?= ($current_page == 'index') ? 'navbar-light' : 'navbar-dark' ?> ">
    <div class="header-wrapper">
        <div class="wsmobileheader clearfix">
            <span class="smllogo"><img src="assets/images/logo-01.png" alt="mobile-logo" /></span>
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        </div>
        <div class="wsmainfull menu clearfix">
            <div class="wsmainwp clearfix">
                <div class="desktoplogo"><a href="#hero-1" class="logo-black"><img src="assets/images/logo-01.png" alt="header-logo"></a></div>
                <div class="desktoplogo"><a href="#hero-1" class="logo-white"><img src="assets/images/logo-02.png" alt="header-logo"></a></div>
                <nav class="wsmenu clearfix">
                    <ul class="wsmenu-list nav-orange-red-hover">
                        <li class="nl-simple" aria-haspopup="true"><a href="./">Home</a></li>
                        <li class="nl-simple" aria-haspopup="true"><a href="./about.php">About</a></li>
                        <li class="nl-simple" aria-haspopup="true"><a href="pricing.html">Browse Service</a></li>

                        <li class="nl-simple" aria-haspopup="true"><a href="contact.php">Contact</a></li>
                        <li class="nl-simple" aria-haspopup="true">
                            <a href="signup.php" class="btn btn-skyblue tra-skyblue-hover last-link">Sign Up</a>
                        </li>
                        <li class="nl-simple" aria-haspopup="true">
                            <a href="login.php" class="btn btn-tra-white orange-red-hover last-link">Log In</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
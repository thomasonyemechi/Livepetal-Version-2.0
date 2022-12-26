<?php
session_start(); ob_start();
require_once './vendor/autoload.php';
use TrenetTopUp\App\TopUp;

$service_code ='';
$results = array();

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['service']) && $_REQUEST['service']){
    $service_code = $_REQUEST['service']??'';
    $sub_service = $_REQUEST['sub_service']??'';

    if(empty($service_code) || empty($sub_service)){
        $error_message = 'page not found';
    }
    if(empty($error_message)) {
        $result_data = TopUp::subServicePrice($service_code, $sub_service);

        if(!is_array($result_data)) {
            $error_message = 'Server connection error please try again later';
        } else {
            $results = $result_data;
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head><!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-171604757-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-171604757-1');
</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta description -->
    <meta name="description"
          content="Livepetal, your preferred digital marketplace that takes care of all your digital needs. Stocked with exciting products and services. You can post a job and request fresh design and development from ground up and get delivery of excellent solution within days or even hours">
    <meta name="author" content="Livepetal">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content=""/> <!-- website name -->
    <meta property="og:site" content=""/> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content=""/> <!-- description shown in the actual shared post -->
    <meta property="og:image" content=""/> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""/> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article"/>

    <!--title-->
    <title>Livepetal | Topup</title>

    <!--favicon icon-->
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7COpen+Sans:400,600&amp;display=swap"
          rel="stylesheet">


    <!--Bootstrap css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--Bootstrap slider css-->
    <link rel="stylesheet" href="css/bootstrap-slider.min.css">
    <!--Magnific popup css-->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!--Themify icon css-->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!--mega menu js-->
    <link rel="stylesheet" href="css/hs.megamenu.css">
    <!--animated css-->
    <link rel="stylesheet" href="css/animate.min.css">
    <!--ytplayer css-->
    <link rel="stylesheet" href="css/jquery.mb.YTPlayer.min.css">
    <!--Owl carousel css-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!--custom css-->
    <link rel="stylesheet" href="css/style.css">
    <!--responsive css-->
    <link rel="stylesheet" href="css/responsive.css">

<link rel='stylesheet prefetch' href='font-awesome-4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="public/assets/css/styles.css">
<style type="text/css">
    .list-inline-item{color: #fff;}
    .list-inline-item a{color: #fff;}
</style>

</head>
<body>


<!--loader start-->
<div id="preloader">
    <div class="loader1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!--loader end-->

<!--header section start-->
<?php include('head.php');
include("recharge.php"); ?>
<!--header section end-->

<!--body content wrap start-->
<div class="main">
<?php include('nav2.php');?>

      <!--services section start-->
    <section class="our-services gray-light-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-8 p-2">
                    <div class="single-service-plane rounded white-bg shadow-sm mt-md-4 mt-lg-4">
                        
             
                        <?php if($service_code =='direct_data') { ?>
                            <div class="card border-info">
            <div class="card-header text-light py-3 px-2" style="background-color: #036" >
                <h5 class="mb-0" style="color: #FFF">Direct Data subscription</h5>
            </div>
            <div class="card-body">

            

                <div class="row">

                    <?php
                    if(empty($results)) {
                        echo '<div class="col-12">';
                        echo displayError($error_message);
                        echo '</div>';
                    } else {  $i=1;
                        foreach($results as $result) { $e=$i++;
                        if($e>3){ ?>
                            <div class="col-md-4">
                                <div class="plan-block">
                                    <h4><?php echo $result['available_service_name']; ?></h4>
                                    <p>Plan Cost&nbsp;<span
                                            class="price"><?php echo number_format($result['available_service_default_price']) ?></span>&nbsp;&amp; <?php echo $result['available_service_description']; ?>
                                    </p>
                                    <button class="btn btn-primary btn-sm buyData" type="button"
                                            value="<?php echo $result['available_service_default_price']; ?>"
                                            amount="<?php echo $result['available_service_default_price']; ?>"
                                            description="<?php echo $result['available_service_description']; ?>"
                                            data-code="<?php echo $result['product_code']; ?>">Buy Now
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
                            <?php
                        }
                        if($service_code =='cable_subscription') {
                            ?>
                          <div class="card border-info">
            <div class="card-header text-light py-3 px-2" style="background-color: #036" >
                <h5 class="mb-0" style="color: #FFF">Cable subscription</h5>
            </div>
            <div class="card-body">
               
                <div class="row">
                    <?php
                    foreach($results as $result){
                        ?>
                        <div class="col-md-3">
                            <div class="plan-block">
                                <h5><?php echo strtoupper($result['available_service_name'] ?? ''); ?></h5>
                                <p><span
                                        class="price"><?php echo number_format($result['available_service_default_price']); ?></span>
                                </p>
                                <button class="btn btn-primary btn-sm buyCable" value="gotv_max">Buy Now</button>
                            </div>
                        </div>
                        <?php
                    }
                    ?>


                </div>
            </div>
        </div>
                            <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 p-2">
                    <?php include('right.php'); ?>

                </div>
            </div>
        </div>
    </section>
    <!--services section end-->





</div>
<!--body content wrap end-->

<!--footer section start-->
<?php include("foot.php") ?>
<!--footer section end-->

<!--bottom to top button start-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="ti-rocket"></span>
</button>
<!--bottom to top button end-->

<div class="modal fade" role="dialog" tabindex="-1" id="data_modal" style="background-color: rgba(66,69,69,0.9);">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Make data purchase</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                <form id="data_purchase" method="post" enctype="application/x-www-form-urlencoded" >
                    <input type="hidden" id="networks" name="networks" value="<?php echo $_REQUEST['sub_service']??''; ?>">
                    <input class="form-control" type="hidden" name="product_code" id="product_code" value="">
                    <input type="hidden" name="recharge_type" value="directData">
                    <p>input your phone number to complete the&nbsp;<span id="data_v">Text</span> purchase</p>
                    <div class="form-group"><label>Phone</label>
                        <input class="form-control phone" type="text" name="phone" required>
                        <small class="form-text text-muted">maximum of 11 characters is allowed</small>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input class="form-control amount" type="text" id="direct_data_amount" value="" disabled="" maxlength="11" name="amount">
                    </div>
                    <div class="alert alert-success" role="alert" id="airtime_descrip"></div>
                    <div class="form-group py-3 px-2 text-right">
                        <button class="btn btn-warning mr-2" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Continue</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" role="dialog" tabindex="-1" id="cable_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Title</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                <p>The content of your modal.</p>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
        </div>
    </div>
</div> -->

<!--jQuery-->
<script src="js/jquery-3.4.1.min.js"></script>
<!--Popper js-->
<script src="js/popper.min.js"></script>
<!--Bootstrap js-->
<script src="js/bootstrap.min.js"></script>
<!--Bootstrap slider js-->
<script src="js/bootstrap-slider.min.js"></script>
<!--countdown js-->
<script src="js/jquery.countdown.min.js"></script>
<!--jquery easing js-->
<script src="js/jquery.easing.min.js"></script>
<!--jquery ytplayer js-->
<script src="js/jquery.mb.YTPlayer.min.js"></script>
<!--wow js-->
<script src="js/wow.min.js"></script>
<!--owl carousel js-->
<script src="js/owl.carousel.min.js"></script>
<!--Magnific popup js-->
<script src="js/jquery.magnific-popup.min.js"></script>
<!--headroom js-->
<script src="js/headroom.min.js"></script>
<!--megamenu js-->
<script src="js/hs.megamenu.js"></script>
<!--custom js-->
<script src="js/scripts.js"></script>
<script src= "public/assets/js/buynow.js"></script>
<script src="public/assets/js/general.js"></script>


</body>

</html>

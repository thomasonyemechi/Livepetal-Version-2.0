<?php

date_default_timezone_set('Africa/Lagos');

$today = date('ymd');
$dd = date('ymd');
$mm = date('ym');
$yy = date('y');
$ww = date('yW');
$yyyy = date('Y');
$lm = $mm - 1;
$lw = $ww - 1;





////change this item to and id number and not name 



define("DB_SERVER", "localhost");
define("DB_USER", "root"); //enter your database username
define("DB_PASS", "");   //databse password
define("DB_NAME", "livepetal"); //database name
define("DB_USER2", "schoejih_schoejih_livepetal"); //enter your database username
define("DB_NAME2", "schoejih_livepetal"); //database name
define("DB_PASS2", "trenet.com.livepetal");   //databse password


define("STATUSBETA", sha1(56));
define("STATUSALPHA", sha1(65));
define("MATRIX", 3);
define("NAIRA", '₦');
define("CTIME", time());



define('AIRTIME', 'https://smartrecharge.ng/api/v2/airtime/?api_key=3d5bab92&');
define('DATASHARE', 'https://smartrecharge.ng/api/v2/datashare/?api_key=3d5bab92&');
define('DIRECTDATA', 'https://smartrecharge.ng/api/v2/directdata/?api_key=3d5bab92&');
//define('VERIFYURL','https://smartrecharge.ng/api/v2/electric/?api_key=5ee93d81&');
define('CALLBACK', 'https://livepetal.com/callback.php'); //');
define('ELECTRIC', 'https://smartrecharge.ng/api/v2/electric/?api_key=3d5bab92&');
define('CABLE', 'https://smartrecharge.ng/api/v2/tv/?api_key=3d5bab92&');
define('AVAILABLES', 'https://smartrecharge.ng/api/v2/others/get_available_services.php/?api_key=5ee93d81&');



define("TODAY", date("Y-m-d"));


/**
 * Timeout Constants - these constants refer to
 * the maximum amount of time (in minutes) after
 * their last page fresh that a user and guest
 * are still considered active visitors.
 */
define("USER_TIMEOUT", 10);
define("ADMIN_TIMEOUT", 5);

/**
 * Cookie Constants - these are the parameters
 * to the setcookie function call, change them
 * if necessary to fit your website. If you need
 * help, visit www.php.net for more info.
 * <http://www.php.net/manual/en/function.setcookie.php>
 */
define("COOKIE_EXPIRE", 60 * 60 * 24 * 730);  //365 days by default
define("COOKIE_PATH", "/");  //Avaible in whole domain

/**
 * Email Constants - these specify what goes in
 * the from field in the emails that the script
 * sends to users, and whether to send a
 * welcome email to newly registered users.
 */
define("URL", "https://www.livepetal.com/");
define("EMAIL_FROM_NAME", "Livepetal Systems");
define("EMAIL_FROM_ADDR", "support@livepetal.com");
define("ADMIN_EMAIL", "support@livepetal.com");
define("EMAIL_WELCOME", true); //set this false if you do not want your users to receive a welcome Email after registration

define('APP_NAME', 'LIVEPETAL');

$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
//$db1 = new mysqli(DB_SERVER, DB_USER2, DB_PASS2, DB_NAME2);
$offset = "+01:00";
$db->query("SET time_zone='" . $offset . "';");

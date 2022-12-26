<?php if($pro->adminLevel($uid)>20001){ session_destroy(); header("location: login.php"); }


 ?>
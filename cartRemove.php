<?php
ob_start();
require_once('connect.php');
require_once('googleLogin/config.php');
$auth = isset($_SESSION['access_token']);
if($auth!="")
{
  $email = $_SESSION['email'];
}
if(isset($_GET['removeitem']) && isset($_GET['removeres']))
{
  $remitem = $_GET['removeitem'];
  $remres = $_GET['removeres'];
}

$rquery = "DELETE FROM `cartitems` WHERE `citem` = '$remitem' AND `email` = '$email' AND `restaurant`='$remres'";
if($rqrun = mysqli_query($conn,$rquery))
{
  // echo '<span style="font-weight:bold;">'.$remitem.'</span> removed from the cart successfully..!';
  header('Location:http://localhost/fprjct/cartDisplay.php');
}

<?php
ob_start();
require_once('connect.php');
require_once('googleLogin/config.php');
$auth = isset($_SESSION['access_token']);
if($auth!="")
{
  $email = $_SESSION['email'];
}
if(isset($_GET['removeitem']))
{
  $remitem = $_GET['removeitem'];
}

$rquery = "DELETE FROM `cartitems` WHERE `citem` = '$remitem' AND `email` = '$email'";
if($rqrun = mysqli_query($conn,$rquery))
{
  // echo '<span style="font-weight:bold;">'.$remitem.'</span> removed from the cart successfully..!';
  header('Location:http://localhost/fprjct/profile.php');
}

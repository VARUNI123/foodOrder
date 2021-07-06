<?php
 require('googleLogin/config.php');
   $auth = isset($_SESSION['access_token']);
   $dbauth= isset($_SESSION['userid']);
 if(isset($_SESSION['access_token']) && isset($_SESSION['hex']) && isset($_GET['thanks']))
 {
   $hex = $_SESSION['hex'];
   $than = $_GET['thanks'];
   if($hex==$than)
   {
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once('links.php'); ?>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
  <style>
   .shero
   {
     margin-top:0px;
     height:400px;
     width:100%;
     background-image:url('images/success.jpg');
     background-position:center;
     background-repeat:no-repeat;
     background-size:cover;
   }
   .scard
   {
     display:flex;
     justify-content:center;
   }
   .pcard
   {
     position:absolute;
     margin-top:-40px;
     /* background-color:white; */
     border:2px solid grey;
     border-radius:30px;
     width:75%;
   }
   .bs
   {
     margin-top:100px;
   }
   @media (min-width:441px) and (max-width:716px) {
     .pcard
     {
       margin-top:-50px;
     }
   }
   @media (min-width:333px) and (max-width:440px)
   {
     .bs
     {
       margin-top:130px;
     }
     .pcard
     {
       margin-top:-70px;
     }
   }
   @media (max-width:332px)
   {
     .bs
     {
       margin-top:140px;
     }
     .pcard
     {
       margin-top:-90px;
     }
     h3
     {
       font-size:25px;
     }
   }
  </style>
</head>
<body>
  <?php include_once('navbarM.php'); ?>
  <div class="shero">
  </div>
  <div class="scard">
    <div class="pcard bg-light">
      <h3 class="text-center font-effect-emboss text-secondary" style="padding:20px;">Your order has been placed successfully</h3>
    </div>
    <div class="bs">
      <a href="index.php"><button class="btn btn-primary">Continue to order again</button></a>
    </div>
  </div>
</body>
</html>
   <?php
   }
   else
   {
     header('Location:index.php');
   }
 }
 else
 {
   header('Location:index.php');
 }
  ?>
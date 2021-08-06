<?php
 require_once('config.php');
 include('../connect.php');

 if(isset($_SESSION['access_token']))
 {
   $gClient->setAccessToken($_SESSION['access_token']);
  // header('Location:http://localhost:8080/fprjct/index.php');
 }
 elseif(isset($_GET['code']))
 {
   $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
   $_SESSION['access_token'] = $token;
 }
  else
  {
    header('Location:http://localhost/fprjct/index.php');
  }
 $oAuth = new Google_Service_Oauth2($gClient);
 $userData = $oAuth->userinfo_v2_me->get();

  // echo "<pre>";
  // var_dump($userData);
  // exit();

  $_SESSION['email'] = $userData['email'];
  $_SESSION['gender'] = $userData['gender'];
  $_SESSION['name'] = $userData['name'];
  $_SESSION['id'] = $userData['id'];
  $_SESSION['picture'] = $userData['picture'];

  $userid = $userData['id'];
  $user_name = $userData['given_name'];
  $email = $userData['email'];

  $query = "SELECT * FROM `login` WHERE `userid`='$userid'";
  if($qrun = mysqli_query($conn,$query))
  {
    $row = mysqli_num_rows($qrun);
    if($row<1)
    {
      $iquery = "INSERT INTO `login` (userid,name,email,usertype) VALUES ('$userid','$user_name','$email','user')";
      mysqli_query($conn,$iquery);
    }
  }

  $url = $_SESSION['url'];

  //header('Location:http://localhost:8080/fprjct/index.php');
  header('Location:'.$url.'');
?>
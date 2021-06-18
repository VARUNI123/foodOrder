<?php
 require_once('config.php');

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

  /*echo "<pre>";
  var_dump($userData);*/

  $_SESSION['email'] = $userData['email'];
  $_SESSION['gender'] = $userData['gender'];
  $_SESSION['name'] = $userData['name'];
  $_SESSION['id'] = $userData['id'];
  $_SESSION['picture'] = $userData['picture'];

  $url = $_SESSION['url'];

  //header('Location:http://localhost:8080/fprjct/index.php');
  header('Location:'.$url.'');
?>
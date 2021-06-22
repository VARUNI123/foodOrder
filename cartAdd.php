<?php
require_once('connect.php');
require_once('googleLogin/config.php');
$auth = isset($_SESSION['access_token']);
if($auth!="")
{
  $email = $_SESSION['email'];
}
if(isset($_GET['cartitem']))
{
  $item = $_GET['cartitem'];
}
if(isset($_GET['quan']))
{
  $quan = $_GET['quan'];
}
if(isset($_GET['cost']))
{
  $cost = $_GET['cost'];
}
if(isset($_GET['img']))
{
  $img = $_GET['img'];
}
if(isset($_GET['res']))
{
  $res = $_GET['res'];
}

$query1 = "SELECT * FROM `cartitems` WHERE `citem` = '$item' AND `email` = '$email'";
if($qrun1 = mysqli_query($conn,$query1))
{
  $num = mysqli_num_rows($qrun1);
  if($num<1)
  {
    if($quan=="")
    {
      echo "Please add the item quantity you want..!";
// please add item quantity
    }
    else
    {
      $query2 = "INSERT INTO `cartitems` (email,citem,image,quan,cost,restaurant) VALUES ('$email','$item','$img',$quan,$cost,'$res')";
      if($qrun2 = mysqli_query($conn,$query2))
      {
        echo '<span style="font-weight:bold;">'.$item.'</span> added to the cart successfully..!';
      }
    }
  }
  else{
    echo '<span style="font-weight:bold;">'.$item.'</span> is already added to the cart..!';
  }
}
else{
  echo '<span style="font-weight:bold;">'.$item.'</span> not added to the cart!';
}

?>
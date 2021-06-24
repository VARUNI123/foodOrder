<?php
require_once('connect.php');
require_once('googleLogin/config.php');
$auth = isset($_SESSION['access_token']);
if($auth!="")
{
  $email = $_SESSION['email'];
}
if(isset($_GET['cartitem']) && isset($_GET['quan']) && isset($_GET['cost']) && isset($_GET['img']) && isset($_GET['res']))
{
  $item = $_GET['cartitem'];
  $quan = $_GET['quan'];
  $cost = $_GET['cost'];
  $img = $_GET['img'];
  $res = $_GET['res'];
}


$query1 = "SELECT * FROM `cartitems` WHERE `citem` = '$item' AND `email` = '$email' AND `restaurant` ='$res'";
if($qrun1 = mysqli_query($conn,$query1))
{
  $num = mysqli_num_rows($qrun1);
  if($num<1)
  {
    if($quan=="")
    {
      echo "Please add the item quantity you want..!";
    }
    else if($res==""){
      echo "Please select the restaurant to add item into cart..!";
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
    $query3 = "UPDATE `cartitems` SET `quan`='$quan' WHERE `citem` = '$item'";
    // echo '<span style="font-weight:bold;">'.$item.'</span> is already added to the cart..!';
    if($qrun3 = mysqli_query($conn,$query3))
      {
        echo '<span style="font-weight:bold;">'.$item.'</span> quantity UPDATED in the cart successfully..!';
      }
  }
}
else{
  echo '<span style="font-weight:bold;">'.$item.'</span> not added to the cart!';
}

?>

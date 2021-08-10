<?php
require_once('connect.php');
require_once('googleLogin/config.php');
$auth = isset($_SESSION['access_token']);
$dbauth= isset($_SESSION['userid']);

   if($dbauth)
   {
     $usertype=$_SESSION['usertype'];
     if($usertype==="admin")
     {
       header('Location:adminpanel/index.php');
     }
   }

if($auth!="")
{
  $email = $_SESSION['email'];
}
else if($dbauth !=""){
  $email = $_SESSION['dbemail'];
}
if(isset($_GET['cartitem']) && isset($_GET['quan']) && isset($_GET['cost']) && isset($_GET['img']) && isset($_GET['res']))
{
  $item = $_GET['cartitem'];
  $quan = $_GET['quan'];
  $cost = $_GET['cost'];
  $img = $_GET['img'];
  $res = $_GET['res'];
  $item_status=0;
  $order_id='pending';
}


$query1 = "SELECT * FROM `cartitems` WHERE `citem` = '$item' AND `email` = '$email' AND `restaurant` ='$res' AND `item_status`=0";
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
      $query2 = "INSERT INTO `cartitems` (order_id,email,citem,image,quan,cost,restaurant,item_status) VALUES ('$order_id','$email','$item','$img',$quan,$cost,'$res',$item_status)";
      if($qrun2 = mysqli_query($conn,$query2))
      {
        echo '<span style="font-weight:bold;">'.$item.'</span> added to the cart successfully..!';
      }
    }
  }
  else
  {
    if($quan!="")
    {
      $query3 = "UPDATE `cartitems` SET `quan`='$quan' WHERE `citem` = '$item'";
      // echo '<span style="font-weight:bold;">'.$item.'</span> is already added to the cart..!';
      if($qrun3 = mysqli_query($conn,$query3))
      {
        echo '<span style="font-weight:bold;">'.$item.'</span> quantity UPDATED in the cart successfully..!';
      }
    }
    else
    {
      echo "Please add the item quantity you want..!";
    }
  }
}
else{
  echo '<span style="font-weight:bold;">'.$item.'</span> not added to the cart!';
}

?>

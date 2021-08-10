<?php
  require_once('connect.php');
  require_once('googleLogin/config.php');
  date_default_timezone_set('Asia/Kolkata');
 
  if(!isset($_SESSION['access_token']) && !isset($_SESSION['userid']))
  {
    header('Location:index.php');
  }

  $dbauth = isset($_SESSION['userid']);
   if($dbauth)
   {
     $usertype=$_SESSION['usertype'];
     if($usertype==="admin")
     {
       header('Location:adminpanel/index.php');
     }
   }

  if(isset($_GET['order_id']))
  {
    $order_id = $_GET['order_id'];
  }
  else
  {
    echo '<script>alert("Oops! We did not find any order id..! Try to keep order again!");window.open("order.php","_self");</script>';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require('links.php'); ?>
</head>
<body>
  <div>
    <?php require_once('navbarM.php'); ?>
  </div>
  <div class="">
    <h1 class="text-center" style="text-decoration:underline;">Your ordered items history</h1>
  </div>
  <div class="container-md">
    <div class="table-responsive">
      <?php
         $auth = isset($_SESSION['access_token']);
         $dbauth = isset($_SESSION['userid']);
         if($auth!="")
         {
           $email = $_SESSION['email'];
         }
         else if($dbauth!='')
         {
           $email = $_SESSION['dbemail'];
         }
         $query = "SELECT * FROM `cartitems` WHERE `email`='$email' AND `order_id`='$order_id' AND `item_status`=1";
         if($qrun = mysqli_query($conn,$query))
         {
           $num = mysqli_num_rows($qrun);
           if($num<1)
           {
            echo '<div style="display:flex;align-items:center;justify-content:center;height:100%;"><a href="http://localhost/fprjct/categories.php?type=Restaurants"><button class="btn btn-primary">Nothing ordered yet... Click here to order</button></a></div>'; 
            }
           else
           {
             ?>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Item Name</th>
                    <th>Image</th>
                    <th>From</th>
                    <th>Cost of each item</th>
                    <th>Quantity</th>
                    <th>Total cost</th>
                  </tr>
                </thead>
                <?php
                  while($row = mysqli_fetch_assoc($qrun))
                  {
                    $cost[] = $row['quan']*$row['cost'];
                    ?>
                    <tr>
                      <td><?php echo $row['citem']; ?></td>
                      <td><img src="<?php echo $row['image']; ?>" alt="" width="150px" height="130px"></td>
                      <td><?php echo $row['restaurant']; ?></td>
                      <td><?php echo $row['cost']; ?></td>
                      <td><?php echo $row['quan']; ?></td>
                      <td><span class="badge badge-success mt-4 m-auto">Rs.<?php echo $row['quan'] * $row['cost']; ?></span></td>
                    </tr>
                    <?php
                  }
                  $total=0;
                  foreach($cost as $x=>$val)
                  {
                    $total=$total+$val;
                  }
                ?>
                <tr>
                  <td colspan="4"></td>
                  <td style="font-weight:bold;">Total Price:</td>
                  <td style="font-weight:bold;"><?php echo $total."/-"; ?></td>
                </tr>
              </table>
             <?php
           }
         }
      ?>
    </div>
  </div>
</body>
</html>


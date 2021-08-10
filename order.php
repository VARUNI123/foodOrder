<?php
  require_once('connect.php');
  require_once('googleLogin/config.php');
  date_default_timezone_set('Asia/Kolkata');
  $date =  date(DATE_COOKIE).' '.date('a');
  // echo $date;
  $md = md5($date);
  // echo '<br>'.$md;
  $auth = isset($_SESSION['access_token']);
  $dbauth = isset($_SESSION['userid']);
   
   if($dbauth)
   {
     $usertype=$_SESSION['usertype'];
     if($usertype==="admin")
     {
       header('Location:adminpanel/index.php');
     }
   }

  if(!$auth && !$dbauth)
  {
    header('Location:index.php');
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
    <h1 class="text-center" style="text-decoration:underline;">Your order history</h1>
  </div>
  <div class="container-md">
    <div class="table-responsive">
      <?php
         if($auth!="")
         {
           $email = $_SESSION['email'];
         }
         else if($dbauth!="")
         {
           $email = $_SESSION['dbemail'];
         }
         $query = "SELECT * FROM `billing` WHERE `email`='$email' ORDER BY `added_on` DESC";
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
                    <th>Order Id</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Pincode</th> 
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Added On</th>
                  </tr>
                </thead>
                <?php
                  while($row = mysqli_fetch_assoc($qrun))
                  {
                    ?>
                    <tr>
                      <td><a href="orderedItems.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-warning"><?php echo $row['order_id']; ?></a></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['phone_num']; ?></td>
                      <td><?php echo $row['address']; ?></td>
                      <td><?php echo $row['city']; ?></td>
                      <td><?php echo $row['pincode']; ?></td>
                      <td><?php echo $row['payment_type']; ?></td>
                      <td><?php echo $row['payment_status']; ?></td>
                      <td><?php echo $row['order_status']; ?></td>
                      <td><?php echo $row['added_on']; ?></td>
                    </tr>
                    <?php
                  }
                ?>
              </table>
             <?php
           }
         }
      ?>
    </div>
  </div>
</body>
</html>
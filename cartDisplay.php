<?php
require_once('connect.php');
require_once('googleLogin/config.php');
date_default_timezone_set('Asia/Kolkata');
if(!isset($_SESSION['access_token']))
{
  header('Location:http://localhost/fprjct/index.php');
}
else
{
  if(isset($_POST['submit']))
  {
    $phone = mysqli_real_escape_string($conn,$_POST['phone_num']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $pincode = mysqli_real_escape_string($conn,$_POST['pincode']);
    $payment = mysqli_real_escape_string($conn,$_POST['payment_type']);
    $total_price = mysqli_real_escape_string($conn,$_POST['total_price']);
    $payment_status = "success";
    if($payment=="cod")
    {
      $payment_status="pending";
    }
    $order_status="pending";
    $added_on=date('Y-m-d H:i:s');
    $i_email = mysqli_real_escape_string($conn,$_POST['email']);
    $item_status=1;
    $date =  date(DATE_COOKIE).' '.date('a');
    $order_id = md5($date);

    $billQuery = "INSERT INTO `billing` (order_id,email,phone_num,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on) VALUES ('$order_id','$i_email',$phone,'$address','$city',$pincode,'$payment',$total_price,'$payment_status','$order_status','$added_on')";
    $im_query = "UPDATE `cartitems` SET `item_status`=$item_status,`order_id`='$order_id' WHERE `email`='$i_email' AND `item_status`=0";
    if(mysqli_query($conn,$im_query) && mysqli_query($conn,$billQuery))
    {
      $char = random_bytes(10);
      $hex = bin2hex($char);
      $_SESSION['hex'] = $hex;
      header('Location:success.php?thanks='.$hex);
    }
   }
?>
<html>
  <head>
    <?php require('links.php'); ?>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    .table
    {
      /* margin-top:100px; */
    }
      #snackbar,#snackbarR {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: red;
      color: #fff;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 1;
      left: 50%;
      transform:translateX(-18%);
      bottom: 30px;
    }

    #snackbar.show,#snackbarR.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
    .load
    {
      position:fixed;
      top:0%;
      left:0%;
      background:white;
      display:flex;
      align-items:center;
      justify-content:center;
      height:100%;
      width:100%;
    }

    @media (min-width:768px)
    {
      .pincode
      {
        margin-left:20px;
      }
    }
    @media (max-width:248px)
    {
      .city_input,.pincode_input
      {
        width:80%;
      }
    }
    </style>
  </head>
  <body>
  <!-- <div id="mNav">
    <?php  //require('mobileNav.php'); ?>
  </div> -->
  <!-- <div id="lNav">
     //require('navbar.php'); ?>
  </div> -->
  <div>
    <?php require_once('navbarM.php'); ?>
  </div>
  <div class="container-md cart">
    <div class="table-responsive">
        <?php
           $auth = isset($_SESSION['access_token']);
           if($auth!="")
           {
             $email = $_SESSION['email'];
           }
           $query = "SELECT * FROM `cartitems` WHERE `email` = '$email' AND `item_status`=0";
           if($qrun = mysqli_query($conn,$query))
            {
              $num = mysqli_num_rows($qrun);
              if($num<1)
              {
                echo '<div style="display:flex;align-items:center;justify-content:center;height:100%;"><a href="http://localhost/fprjct/categories.php?type=Restaurants"><img class="" src="images/emptyCart.jpg" width="220px" height="220px"></a></div>'; 
              }
              else
              {
                ?>
                <table class="table table-hover table-bordered mt-2">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Item Name</th>
                      <th>From</th>
                      <th>Cost of each item</th>
                      <th>Quantity</th>
                      <th>Sub Total</th>
                      <th>Action</th>
                    <tr>
                  </thead>
                <?php
                while($row = mysqli_fetch_assoc($qrun))
                {
                    $cost[] = $row['quan'] * $row['cost'];
                ?> 
                <tr data-aos="fade-right">
                  <td><img src="<?php echo $row['image']; ?>" alt="" width="150px" height="130px"></td>
                  <td><p class="text-dark" style="font-size:120%;" style=""><?php echo $row['citem']; ?></p></td>
                  <td><p class="text-dark" style="font-size:120%;"><?php echo $row['restaurant']; ?></p></td>
                  <td><span class="badge badge-danger m-auto">Rs.<?php echo $row['cost']; ?></span><br></td>
                  <td><span class="badge badge-danger"><?php echo $row['quan']; ?></span></td>
                  <td><span class="badge badge-success mt-4 m-auto">Rs.<?php echo $row['quan'] * $row['cost']; ?></span></td>
                  <td><a href="http://localhost/fprjct/cartRemove.php?removeitem=<?php echo $row['citem']; ?>&removeres=<?php echo $row['restaurant'];?>"><button class="btn btn-danger"><i class="fa fa-trash fa-lg"></i></button></a></td>
                </tr>
                <?php
                }
                ?>
                </table>
                <div class="container-md">
                  <div class="row" style="display:flex;justify-content:center;">
                        <h4 class="ml-2 mt-2 col-10 col-sm-5 col-md-5">Total Amount: 
                          <?php 
                            $total=0;
                            if(empty($cost))
                            {
                              $total = 0;
                            }
                            else
                            {
                              foreach($cost as $x => $val)
                              {
                                $total = $total + $val;
                              }
                            }
                            echo '<span class="badge badge-primary">Rs.'.$total.'</span>';
                          ?>
                        </h4>
                        <!--Billing Modal-->
                            <div class="modal fade" id="mymodal">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title ml-3">Billing Form</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body" style="">
                                      <form action="cartDisplay.php" method="POST">
                                            <?php
                                              $total_price = $total;
                                            ?>
                                            <!-- <label for="name" class="col-12" style="font-weight:bold;"><i class="fa fa-user"></i>&nbsp;Name:</label>
                                            <input type="text" id="name" required style="border:1px solid black;border-radius:5px;" value="<?php //echo $_SESSION['name']; ?>" class="col-10">
                                            <label for="email" class="col-12" style="font-weight:bold;"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Email:</label>-->
                                            <input type="hidden" name="email" required style="border:1px solid black;border-radius:5px;" value="<?php echo $_SESSION['email']; ?>" class="col-10">
                                            <input type="hidden"  name="total_price" value="<?php echo $total; ?>" required style="border:1px solid black;border-radius:5px;"  class="col-10">
                                            <label for="phone" class="col-12" style="font-weight:bold;"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Phone:</label> 
                                            <input type="number" id="phone" name="phone_num" placeholder="Phone" required style="border:1px solid black;border-radius:5px;"  class="col-10"><br>
                                            <label for="address" class="col-12" style="font-weight:bold;"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;Address</label>
                                            <textarea name="address" id="address" required style="border:1px solid black;border-radius:5px;width:85%;height:150px;" placeholder="Address"></textarea>
                                            <div class="row mt-2">
                                              <div class="col-sm-12 col-md-5">
                                                <label for="city" class="" style="font-weight:bold;">&nbsp;City:</label>
                                                <input type="text" id="city" name="city" required style="border:1px solid black;border-radius:5px;" placeholder="City" class="city_input">
                                              </div>
                                              <div class="col-sm-12 col-md-5 pincode">
                                                <label for="pincode" class="" style="font-weight:bold;">&nbsp;Pincode:</label>
                                                <input type="number" id="pincode" required name="pincode" style="border:1px solid black;border-radius:5px;" placeholder="Pincode" class="pincode_input">
                                              </div>
                                            </div>
                                            <br>
                                            <h6 style="font-weight:bold;text-decoration:underline;">Payment Type:</h6>
                                            <label for="cod" style="font-weight:bold;">COD</label>
                                            <input type="radio" required name="payment_type" id="cod" value="cod">
                                            <label for="card" style="font-weight:bold;margin-left:30px;">Online</label>
                                            <input type="radio" required name="payment_type" id="card" value="card">
                                            <div class="modal-footer">
                                              <input type="submit" value="Submit" name="submit" class="btn btn-success">
                                            </div> 
                                      </form>
                                    </div>
                                    
                                    <!-- Modal footer -->
                                </div>
                              </div>
                           </div>
                        <!--  -->
                        <button type="button" class="btn btn-warning col-10 col-sm-5 col-md-5 mt-2 mb-2" data-toggle="modal" data-target="#mymodal">Proceed To Checkout</button>
                    </div>
                </div>
                <?php
              }
            }
           ?>
    </div>
  </div>
  <!-- <div id="snackbarR" style="background-color:green;"></div> -->
  <div class="load">
     <img src="images/foodload.gif" width="300px" height="300px">
  </div>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  </body>
  <script>
    $(document).ready(function(){
      setTimeout(() => {
        $(".load").fadeOut("slow");
      }, 1000);
    })
    // function remove(str)
    // {
    //   var x = document.getElementById("snackbarR");
    //   // var x = document.getElementById("divcard");
    //   /*cart*/
    //    var xhttp = new XMLHttpRequest();
    //    xhttp.onreadystatechange = function()
    //    {
    //      if(xhttp.readyState==4 && xhttp.status==200)
    //      {
    //         x.innerHTML = xhttp.responseText;
    //      }
    //    }
    //    xhttp.open('GET','cartRemove.php?removeitem='+str,true);
    //    xhttp.send();
    //   /*-----*/
    //   x.className = "show";
    //   setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    // }
  </script>
</html>
<?php
}
?>
<?php
require_once('connect.php');
require_once('googleLogin/config.php');
if(!isset($_SESSION['access_token']))
{
  header('Location:http://localhost/fprjct/index.php');
}
else
{
?>
<html>
  <head>
    <?php require('links.php'); ?>
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
           $query = "SELECT * FROM `cartitems` WHERE `email` = '$email'";
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
                <table class="table table-hover table-bordered mt-2 ">
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
                <tr>
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
                            $total = 0;
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
                        <button class="btn btn-warning col-10 col-sm-5 col-md-5 mt-2 mb-2">Proceed To Checkout</button>
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
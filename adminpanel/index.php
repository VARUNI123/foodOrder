<?php


  require_once('../connect.php');
  require_once('../googleLogin/config.php');
  date_default_timezone_set('Asia/Kolkata');
  $date =  date(DATE_COOKIE).' '.date('a');
  // echo $date;
  $md = md5($date);
  // echo '<br>'.$md;
  $dbauth = isset($_SESSION['userid']);
  if($dbauth)
  {
      $usertype = $_SESSION['usertype'];
      if($usertype==="user")
      {
          header('Location:http://localhost/fprjct/index.php');
          die;
      }
      else if(($usertype!="user") && $usertype!="admin")
      {
        header('Location:resAdmin.php');
        die;
      }
      require_once('resAdd.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<title>Admin Panel</title>

<?php 
  require('../links.php');
  require('../connect.php');
?>
<style>
    html
    {
        scroll-behavior:smooth;   
    }
    body {
      font-family: "Lato", sans-serif;
    }

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background:#171c24;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.topbar
{
  height:70px;
  width:100%;
  background:#171c24;
}
.drpdown-content
{
  display:none;
  right:5px;
  margin-top:5px;
  position:absolute;
  background-color: #f1f1f1;
  width: 250px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index:1;
}
.drpdown-content a
{
  display:block;
  text-decoration:none;
  color:black;
  padding:12px 16px;
}
.drpdown-content a:hover
{
  color:orange;
}
.drpbtn:hover .drpdown-content {display:block;}

.icards:hover
{
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
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
  z-index: 999999;
  left: 50%;
  transform:translateX(-18%); 
  bottom: 30px;
  }


  #snackbar.show,#snackbarR.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
  }

  @-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
  }

  @keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
  }

  @-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
  }

  @keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
  }


@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<?php require('adminNav.php'); ?>

<div class="container-fluid mt-2">
<div class="row">
        <!-- column -->
        <div class="col-sm-12 col-lg-4">
            <div class="card  bg-light icards m-1">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-4">
                            <small>Page Viewers</small>
                            <h4 class="mb-0">20000</h4>
                        </div>
                        <div class="chart ml-auto">
                        <span class="fa fa-star "></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- column -->
        <div class="col-sm-12 col-lg-4">
            <div class="card bg-danger icards m-1">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-4">
                            <small>Items Added</small>
                            <h4 class="mb-0">10</h4>
                        </div>
                        <div class="chart ml-auto">
                        <span class="fa fa-star "></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- column -->
        <div class="col-sm-12 col-lg-4">
            <div class="card bg-success icards m-1">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-4">
                            <small>Active Users</small>
                            <?php
                                $uquery="SELECT `email` FROM `login` ORDER BY `userid`";
                                if($uqurn = mysqli_query($conn,$uquery)){
                                    $ucount = mysqli_num_rows($uqurn);
                                }
                            ?>
                            <h4 class="mb-0"><?php echo $ucount; ?></h4>
                        </div>
                        <div class="chart ml-auto">
                        <span class="fa fa-star "></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-md mt-3">
  <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Details</h4>
                            <p class="card-subtitle">Overview of Customer Details</p>
                        </div>
                        <div class="ml-auto">
                          <div class="dl">
                            <?php
                            ?>
                                 <select class="form-control bg-light" data-role="select-dropdown" id="tstamp" onchange="showTime(this.value)";>
                                    <option value="" selected="">All</option>
                                    <option value="monthly" >Monthly</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                </select>
                          </div>
                        </div>
                    </div>
                    <!-- title -->
                </div>
                <div class="container-md">
    <div class="table-responsive" id="timefilter">
      <?php
         $orderid_list = array();
         $dbauth = isset($_SESSION['userid']);
         $dbemail = isset($_SESSION['dbemail']);
         $dquery = "SELECT * FROM `billing`";
         if($dqurn = mysqli_query($conn,$dquery)){
            $dnum = mysqli_num_rows($dqurn);
            if($dnum > 0){
                while($drow = mysqli_fetch_assoc($dqurn))
                  {
                    $orderid_list[] = $drow['order_id'];
                  }
            }
         }
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
         foreach($orderid_list as $value){
         $query = "SELECT * FROM `billing` WHERE `order_id`='$value' ORDER BY `added_on` DESC";
         if($qrun = mysqli_query($conn,$query))
         {
           $num = mysqli_num_rows($qrun);
           if($num<1)
           {
            echo '<div style="display:flex;align-items:center;justify-content:center;height:100%;"><a href="#"><button class="btn btn-primary">Nothing ordered yet...</button></a></div>'; 
            }
           else
           {
                  while($row = mysqli_fetch_assoc($qrun))
                  {
                    ?>
                    <tr>
                      <td><a href="orderedItems.php?order_id=<?php echo $value ?>" class="btn btn-warning"><?php echo $row['order_id']; ?></a></td>
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
           }
        }
    }
                ?>
              </table>
    </div>
  </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
              <!-- column -->
              <div class="col-lg-6">
            <div class="card ">
                <div class="card-body">
                    <h4 class="card-title">Current Details</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered font-size-sm">
                            <thead>
                                <tr class="text-uppercase">
                                    <th class="font-w700">Customer MailID</th>
                                    <th class="d-sm-table-cell font-w700">Date</th>
                                    <th class="font-w700">Order Status</th>
                                    <th class="d-sm-table-cell font-w700 text-right" style="width: 120px;">Price</th>
                                    <th class="font-w700 text-center" style="width: 60px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                              foreach($orderid_list as $value){
                                $query = "SELECT * FROM `billing` WHERE `order_id`='$value' ORDER BY `added_on` DESC";
                                if($qrun = mysqli_query($conn,$query))
                                {
                                  $num = mysqli_num_rows($qrun);
                                  if($num<1)
                                  {
                                  echo '<div style="display:flex;align-items:center;justify-content:center;height:100%;"><a href="#"><button class="btn btn-primary">Nothing ordered yet...</button></a></div>'; 
                                  }
                                  else
                                  {
                                        while($row = mysqli_fetch_assoc($qrun))
                                        {
                        ?>
                                <tr>
                                    <td>
                                        <span class="font-w600"><?php echo $row['email']; ?></span>
                                    </td>
                                    <td class="d-sm-table-cell">
                                        <span class="font-size-sm text-muted"><?php echo $row['added_on']; ?></span>
                                    </td>
                                    <td>
                                        <span class="font-w600 text-warning"><?php echo $row['order_status']; ?></span>
                                    </td>
                                    <td class="d-sm-table-cell text-right">
                                        Rs.<?php echo $row['total_price'];?>
                                    </td>
                                    <td class="text-center">
                                      <a href=""style="color:black;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php
                                  }
                          }
                        }
                    }
                    ?>
                                  </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column -->
         <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ANALYTICS</h4>
                    <?php 
                         $restArr = [];
                         $count = [];
                         $q1 = "SELECT * FROM `restaurants`";
                         if($qr1 = mysqli_query($conn,$q1))
                         {
                             while($row = mysqli_fetch_assoc($qr1))
                             {
                                 $restArr[] = $row['name'];
                             }
                         }
                         foreach($restArr as $restaurant)
                         {
                            // $qr = "SELECT * FROM `cartitems` WHERE `restaurant`='$restaurant'";
                            $qr = "SELECT `order_id` FROM `cartitems` WHERE `restaurant`='$restaurant' AND `item_status`=1 GROUP BY `order_id`";
                            if($qrun = mysqli_query($conn,$qr))
                            {
                                $count[] = mysqli_num_rows($qrun);
                                // echo $count[0].'<br>';
                            }
                         }

                         for($i=0;$i<count($restArr);$i++)
                         {
                             $datapoints[] = array("label"=>$restArr[$i], "y"=>$count[$i]);
                         }
                        ?>
                    <script>
                        var restaurants = <?php echo json_encode($restArr); ?>;
                        var count = <?php echo json_encode($count) ?>;
                        window.onload = function () {
                            var chart = new CanvasJS.Chart("tree", {
                                title:{
                                    text: "Orders for Restaurants"              
                                },
                                data: [              
                                {
                                    // Change type to "doughnut", "line", "splineArea", etc.
                                    type: "column",
                                    dataPoints:<?php echo json_encode($datapoints); ?>
                                }
                                ]
                            });
                            chart.render();
                        }
                    </script>
                    <div id="tree" style="height:800px;"></div>
                </div>
             </div>
         </div>
     </div>

     <div class="row mt-2" id="restaurant">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <h3 class="m-4" style="text-decoration:underline;">Restaurants Details</h3>
                        <div id="sample" style="display:none;"></div>
                        <div class="ml-auto">

                            <!--Billing Modal-->
                                <div class="modal fade" id="mymodal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h3 class="modal-title ml-3" style="font-weight:bold;">Add Restaurant Details</h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <div class="modal-body" style="">
                                                <form action="index.php" method="POST" enctype="multipart/form-data">
                                                    <label for="name" class="col-12" style="font-weight:bold;"><i class="fa fa-cutlery" aria-hidden="true"></i>&nbsp;Restaurant Name:</label> 
                                                    <input type="text" id="name" name="res_name" placeholder="Restaurant Name" required  style="border:1px solid black;border-radius:5px;"  class="col-10"><br>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-12 col-md-5">
                                                            <label for="phone" class="" style="font-weight:bold;"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Phone:</label>
                                                            <input type="number" id="phone" name="phone_num" placeholder="Phone" required style="border:1px solid black;border-radius:5px;"  class=""><br>
                                                        </div>
                                                        <div class="col-sm-12 col-md-5">
                                                            <label style="font-weight:bold;"><i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;<span style="font-size:80%;">Image of Restaurant:</span></label>
                                                            <input type="file"  name="image" id="image" required>
                                                        </div>
                                                    </div>
                                                    <label for="address" class="col-12" style="font-weight:bold;"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;Address</label>
                                                    <textarea name="address" id="address"  style="border:1px solid black;border-radius:5px;width:85%;height:150px;" placeholder="Address" required></textarea>
                                                      <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                        <!-- <button onclick="add(document.getElementById('name').value,document.getElementById('phone').value,document.getElementById('image').value,document.getElementById('address').value)" class="btn btn-success">Add+</button> -->
                                                        <button class="btn btn-success" type="submit" name="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <!-- <div class="modal-footer"> -->
                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                <!-- <button onclick="add(document.getElementById('name').value,document.getElementById('phone').value,document.getElementById('image').value,document.getElementById('address').value)" class="btn btn-success">Add+</button> -->
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            <!--  -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mymodal">Upload a Restaurant</button>
                        </div>
                    </div>
                </div>
                <div class="container-md">
                    <div class="table-responsive">
                        <?php include('restaurants.php'); ?>
                    </div>
                </div>
              </div>
          </div>
       </div>
</div>

<div id="snackbar" style="background-color:green;"></div>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

$(document).ready(function(){
      setTimeout(() => {
        $(".load").fadeOut("slow");
      }, 1000);

      $(document).on('click','.action',function(){
        var restaurant = $(this).data('restaurant');
        var res_status = $(this).data('res_status');
        var action = "change_status";
        // alert(res_status+","+restaurant);
        $("#sample").html('');
        // if(confirm("Are you sure want to change status?"))
        // {
            $.ajax({
                url:"resAdd.php",
                method:"POST",
                data:{restaurant:restaurant,res_status:res_status,action:action},
                success:function(data)
                {
                    if(data!="")
                    {
                        // load_user_data();
                        $("#sample").html(data);
                    }
                    location.reload();
                }
            });

        // }
        // else
        // {
        //     return false;
        // }
      });
    });

    function showTime(str)
    {
      // alert(str);
     
       var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
      {
        if(xhttp.readyState==4 && xhttp.status==200)
        {
          document.getElementById("timefilter").innerHTML= xhttp.responseText;
        }
      }
    
      xhttp.open('GET','stime.php?tstamp='+str+'&resName=all',true);
      xhttp.send();
    }

</script>
   
</body>
</html> 
<?php
  }
  else
  {
      header('Location:http://localhost/fprjct/index.php');
  }
?>
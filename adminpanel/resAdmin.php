<?php
session_start();
require_once('../connect.php');

$dbauth = isset($_SESSION['userid']);
if($dbauth){
    $resName = $_SESSION['usertype'];
    if($_SESSION['usertype']=='user') {
        header('Location:http://localhost/fprjct/index.php');
    }
    elseif($_SESSION['usertype']=='admin'){
        header('Location:http://localhost/fprjct/adminpanel/index.php');
    }
    require('itemAdd.php');
}
else
{
  header('Location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <?php require_once('../links.php');?>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>    
    
    
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    

	
<style>
    
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
<?php require_once('adminNav.php'); ?>
      <?php
         $orderid_list = [];
         $dbauth = isset($_SESSION['userid']);
         $dbemail = isset($_SESSION['dbemail']);
         $dquery = "SELECT * FROM `cartitems` WHERE `order_id`!='pending' and `restaurant`='$resName' GROUP BY `order_id`";
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
                               <select class="form-control bg-light" data-role="select-dropdown" id="tstamp" onchange="showTime(this.value,'<?php echo $resName; ?>')";>
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
            <div class="table-responsive" id ="timefilter">
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
          $query = "SELECT * FROM `billing` WHERE `order_id`='$value' ORDER BY `added_on`";
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
                                  <th class="font-w700">Date</th>
                                  <th class="font-w700">Order Status</th>
                                  <th class="font-w700 text-right" style="width: 120px;">Price</th>
                                  <th class="font-w700 text-center" style="width: 60px;">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                        <?php
                           foreach($orderid_list as $orderid){
                            $query = "SELECT * FROM `billing` WHERE `order_id`='$orderid' ORDER BY `added_on` DESC";
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

        <!--column -->
                <!-- Column -->
          <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ANALYTICS</h4>
                    <?php 
                           $restArr = [];
                           $count = [];
                           $q1 = "SELECT DISTINCT(citem) FROM `cartitems` WHERE `item_status`= 1";
                           if($qr1 = mysqli_query($conn,$q1))
                           {
                               while($row = mysqli_fetch_assoc($qr1))
                               {
                                   $itemArr[] = $row['citem'];
                               }
                           }
                           foreach($itemArr as $item)
                           {
                              // $qr = "SELECT * FROM `cartitems` WHERE `restaurant`='$restaurant'";
                              $qr = "SELECT `order_id` FROM `cartitems` WHERE `restaurant`='$resName' AND `item_status`=1 AND `citem`='$item' GROUP BY `order_id`";
                              if($qrun = mysqli_query($conn,$qr))
                              {
                                  $count[] = mysqli_num_rows($qrun);
                                 
                              }
                           }
                         
                           for($i=0;$i<count($itemArr);$i++)
                           {
                               $datapoints[] = array("label"=>$itemArr[$i], "y"=>$count[$i]);
                           }
                        ?>
                    <script>
                        var restaurants = <?php echo json_encode($itemArr); ?>;
                        var count = <?php echo json_encode($count) ?>;
                        window.onload = function () {
                            var chart = new CanvasJS.Chart("tree", {
                                title:{
                                    text: "Orders for Restaurant"              
                                },
                                data: [              
                                {
                                    // Change type to "doughnut", "line", "splineArea", etc.
                                    type: "bar",
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
                      <h3 class="m-4" style="text-decoration:underline;">Food items details</h3>
                      <div id="sample" style="display:none;"></div>
                      <div class="ml-auto">

                          <!--Billing Modal-->
                              <div class="modal fade" id="mymodal">
                                  <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                      
                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                          <h3 class="modal-title ml-3" style="font-weight:bold;">Add Food Item Details</h3>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          
                                          <!-- Modal body -->
                                          <div class="modal-body" style="">
                                              <form action="resAdmin.php" method="POST" enctype="multipart/form-data">
                                                  <input type="hidden" name="restaurant" required style="border:1px solid black;border-radius:5px;" value="<?php echo $resName; ?>" class="col-10">
                                                  <label for="name" class="col-12" style="font-weight:bold;"><i class="fa fa-glass" aria-hidden="true"></i>&nbsp;Food item name:</label> 
                                                  <input type="text" id="name" name="item_name" placeholder="Item Name" required  style="border:1px solid black;border-radius:5px;"  class="col-10"><br>
                                                  <div class="row mt-2">
                                                      <div class="col-sm-12 col-md-5">
                                                        <div class="form-group" style="width:100%;">
                                                          <p style="font-weight:bold;font-size:90%;"><i class="fa fa-cutlery" aria-hidden="true"></i>&nbsp;Item Type:</p>
                                                          <select class="form-control bg-light" data-role="select-dropdown" id="itemtype" name="itemtype" required>
                                                            <option value="" selected>Choose Item Type</option>
                                                            <?php 
                                                              $queryRes = "SELECT `title` FROM `categories` WHERE `type`='Categories'";
                                                              if($qrunRes = mysqli_query($conn,$queryRes))
                                                              {
                                                                while($resRow = mysqli_fetch_assoc($qrunRes))
                                                                {
                                                                  ?>
                                                                  <option value="<?php echo $resRow['title']; ?>"><?php echo $resRow['title']; ?></option>
                                                                  <?php
                                                                }
                                                              }
                                                            ?>
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-12 col-md-5">
                                                          <label style="font-weight:bold;"><i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;<span style="font-size:80%;">Image of an Item:</span></label>
                                                          <input type="file"  name="image" id="image" required>
                                                      </div>
                                                  </div>
                                                  <label for="description" class="col-12" style="font-weight:bold;"><i class="fa fa-sticky-note" aria-hidden="true"></i>&nbsp;Description about food item:</label>
                                                  <textarea name="description" id="description"  style="border:1px solid black;border-radius:5px;width:85%;height:100px;" placeholder="Description" required></textarea>
                                                  <div class="row">
                                                      <div class="col-sm-12 col-md-5">
                                                        <p style="font-weight:bold;font-size:100%;">&nbsp;Food Type:</p>
                                                        <div class="form-group" style="width:100%;">
                                                          <select class="form-control bg-light" data-role="select-dropdown" id="foodType" name="foodType" required>
                                                            <option value="" selected>Choose Food Type</option>
                                                            <option value="veg">Veg</option>
                                                            <option value="nonVeg">Non-Veg</option>
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-12 col-md-5">
                                                          <label for="cost" style="font-weight:bold;">&nbsp;<span style="font-size:100%;">Cost of an Item:</span></label>
                                                          <input type="number" id="cost" name="cost" required>
                                                      </div>
                                                  </div>
                                                    <!-- Modal footer -->
                                                  <div class="modal-footer">
                                                      <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                      <!-- <button onclick="add(document.getElementById('name').value,document.getElementById('itemtype').value,document.getElementById('description').value,document.getElementById('foodType').value,document.getElementById('cost').value)" class="btn btn-success">Submit</button> -->
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
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mymodal">Upload a Food item</button>
                      </div>
                  </div>
              </div>
              <div class="container-md">
                  <div class="table-responsive">
                  <?php
                      $query="SELECT * FROM `fooditems` WHERE `restaurant`= '$resName'";
                      if($qrun = mysqli_query($conn,$query))
                      {
                        $num = mysqli_num_rows($qrun);
                        if($num<1)
                        {
                          echo '<button class="btn btn-primary">No items are added into this restaurant..!</button>'; 
                        }
                        else
                        {
                          ?>
                            <table class="table table-hover table-bordered">
                              <thead>
                                <tr>
                                  <th>Sl.No</th>
                                  <th>Image</th>
                                  <th>Food Item</th>
                                  <th>Description</th>
                                  <th>Item type</th>
                                  <th>Food type</th>
                                  <th>Cost</th>
                                  <th>Action</th>
                                  <th>Update</th>
                                  <th>To Delete</th>
                                </tr>
                              </thead>
                              <?php
                              $i=1;
                                while($row = mysqli_fetch_assoc($qrun))
                                {
                                  ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src="../<?php echo $row['image']; ?>" alt="" height="150px" width="200px"></td>
                                    <td><p class="table-det"><?php echo $row['item']; ?></p></td>
                                    <td><p class="table-det"><?php echo $row['description']; ?></p></td>
                                    <td><p class="table-det"><?php echo $row['itemType']; ?></p></td>
                                    <td><p class="table-det"><?php echo $row['ftype']; ?></p></td>
                                    <td><p class="table-det"><?php echo $row['cost']; ?></p></td>
                                    <?php
                                    if($row['item_status']==1)
                                    {
                                      ?>
                                        <td><button class="btn btn-danger action"  type="button" name="action" data-item="<?php echo $row['item']; ?>" data-item_status="<?php echo $row['item_status'] ?>">Disable</button></td>                                      <?php
                                    }
                                    else
                                    {
                                      ?>
                                        <td><button class="btn btn-success action"  type="button" name="action" data-item="<?php echo $row['item']; ?>" data-item_status="<?php echo $row['item_status'] ?>">Enable</button></td>                                      <?php
                                    }
                                    ?>
                                    <td><button class="btn btn-warning">Update</button></td>
                                    <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                  </tr>
                                  <?php
                                  $i++;
                                }
                              ?>
                            </table>
                            <script>
                            </script>
                          <?php
                        }
                      }
                      ?>
                  </div>
              </div>
            </div>
        </div>
     </div>
</div>
<div id="snackbar" style="background-color:green;"></div>

  <script>

      function showTime(str,resName)
      {
        // alert(str+" "+resName);
      
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
          if(xhttp.readyState==4 && xhttp.status==200)
          {
            document.getElementById("timefilter").innerHTML= xhttp.responseText;
          }
        }
      
        xhttp.open('GET','stime.php?tstamp='+str+'&resName='+resName,true);
        xhttp.send();
      }

      $(document).ready(function(){
        $(document).on('click','.action',function(){
          var restaurant ='<?php echo $resName;?>';
          var item_status = $(this).data('item_status');
          var item = $(this).data('item');
        //  alert(restaurant+item+item_status);

          var action = "change_status";
          $("#sample").html('');
              $.ajax({
                  url:"itemAdd.php",
                  method:"POST",
                  data:{restaurant:restaurant,item_status:item_status,item:item,action:action},
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
        });
      });



      function openNav() 
      {
        document.getElementById("mySidenav").style.width = "250px";
      }
      function closeNav()
      {
        document.getElementById("mySidenav").style.width = "0";
      }
  </script>
</body>
</html>
<?php
require('../connect.php');
require_once('../googleLogin/config.php');
if(!isset($_SESSION['userid']))
{
  header('Location:../index.php');
}

$tstamp = $_GET['tstamp'];
$restName = $_GET['resName'];

if($restName=="all"){
  
    if($tstamp == "daily")
    {
    $query = "SELECT * FROM `billing` WHERE added_on > DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
    }
    elseif($tstamp == "monthly")
    {
        $query = "SELECT * FROM `billing` WHERE added_on > DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
    }
    elseif($tstamp == "weekly")
    {
        $query =  "SELECT * FROM `billing` WHERE added_on > DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
    }
    elseif($tstamp == ""){
        $query = "SELECT * FROM `billing`";
    }
  }
  else{
   
    if($tstamp == "daily")
    {
    // $query = "SELECT * FROM `billing` WHERE added_on > DATE_SUB(CURDATE(), INTERVAL 1 DAY) INTERSECT SELECT `order_id` FROM `cartitems` WHERE `restaurant` = '$restName'";
    $query = "SELECT *
    FROM billing 
    LEFT JOIN cartitems
    ON cartitems.order_id = billing.order_id WHERE cartitems.restaurant='$restName' AND billing.added_on > DATE_SUB(CURDATE(), INTERVAL 1 DAY) GROUP BY billing.order_id";  
    }
    elseif($tstamp == "monthly")
    {
      // $query = "SELECT `order_id` FROM `billing` WHERE added_on > DATE_SUB(CURDATE(), INTERVAL 30 DAY) INTERSECT SELECT `order_id` FROM `cartitems` WHERE `restaurant` = '$restName'";
      $query = "SELECT *
      FROM billing 
      LEFT JOIN cartitems
      ON cartitems.order_id = billing.order_id WHERE cartitems.restaurant='$restName' AND billing.added_on > DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY billing.order_id";  
    }
    elseif($tstamp == "weekly")
    {
      // $query = "SELECT `order_id` FROM `billing` WHERE added_on > DATE_SUB(CURDATE(), INTERVAL 7 DAY) INTERSECT SELECT `order_id` FROM `cartitems` WHERE `restaurant` = '$restName'";
      $query = "SELECT *
      FROM billing 
      LEFT JOIN cartitems
      ON cartitems.order_id = billing.order_id WHERE cartitems.restaurant='$restName' AND billing.added_on > DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY billing.order_id";  
    }
    elseif($tstamp == ""){
        // $query = "SELECT `order_id`,`email` FROM `billing` INTERSECT SELECT  `order_id`,`email` FROM `cartitems` WHERE `restaurant` = '$restName'";
        $query = "SELECT *
        FROM billing 
        LEFT JOIN cartitems
        ON cartitems.order_id = billing.order_id WHERE cartitems.restaurant='$restName' GROUP BY billing.order_id";  
      }
  }
?>
<div class="table-responsive" id="timefilter">
     
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
    }
}
else{
  echo mysqli_error($conn);
}
       ?>
     </table>
</div>
</div>
   </div>
</div>
</div>

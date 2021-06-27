<?php
require('connect.php');
require_once('googleLogin/config.php');
$cat = $_GET['category'];
$type = $_GET['ftype'];
//echo "<h1>".$cat."</h1>";
if($type=="")
{
//  $query = "SELECT * FROM `catdetails` WHERE `category`='$cat'";
// $query = "SELECT * FROM `fooditems` WHERE `itemType`='$cat'";
 $query = "SELECT * FROM `fooditems` WHERE `itemType`='$cat' GROUP BY `item` ORDER BY `id`";
 if($qrun = mysqli_query($conn,$query))
 {
   while($row = mysqli_fetch_assoc($qrun))
   {
     echo '<div class="card col-sm-5 col-md-5 icards">';
     echo '<div class="card-body">';
     echo '<section style="float:left">';
     echo '<img src="'.$row['image'].'" alt="" width="150px" height="150px">';
     echo '</section>';
     echo '<div>';
     echo '<h6 class="card-title" style="">'.$row['item'].'</h6>';
     echo '<div style="height:70px;overflow:auto;">';
     echo '<p class="card-text" style="">'.$row['description'].'</p>';
     echo '</div>';
     ?>
              <!--  Modal  -->
                <div class="modal fade" id="<?php echo str_replace(" ","",$row['item']); ?>">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title ml-3">Select Categories</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body" style="display:flex;justify-content:center;">
                          <div class="card" style="width:400px;">
                            <img class="card-img-top" src="<?php echo $row['image']; ?>" alt="Card image" style="width:100%;height:250px;">
                            <div class="card-body" style="display:flex;flex-wrap:wrap;">
                              <h4 class="card-title text-center"><?php echo $row['item']; ?></h4>
                              <!-- <p class="card-text"><?php //echo $row['description']; ?></p> -->
                              <!-- Choosing a Restaurant -->
                                <div class="form-group" style="width:100%;">
                                    <select class="form-control bg-light" data-role="select-dropdown" id="res<?php echo $row['item']; ?>">
                                      <option value="" selected>Choose a Restaurant</option>
                                      <?php 
                                        $queryRes = "SELECT `restaurant` FROM `fooditems` WHERE `item`='".$row['item']."' AND `itemType`='$cat'";
                                        if($qrunRes = mysqli_query($conn,$queryRes))
                                        {
                                          while($resRow = mysqli_fetch_assoc($qrunRes))
                                          {
                                            ?>
                                            <option value="<?php echo $resRow['restaurant']; ?>"><?php echo $resRow['restaurant']; ?></option>
                                            <?php
                                          }
                                        }
                                      ?>
                                    </select>
                                </div>
                            <!-- ----------------------------------------   -->
                              <input class="" style="width:100%" type="number" placeholder="Quantity" id="quan<?php echo $row['item']; ?>" name="quan<?php echo $row['item']; ?>">
                          </div>
                          </div>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                          <button onclick="add('<?php echo $row['item']; ?>',document.getElementById('quan<?php echo $row['item']; ?>').value,<?php echo $row['cost']; ?>,'<?php echo $row['image']; ?>',document.getElementById('res<?php echo $row['item']; ?>').options[document.getElementById('res<?php echo $row['item']; ?>').selectedIndex].value)" class="btn btn-warning">Add+</button>
                        </div> 
                    </div>
                  </div>
               </div>
        
                <!--  -->
           <span class="badge badge-primary ml-2"><?php echo $row['rating']; ?></span>
           <span class="badge badge-danger ml-2">Rs.<?php echo $row['cost']; ?></span>
           <div style="float:right;margin-bottom:0px;margin-top:5px;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo str_replace(" ","",$row['item']); ?>">Proceed to Cart</button>
              <!-- <button onclick="add('<?php //echo $row['item']; ?>',document.getElementById('quan<?php //echo $row['item']; ?>').value,<?php //echo $row['cost']; ?>,'<?php //echo $row['image']; ?>',document.getElementById('res<?php //echo $row['item']; ?>').options[document.getElementById('res<?php //echo $row['item']; ?>').selectedIndex].value)" class="btn btn-secondary">Add+</button> -->
           </div>
     <?php
    //  echo '<div style="float:right;margin-bottom:0px;">';
    //  echo '<button onclick="add();" class="btn btn-secondary" style="">Add+</button>';
    //  echo '</div>';
     echo '</div>';
     echo '</div>';
     echo '</div>';
   }
 }
}
else
{
// $query = "SELECT * FROM `catdetails` WHERE `category`='$cat' AND `ftype`='$type'";
$query = "SELECT * FROM `fooditems` WHERE `itemType`='$cat' AND `fType`='$type' GROUP BY `item` ORDER BY `id`";
if($qrun = mysqli_query($conn,$query))
{
  while($row = mysqli_fetch_assoc($qrun))
  {
    echo '<div class="card col-sm-5 col-md-5 icards">';
    echo '<div class="card-body">';
    echo '<section style="float:left">';
    echo '<img src="'.$row['image'].'" alt="" width="150px" height="150px">';
    echo '</section>';
    echo '<div>';
    echo '<h6 class="card-title" style="">'.$row['item'].'</h6>';
    echo '<div style="height:70px;overflow:auto;">';
    echo '<p class="card-text" style="">'.$row['description'].'</p>';
    echo '</div>';
    ?>
          <!--  Modal  -->
               <div class="modal fade" id="<?php echo str_replace(" ","",$row['item']); ?>">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title ml-3">Select Categories</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body" style="display:flex;justify-content:center;">
                          <div class="card" style="width:400px;">
                            <img class="card-img-top" src="<?php echo $row['image']; ?>" alt="Card image" style="width:100%;height:250px;">
                            <div class="card-body" style="display:flex;flex-wrap:wrap;">
                              <h4 class="card-title text-center"><?php echo $row['item']; ?></h4>
                              <!-- <p class="card-text"><?php //echo $row['description']; ?></p> -->
                              <!-- Choosing a Restaurant -->
                                <div class="form-group" style="width:100%;">
                                    <select class="form-control bg-light" data-role="select-dropdown" id="res<?php echo $row['item']; ?>">
                                      <option value="" selected>Choose a Restaurant</option>
                                      <?php 
                                        $queryRes = "SELECT `restaurant` FROM `fooditems` WHERE `item`='".$row['item']."' AND `itemType`='$cat'";
                                        if($qrunRes = mysqli_query($conn,$queryRes))
                                        {
                                          while($resRow = mysqli_fetch_assoc($qrunRes))
                                          {
                                            ?>
                                            <option value="<?php echo $resRow['restaurant']; ?>"><?php echo $resRow['restaurant']; ?></option>
                                            <?php
                                          }
                                        }
                                      ?>
                                    </select>
                                </div>
                            <!-- ----------------------------------------   -->
                              <input class="" style="width:100%" type="number" placeholder="Quantity" id="quan<?php echo $row['item']; ?>" name="quan<?php echo $row['item']; ?>">
                          </div>
                          </div>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                          <button onclick="add('<?php echo $row['item']; ?>',document.getElementById('quan<?php echo $row['item']; ?>').value,<?php echo $row['cost']; ?>,'<?php echo $row['image']; ?>',document.getElementById('res<?php echo $row['item']; ?>').options[document.getElementById('res<?php echo $row['item']; ?>').selectedIndex].value)" class="btn btn-warning">Add+</button>
                        </div> 
                    </div>
                  </div>
               </div>
        
                <!--  -->
           <span class="badge badge-primary ml-2"><?php echo $row['rating']; ?></span>
           <span class="badge badge-danger ml-2">Rs.<?php echo $row['cost']; ?></span>
           <div style="float:right;margin-bottom:0px;margin-top:5px;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo str_replace(" ","",$row['item']); ?>">Proceed to Cart</button>
              <!-- <button onclick="add('<?php //echo $row['item']; ?>',document.getElementById('quan<?php //echo $row['item']; ?>').value,<?php //echo $row['cost']; ?>,'<?php //echo $row['image']; ?>',document.getElementById('res<?php //echo $row['item']; ?>').options[document.getElementById('res<?php //echo $row['item']; ?>').selectedIndex].value)" class="btn btn-secondary">Add+</button> -->
           </div>
    <?php
    // echo '<div style="float:right;margin-bottom:0px;">';
    // echo '<button onclick="add();" class="btn btn-secondary" style="">Add+</button>';
    // echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
}
}
?>
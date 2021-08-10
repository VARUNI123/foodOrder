<?php

$query = "SELECT * FROM `restaurants`";
if($qrun = mysqli_query($conn,$query))
{
  $num = mysqli_num_rows($qrun);
  if($num<1)
  {
   echo '<button class="btn btn-primary">Nothing ordered yet... Click here to order</button>'; 
   }
  else
  {
    ?>
     <table class="table table-hover table-bordered">
       <thead>
         <tr>
           <th>Sl.No</th>
           <th>Image</th>
           <th>Restaurant Name</th>
           <th>Phone</th>
           <th>Address</th>
           <th>Action</th>
         </tr>
       </thead>
       <?php
       $i=1;
         while($row = mysqli_fetch_assoc($qrun))
         {
           ?>
           <tr>
             <td><?php echo $i; ?></td>
             <td><img src="../<?php echo $row['images']; ?>" alt="" height="150px" width="200px"></td>
             <td><p class="table-det"><?php echo $row['name']; ?></p></td>
             <td><p class="table-det"><?php echo $row['phone']; ?></p></td>
             <td><p class="table-det"><?php echo $row['address']; ?></p></td>
             <?php
             if($row['res_status']==1)
             {
               ?>
                         <td><button class="btn btn-danger action"  type="button" name="action" data-restaurant="<?php echo $row['name']; ?>" data-res_status="<?php echo $row['res_status'] ?>">Disable</button></td>
               <?php
             }
             else
             {
                ?>
                         <td><button class="btn btn-success action"  type="button" name="action" data-restaurant="<?php echo $row['name']; ?>" data-res_status="<?php echo $row['res_status'] ?>">Enable</button></td>
               <?php
             }
             ?>
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
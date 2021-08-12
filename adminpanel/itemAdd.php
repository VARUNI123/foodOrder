<?php
  require_once('../connect.php');

  if(isset($_POST['submit']))
{
  if(!empty($_POST['restaurant']) && !empty($_POST['item_name']) && !empty($_POST['itemtype']) && !empty($_FILES['image']['name']) && !empty($_POST['description']) &&!empty($_POST['foodType']) && !empty($_POST['cost']))
  {
    $restaurant = $_POST['restaurant'];
    $item_name = $_POST['item_name'];
    $itemtype = $_POST['itemtype'];
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = '../images/'.str_replace(" ","",$itemtype).'/';
    $img_new_name = $location.$img_name;
    $img_location = 'images/'.str_replace(" ","",$itemtype).'/'.$img_name;
    $description = $_POST['description'];
    $foodType = $_POST['foodType'];
    $cost = $_POST['cost'];

    $squery = "SELECT * FROM `restaurants` WHERE `name`='$restaurant'";
    if($sqrun = mysqli_query($conn,$squery))
    {
      while($srow = mysqli_fetch_assoc($sqrun))
      {
        $i_status = $srow['res_status'];
      }
    }

    $query1 = "SELECT * FROM `fooditems` WHERE `item` = '$item_name' AND `restaurant`='$restaurant'";
    if($qrun1 = mysqli_query($conn,$query1))
    {
      $num = mysqli_num_rows($qrun1);
      if($num<1)
      {
        $query2 = "INSERT INTO `fooditems` (item,description,itemType,restaurant,image,ftype,cost,item_status) VALUES ('$item_name','$description','$itemtype','$restaurant','$img_location','$foodType',$cost,$i_status)";
        if(!empty($img_name))
        {
          if(move_uploaded_file($tmp_name,$img_new_name))
          {
            if(mysqli_query($conn,$query2))
            {
              echo '<div id="snackbar" style="display:block;
              min-width: 250px;
              margin-left: -125px;
              background-color: green;
              color: #fff;
              text-align: center;
              border-radius: 2px;
              padding: 16px;
              position: fixed;
              z-index: 999999;
              left: 50%;
              transform:translateX(-18%); 
              bottom: 30px;">
              Added to the database successfully..!
            </div>
            <script> 
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            window.location = "resAdmin.php";
            </script>';
            }
          }
        }
      }
      else
      {
        echo '<div id="snackbar" style="display:block;
        min-width: 250px;
        margin-left: -125px;
        background-color: green;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 999999;
        left: 50%;
        transform:translateX(-18%); 
        bottom: 30px;">
        This Item is already added..!
      </div>
      <script> 
      var x = document.getElementById("snackbar");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      window.location = "resAdmin.php";
      </script>';
      }
    }

  }
  else
  {
    echo "<script>alert('Please fill all the requirements..!');window.location='resAdmin.php';</script>";
  }
}




  if(isset($_POST['action']))
  {
    if($_POST['action']=="change_status")
    {
      // $status = "";
      $item_status = $_POST['item_status'];
      $restaurant = $_POST['restaurant'];
      $item = $_POST['item'];
      if($_POST['item_status']==1)
      {
        $item_status = 0 ;
        // $status = "Inactive";
      }
      else
      {
        $item_status = 1 ;
        // $status = "Active";
      }
      $rquery1 = "UPDATE `fooditems` SET `item_status`=$item_status WHERE `item`='$item' AND `restaurant`='$restaurant' ";
      if(mysqli_query($conn,$rquery1))
        {
          echo '<div class="alert alert-success">User status has been set to '.$status.'</div>';
        }
    }
  }
?>
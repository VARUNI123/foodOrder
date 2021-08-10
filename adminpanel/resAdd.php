<?php
require('../connect.php');

// if(isset($_POST['res_name']) && isset($_POST['phone']) && isset($_FILES['image']['name']) && isset($_POST['address']))
if(isset($_POST['submit']))
{
  if(!empty($_POST['res_name']) && !empty($_POST['phone_num']) && !empty($_FILES['image']['name']) && !empty($_POST['address']))
  {
    $res_name = $_POST['res_name'];
    $phone = $_POST['phone_num'];
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = '../images/restaurant/';
    $img_new_name = $location.$img_name;
    $img_location = "images/restaurant/".$img_name;
    $address = $_POST['address'];

    $query1 = "SELECT * FROM `restaurants` WHERE `name` = '$res_name'";
    if($qrun1 = mysqli_query($conn,$query1))
    {
      $num = mysqli_num_rows($qrun1);
      if($num<1)
      {
        $query2 = "INSERT INTO `restaurants` (name,images,address,phone,res_status) VALUES ('$res_name','$img_location','$address',$phone,1)";
        $query3 = "INSERT INTO `categories` (title,image,type,res_status) VALUES ('$res_name','$img_location','Restaurants',1)";
        if(!empty($img_name))
        {
          if(move_uploaded_file($tmp_name,$img_new_name))
          {
            if(mysqli_query($conn,$query2) && mysqli_query($conn,$query3))
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
            window.location = "index.php";
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
        This Restaurant is already added..!
      </div>
      <script> 
      var x = document.getElementById("snackbar");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      window.location = "index.php";
      </script>';
      }
    }

  }
  else
  {
    echo "<script>alert('Please fill all the requirements..!');</script>";
  }
}


if(isset($_POST['action']))
{
  if($_POST['action']=="change_status")
  {
    // $status = "";
    $res_status = $_POST['res_status'];
    $restaurant = $_POST['restaurant'];
    if($_POST['res_status']==1)
    {
      $res_status = 0 ;
      // $status = "Inactive";
    }
    else
    {
      $res_status = 1 ;
      // $status = "Active";
    }
    $rquery1 = "UPDATE `restaurants` SET `res_status`=$res_status WHERE `name`='$restaurant' ";
    $rquery2 = "UPDATE `categories` SET `res_status`=$res_status WHERE `title`='$restaurant' AND `type`='Restaurants' ";
    if(mysqli_query($conn,$rquery1) && mysqli_query($conn,$rquery2))
      {
        echo '<div class="alert alert-success">User status has been set to '.$status.'</div>';
      }
  }
}
?>


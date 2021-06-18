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
      .profile
      {
        margin-top:100px;
      /*  display:flex;
        justify-content:center;*/
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
      /* z-index:999999; */
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
  <div class="profile">
     <div class="icard">
      <div class="card col-sm-5 col-md-8 icards">
        <img src="<?php echo $_SESSION['picture']; ?>" alt="trending" >
        <div class="card-body">
          <div class="card-content">
            <div class="card-title"><h4><?php echo $_SESSION['name']; ?></h4></div>
            <div class="card-text">
              <p><?php echo $_SESSION['email']; ?></p>
            </div>
          </div>
        </div>
      </div>
   </div>
  </div>
  <div class="container-md" style="">
    <div id="divCard" class="row icard">
    <!-- <div id="divCard" class="row"> -->
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
          echo '<a href="http://localhost/fprjct/categories.php?type=Restaurants"><button class="btn btn-primary">There is nothing in the cart. Click to add..!</button></a>'; 
        }
        else
        {
          while($row = mysqli_fetch_assoc($qrun))
          {
            // if(($row['cost']!="") && ($row['quan']!=""))
            // {
              $cost[] = $row['quan'] * $row['cost'];
            // }
            // else
            // {  
            //   $total = 0;
            // }
          ?> 
           <div class="card col-sm-5 col-md-5 icards">
              <div class="card-body">
                <section style="float:left">
                  <img src="<?php echo $row['image']; ?>" alt="" width="150px" height="140px">
                </section>
                <div>
                  <h6 class="card-title" style=""><?php //echo $row4['title']; ?></h6> 
                  <h6 class="card-title" style=""><?php echo $row['citem']; ?></h6>
                  <!-- <div style="height:70px;overflow:auto;">
                    <p class="card-text" style=""><?php //echo $row4['descrn']; ?></p>
                  </div> -->
                  Quantity:<span class="badge badge-danger"><?php echo $row['quan']; ?></span>
                  <span class="badge badge-danger ml-2">Rs.<?php echo $row['cost']; ?></span><br>
                  Total cost: <span class="badge badge-success mt-4 ml-2">Rs.<?php echo $row['quan'] * $row['cost']; ?></span>
                  <div style="float:right;margin-bottom:0px;">
                   <a href="http://localhost/fprjct/cartRemove.php?removeitem=<?php echo $row['citem']; ?>"><button class="btn btn-danger">Remove</button></a>
                  </div>
                </div>
              </div>
          </div>
          <?php
          }
        }
      }
    ?>
    </div>
  </div>
  <div style="width:100%;border-bottom:2px solid black;color:white;">.</div>
  <div class="container-md">
     <div class="row" style="display:flex;justify-content:center;">
          <h4 class="ml-2 mt-2 col-10 col-sm-5 col-md-5">Total cost: 
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
          <button class="btn btn-warning col-10 col-sm-5 col-md-5 mt-2">Proceed To Buy</button>
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
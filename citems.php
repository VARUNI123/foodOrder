<?php
//session_start();
require_once('googleLogin/config.php');

$_SESSION['url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
				"https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
				$_SERVER['REQUEST_URI'];


$auth = isset($_SESSION['access_token']);
 require('connect.php');
if(isset($_GET['category']))
{
  $cat = $_GET['category'];
}
if(isset($_POST['quantity']))
{
  $quan = $_POST['quantity'];
}
?>
<html>
  <head>
    <?php require('links.php'); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  /*.sidebar
    {
      display:flex;
      flex-direction:column;
      justify-content:center;
    }
    .sidebar div a
    {
      color:white;
      font-size:110%;
    }
    .iSide
    {
      margin-top:80px;
      margin-left:0%;
    }
    .iSide div
    {
      margin-bottom:10px;
    }*/
    .hero
    {
     background-image:url('images/itemHero.jpg');
    }
    #iDrop
    {
      width:50%;
      display:block;
      margin-left:auto;
      margin-right:auto;
      margin-top:10px;
    }

     .card-title{
       margin-bottom:0;
       padding:2px;
       margin-left:40%;
       font-size:20px;
    }
    .card-text
    {
      margin-left:10px;
    }
    .card-body
    {
      margin-bottom:0;
      padding:2px;
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

        @media (min-width: 481px) and (max-width: 767px)
        {
            section img{
                width:125px;
              /*  height:140px;*/
            }
            .card-title{
                font-size:20px;
            }
            .card{
                width:100%;
            }
        }

    @media (min-width: 320px) and (max-width: 480px)
    {
     /* #iDrop
      {
        display:none;
      }*/
      .card-title
      {
        margin-left:130px;
        font-size:20px;
      }
      .card-text
      {
        /*margin-left:130px;*/
      }
       section img
      {
        width:125px;
       /* height:140px;*/
      }
    }
  </style>
  </head>
  <body>
   <!-- <div id="mNav">
   <?php // require('mobileNav.php'); ?>
  </div> -->
  <!-- <div id="lNav">
     //require('navbar.php'); ?>
  </div> -->
  <div>
    <?php require_once('navbarM.php'); ?>
  </div>
   <!-- <div id="itemNav"> -->
   <!-- <nav class="navbar navbar-inverse fixed-top bg-light">
     <a class="navbar-brand" href=""><img src="images/logo.png" height="50px" width="50px"></a>
     <div class="search">
       <form>
         <div>
           <input type="text" class="border border-secondary" placeholder="Search">&nbsp;<i class="fa fa-microphone"></i>
         </div>
       </form>
     </div>
   </nav> -->
  </div>
  <!-- <div class="sidebar">
    <div class="iSide">
     <div class=""><a href="http://localhost/fprjct/index.php"><i class="fa fa-home"></i>&nbsp;Home</a></div>
     <?php
     // if(!$auth)
     // {
      ?>
     <div class=""><a style="text-decoration: none;"  href="http://localhost/fprjct/googleLogin/login.php"><i class="fa fa-sign-in"></i>&nbsp;Login</a></div>
      <?php
     // }
     // else
     // {
      ?>
     <div class=""><a style="text-decoration: none;" href="http://localhost/fprjct/googleLogin/logout.php"><i class="fa fa-pencil-square-o"></i>&nbsp;Sign Out</a></div>
     <div class=""><a style="text-decoration: none;" href="http://localhost/fprjct/profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a>
      <?php
     // }
      ?>
      <div id="openS" class="open" onclick="openSide();">
       <i class="fa fa-arrow-right"></i>
     </div>
    </div>
   </div>
  </div> -->
  <div class="hero">
    <div class="hero-text">
     <?php
       if(!$auth)
       {
       ?>
       <h1 class="text-dark text-center">Enjoy food recipes by ordering from here...!</h1>
      <?php
       }
      else
      {
      ?>
      <h1 class="text-dark text-center">
      <?php 
        echo $_SESSION['name']; 
      ?>
      &nbsp;Enjoy food recipes by ordering from here...!</h1>
      <?php
      }
      ?>
    </div>
  </div>
  <div id="iDrop">
   <div class="form-group">
       <select class="form-control bg-light" data-role="select-dropdown" id="fitem" onchange="showItem(this.value);">
         <option value="" selected>All</option>
         <option value="veg">Vegetarian</option>
         <option value="nonVeg">Non-vegetarian</option>
       </select>
   </div>
  </div>
  <div class="container-lg mt-2">
   <div id="divCard" class="row icard">
     <?php
      //  $query = "SELECT * FROM `fooditems` WHERE `itemType`='$cat'";
      $query = "SELECT * FROM `fooditems` WHERE `itemType`='$cat' GROUP BY `item` ORDER BY `id`";
       if($qrun = mysqli_query($conn,$query))
       {
         while($row = mysqli_fetch_assoc($qrun))
         {
           ?>
    <div class="card col-sm-5 col-md-5 icards">
       <div class="card-body">
         <section style="float:left">
           <img src="<?php echo $row['image']; ?>" alt="" width="150px" height="140px">
         </section>
         <div>
           <h6 class="card-title" style=""><?php echo $row['item']; ?></h6>
           <div style="height:70px;overflow:auto;">
           <p class="card-text" style=""><?php echo $row['description']; ?></p>
           </div>
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
              <!-- <button onclick="add('<?php //echo $row['item']; ?>',document.getElementById('quan<?php //echo $row['item']; ?>').value,<?php //echo $row['cost']; ?>,'<?php //echo $row['image']; ?>',document.getElementById('res<?php echo $row['item']; ?>').options[document.getElementById('res<?php //echo $row['item']; ?>').selectedIndex].value)" class="btn btn-secondary">Add+</button> -->
           </div>
         </div>
       </div>
     </div>
           <?php
         }
       }
     ?>
   </div>
  </div>
  <div style="display:flex;justify-content:center;">
    <div id="snackbar">Signin to continue...</div>
    <div id="snackbarR" style="background-color:green;"></div>
  </div>
  <?php require_once('footer.php'); ?>
  </body>
  <script>
    fCat = "<?php echo $cat; ?>";
    auth = "<?php echo $auth; ?>";
   // alert(fCat);
    function openSide()
     {
       const sidebar = document.querySelector(".sidebar");
       const fa = document.querySelector(".fa-arrow-right");
       sidebar.classList.toggle("active");
       fa.classList.toggle("active");
     }
 /*   function showMitem(str)
    {
      //alert(str);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
      {
        if(xhttp.readyState==4 && xhttp.status==200)
        {
          document.getElementById("divCard").innerHTML= xhttp.responseText;
        }
      }
      xhttp.open('GET','fType.php?category='+fCat+'&ftype='+str,true);
      xhttp.send();
    }*/
    function showItem(str)
    {
      //alert(str);
       var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
      {
        if(xhttp.readyState==4 && xhttp.status==200)
        {
          document.getElementById("divCard").innerHTML= xhttp.responseText;
        }
      }
      xhttp.open('GET','fType.php?category='+fCat+'&ftype='+str,true);
      xhttp.send();
    }
    function add(str,quan,cost,img,restaurant)
    {
      // item = str;
      if(auth!="")
      {
      // window.open("https://google.com",'_blank');
      var x = document.getElementById("snackbarR");
      /*cart*/
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function()
       {
         if(xhttp.readyState==4 && xhttp.status==200)
         {
            x.innerHTML = xhttp.responseText;
         }
       }
       xhttp.open('GET','cartAdd.php?cartitem='+str+'&quan='+quan+'&cost='+cost+'&img='+img+'&res='+restaurant,true);
       xhttp.send();
      /*-----*/
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }
      else
      {
       // alert("Please sign in to continue..!");
        var x = document.getElementById("snackbar");

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }
    }
  </script>
</html>
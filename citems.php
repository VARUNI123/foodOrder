<?php
/*session_start();*/
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
?>
<html>
  <head>
    <?php require('links.php'); ?>
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

#snackbar {
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
  bottom: 30px;
}

#snackbar.show {
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
  <div id="lNav">
    <?php require('navbar.php'); ?>
  </div>
   <div id="itemNav">
   <nav class="navbar navbar-inverse fixed-top bg-light">
     <a class="navbar-brand" href=""><img src="images/logo.png" height="50px" width="50px"></a>
     <div class="search">
       <form>
         <div>
           <input type="text" class="border border-secondary" placeholder="Search">&nbsp;<i class="fa fa-microphone"></i>
         </div>
       </form>
     </div>
   </nav>
  </div>
  <div class="sidebar">
    <div class="iSide">
     <div class=""><a href="http://localhost/fprjct/hpage.php"><i class="fa fa-home"></i>&nbsp;Home</a></div>
     <?php
      if(!$auth)
      {
      ?>
     <div class=""><a style="text-decoration: none;"  href="http://localhost/fprjct/googleLogin/login.php"><i class="fa fa-sign-in"></i>&nbsp;Login</a></div>
      <?php
      }
      else
      {
      ?>
     <div class=""><a style="text-decoration: none;" href="http://localhost/fprjct/googleLogin/logout.php"><i class="fa fa-pencil-square-o"></i>&nbsp;Sign Out</a></div>
     <div class=""><a style="text-decoration: none;" href="http://localhost/fprjct/profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a>
      <?php
      }
      ?>
      <div id="openS" class="open" onclick="openSide();">
       <i class="fa fa-arrow-right"></i>
     </div>
    </div>
   </div>
  </div>
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
      <h1 class="text-dark text-center"><?php echo $_SESSION['name']; ?>&nbsp;Enjoy food recipes by ordering from here...!</h1>
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
       $query = "SELECT * FROM `fooditems` WHERE `itemType`='$cat'";
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
           <div style="float:right;margin-bottom:0px;">
           <button onclick="add();" class="btn btn-secondary">Add+</button>
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
  <div id="snackbar">Signin to continue...</div>
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
    function add()
    {
      if(auth!="")
      {
      window.open("https://google.com",'_blank');
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

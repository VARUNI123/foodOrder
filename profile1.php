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
  </script>
</html>
<?php
}
?>
<?php
require_once('connect.php');
require_once('googleLogin/config.php');

$_SESSION['url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
				"https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
				$_SERVER['REQUEST_URI'];


$auth = isset($_SESSION['access_token']);
if(isset($_GET['type']))
{
  $type = $_GET['type'];
 // echo '<script>alert("'.$type.'")</script>';
}
if($type=="Categories")
{
  $link = 'citems.php?category=';
}
elseif($type=="Restaurants")
{
  $link = 'restaurant.php?name=';
  //$link = 'resSample.php?name=';
}
elseif($type=="Offers"){
  $link = 'oitems.php?otype1=';
}
?>
<!doctype html>
<html>
 <head>
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <?php require('links.php'); ?>
 <style>
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
   <div class="hero">
    <div class="hero-text">
      <?php
       if(!$auth)
       {
       ?>
       <h1 class="text-light text-center">Enjoy food recipes by ordering from here...!</h1>
      <?php
       }
      else
      {
      ?>
      <h1 class="text-light text-center"><?php echo $_SESSION['name']; ?>&nbsp;Enjoy food recipes by ordering from here...!</h1>
      <?php
      }
      ?>
     </div>
  </div>
  <!-- slider -->
<?php require_once('slider.php'); ?>

<div class="container-lg">
  <h4 class="text-secondary cateCrumb"><?php echo $type; ?>-> </h4>
    <div class="row icard">

<?php
 $query = "SELECT * FROM `categories` WHERE `type` = '$type' ";
 if($qrun = mysqli_query($conn,$query))
 {
   while($row = mysqli_fetch_assoc($qrun))
   {
   ?>
    <div class="card col-sm-5 col-md-3 icards">
      <a class="stretched-link text-decoration-none" href="http://localhost/fprjct/<?php echo $link.$row['title']; ?>"></a>
        <img src="<?php echo $row['image']; ?>" alt="trending" height="200px" >
        <div class="card-body">
          <div class="card-content">
            <div class="row">
              <div class="card-title col-7 col-sm-8 col-md-8"><h5><?php echo $row['title']; ?></h5></div>
              <div class="card-text col-3 col-sm-3 col-md-4">
               <p class="badge badge-danger"><?php echo $row['count']; ?></p>
              </div>
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

  <!-- footer -->
  <?php require_once('footer.php'); ?>

  <script type="text/javascript" src="js/slick.js"></script>
  <script type="text/javascript">
    $(".center").slick({
        dots: true,
        infinite:true,
        autoplay: true,
        swipeToSlide: true,
        autoplaySpeed: 1000,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
       {
         breakpoint: 480,
         settings: {
           arrows:true,
           slidesToShow: 1,
           slidesToScroll: 1
           }
       },
       {
         breakpoint: 767,
         settings: {
           arrows:true,
           slidesToShow: 3,
           slidesToScroll: 1
           }
       }
  ]
      });
  </script>
 </body>
</html>
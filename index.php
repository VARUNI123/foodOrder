<?php
 session_start();

$_SESSION['url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
				"https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
				$_SERVER['REQUEST_URI'];


 /*session_start();
 require('googleLogin/gcallback.php');*/
 //require_once('googleLogin/config.php');
 /*if(isset($_SESSION['access_token']))*/
   $auth = isset($_SESSION['access_token']);
?>
<!doctype html>
<html>
 <head>
   <?php require('links.php'); ?>
 <style>
  .hero
  {
    background-attachment:fixed;
  }
 </style>
 </head>
 <body>
  <!-- <div id="mNav">
    <?php //require('mobileNav.php'); ?>
  </div> -->
  <!-- <div id="lNav">
    <?php //require('navbar.php'); ?>
  </div> -->
  <div>
    <?php require_once('navbarM.php'); ?>
  </div>
  <div class="hero">
    <div class="hero-text">
     <?php
      if($auth)
      // if(isset($_SESSION['access_token']))
       {
       ?>
      <h1 class="text-light text-center"><?php echo $_SESSION['name']; ?>&nbsp;Enjoy food recipes by ordering from here...!</h1>
      <?php
       }
      else
      {
      ?>
      <h1 class="text-light text-center">Enjoy food recipes by ordering from here...!</h1>
      <?php
      }
      ?>
    </div>
  </div>
  <!-- slider -->
<?php require_once('slider.php'); ?>

   <div class="container-lg">
    <h4 class="text-center"><span style="border-bottom:2px solid grey;">Collections</span></h4>
    <div class="row icard">
      <div class="card col-sm-5 col-md-3 icards" data-aos="zoom-in-up">
      <a class="stretched-link text-decoration-none" href="#"></a>
        <img src="images/trending.jpg" alt="trending">
        <div class="card-body">
          <div class="card-content">
            <div class="card-title"><h4>Trending</h4></div>
            <div class="card-text">
              <p>Get trending recipes with one click</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card col-sm-5 col-md-3 icards" data-aos="zoom-in-up">
      <a class="stretched-link text-decoration-none" href=""></a>
      <img src="images/near_res.jpg" alt="near by restaurants">
          <div class="card-body">
            <div class="card-content">
              <div class="card-title"><h4>Near by restaurants</h4></div>
                <div class="card-text">
                  <p>Food items from near by restaurants</p>
                </div>
            </div>
          </div>
      </div>
       <div class="card col-sm-5 col-md-3 icards" data-aos="zoom-in-up">
       <a class="stretched-link text-decoration-none" href="#"></a>
        <img src="images/popular.png" alt="popular food items" >
        <div class="card-body">
          <div class="card-content">
            <div class="card-title"><h4>Popular food items</h4></div>
            <div class="card-text">
              <p>The best saled food items list</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card col-sm-5 col-md-3 icards" data-aos="zoom-in-up">
      <a class="stretched-link text-decoration-none" href="#"></a>
        <img src="images/meal.jpg" alt="Meal of the day">
        <div class="card-body">
          <div class="card-content">
            <div class="card-title"><h4>Meal of the day</h4></div>
            <div class="card-text">
              <p>Enjoy meal of the day with loved ones</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card col-sm-5 col-md-3 icards" data-aos="zoom-in-up">
      <a class="stretched-link text-decoration-none" href="#"></a>
        <img src="images/pop_restaurant.jpg" alt="veg">
        <div class="card-body">
          <div class="card-content">
            <div class="card-title"><h4>Popular Restaurants</h4></div>
            <div class="card-text">
              <p>Famous and best food items from popular restaurants</p>
            </div>
          </div>
        </div>
      </div>
       <div class="card col-sm-5 col-md-3 icards" data-aos="zoom-in-up">
       <a class="stretched-link text-decoration-none" href="#"></a>
        <img src="images/bestdeal.jpg" alt="best Deal">
        <div class="card-body">
          <div class="card-content">
            <div class="card-title"><h4>Special Offers</h4></div>
            <div class="card-text">
              <p>Special offers on best food items of the day</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- footer -->
  <?php require_once('footer.php'); ?>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
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

     /*function openSide()
     {
       const sidebar = document.querySelector(".sidebar");
       const fa = document.querySelector(".fa-arrow-right");
       sidebar.classList.toggle("active");
       fa.classList.toggle("active");
     }*/
  </script>
 </body>
</html>
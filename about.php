<?php
require_once('connect.php');
require_once('googleLogin/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About page</title>
    <?php require_once('links.php'); ?>
    <style>
body {
  background-color:  #eee;
}
.about .title {
    margin-bottom: 50px;
    text-transform: uppercase;
    font-family:times;
    margin-bottom:0;
}
.about .card-title{
    text-align:center;
    margin:0;
    padding:0;
    font-size:25px;
}
.about .card-text{
    margin:0;
    padding:0;
}
.about .card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
     
}
.about .card {
    font-size: 1em;
    overflow: hidden;
    padding: 5;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
    margin:20px 0;
}

.about .carousel-indicators li {
    border-radius: 12px;
    width: 12px;
    height: 12px;
    background-color: #404040;
}
.about .carousel-indicators li {
    border-radius: 12px;
    width: 12px;
    height: 12px;
    background-color: #404040;
}
.about .carousel-indicators .active {
    background-color: white;
    max-width: 12px;
    margin: 0 3px;
    height: 12px;
}
.about .carousel-control-prev-icon {
 background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
}

.about .carousel-control-next-icon {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
}
 lex-direction: column;
}

.about .btn {
  margin-top: auto;
}
.about .column{
    width:47%;
    display:inline-block;
    vertical-align:top;
    padding:5px;
}
address{
    margin:0;
    padding:0;
}
.about ul {
  list-style: none;
}

.about .column ul li:before {
  content: "\2714\0020";
  margin:0;
}
    </style>
</head>
<body>
<div class="container about">
  <div class="title h1 text-center">ABOUT</div>
  <!-- Card Start -->
  <div class="card">
    <div class="row ">
    <?php
     $query = "SELECT * FROM `restaurants` WHERE `name` = '$name' ";
     if($qrun = mysqli_query($conn,$query))
     {
       while($row = mysqli_fetch_array($qrun))
       {
       ?>
      <div class="col-md-7 px-3">
        <div class="card-block px-6">
          <h5 class="card-title"><?php echo $name?></h5>
          <p class="card-text">
            <h5><b>CONTACT US</b></h5>
            <br>
            <address><?php
             echo $row['address'];
             echo "<br>";
             echo $row['phone'];
            ?></address>
          </p>
        <?php
       }
            }
        ?>
         <h5><b>SERVICE OPTIONS</b></h5>
          <p class="card-text">
          <div class="column">
          <ul>
           <li> No-contact delivery</li>
           <li>Delivery</li>
           <li> Takeaway</li>
            <li>Dine-in</li>
          </ul>
          </div>
          <div class="column">
          <ul>
           <li> Offerings</li>
           <li>All you can eat</li>
           <li> Dining options</li>
          </ul>
          </div>
          <!-- <div class="column">
          <ul>
           <li>Dessert</li>
           <li>Amenities</li>
           <li> Good for kids</li>
          </ul>
          </div>
        Atmosphere
        Casual
        Cosy
        Crowd
        Groups -->

          </p>
        </div>
      </div>
      <!-- Carousel start -->
      <div class="col-md-5">
        <div id="CarouselTest" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#CarouselTest" data-slide-to="0" class="active"></li>
            <li data-target="#CarouselTest" data-slide-to="1"></li>
            <li data-target="#CarouselTest" data-slide-to="2"></li>

          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block" src="images/about/contact-banner.jpg" alt="" width="400px" height="300px">
            </div>
            <div class="carousel-item">
              <img class="d-block" src="images/about/services.jpg" alt="" width="450px" height="300px">
            </div>
            <div class="carousel-item">
              <img class="d-block" src="images/about/Special.jpg" alt="" width="450px" height="300px">
            </div>
            <a class="carousel-control-prev" href="#CarouselTest" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
            <a class="carousel-control-next" href="#CarouselTest" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
          </div>
        </div>
      </div>
      <!-- End of carousel -->
    </div>
  </div>
  <!-- End of card -->

</div>
<?php
     $query = "SELECT * FROM `restaurants` WHERE `name` = '$name' ";
     if($qrun = mysqli_query($conn,$query))
     {
       while($row = mysqli_fetch_array($qrun))
       {
       ?>

        <div class="mapouter">
          <div class="gmap_canvas">
            <?php echo $row['location'];?>
          </div>
        </div>
        <?php
       }
            }
        ?>
</body>
</html>
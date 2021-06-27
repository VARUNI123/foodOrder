<?php
require_once('connect.php');
require_once('googleLogin/config.php');

$_SESSION['url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
				"https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
				$_SERVER['REQUEST_URI'];

        $auth = isset($_SESSION['access_token']);
if(isset($_GET['name']))
{
  $name = $_GET['name'];
}
?>
<html>
  <head>
    <?php require_once('links.php'); ?>
    <style>

   .rhero
      {
        display:flex;
        align-items:center;
        justify-content:center;
        margin-top:0px;
        height:400px;
        width:100%;
        background-position:center;
        background-repeat:no-repeat;
        background-size:cover;
      }
      .rdet
      {
        display:flex;
        justify-content:center;
      }
       .cont
      {
        margin-left:20%;
      }
      .mitems
      {
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
      }

      .accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: center;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.activeA, .accordion:hover {
  background-color: #ccc;
}

.accordion:after {
  content: '\002B'; 
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.activeA:after {
  content: "\2212";
  }

.panel {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  display:flex;
  /* flex-wrap:wrap; */
  flex-direction:column;
}

#accordionBlock
{
  display:none;
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

    #block
    {
      display:block;
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

/* map styles */
.mapouter{
  position:fixed;
  text-align:center;
  width:100vw;
  height:400px;
}
.gmap_canvas {
    overflow:hidden;
    background:none!important;
    width:100vw;
    height:400px;
}
.gmap_iframe{
  width:100vw!important;
  height:400px!important;
}
.dtitle{
  display:flex;
  justify-content:center;
}
.title{
  background-color:black;
  color:white;
  display:inline-flex;
  width:auto;
  height:50px;
  justify-content:center;
  align-items:center;
  font-size:30px;
  font-weight:1.5rem;
  font-family:times;
  padding:15px;
  margin-top:15px;
  
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
     
     
    @media (min-width: 576px) and (max-width:872px)
      {
        .cont
        {
          margin-left:15%;
        }
        .scont
        {
          margin-top:5px;
        }

      }
      @media (max-width: 575px) {
        .cont{
          margin-left:0%;
        }
        .scont
        {
          margin-top:5px;
        }
        #accordionBlock
        {
          display:block;
        }
        #block
        {
          display:none;
        }
      }
    </style>
  </head>
  <body>
   
  <div>
    <?php require_once('navbarM.php'); ?>
  </div>
  <?php
     $query = "SELECT * FROM `restaurants` WHERE `name` = '$name' ";
     if($qrun = mysqli_query($conn,$query))
     {
       while($row = mysqli_fetch_array($qrun))
       {
       ?>
        <div class="rhero" style="background-image:url('<?php echo $row['images']; ?>');">
          <div class="hero-text">
            <h1 class="text-light text-center"><?php echo $row['name']; ?></h1>
          </div>
        </div>
        <div class="cont">
          <div class="container-lg">
            <div class="row rdet">
              <div class="col-10 col-sm-6 col-md-6">
                <h2><?php echo $row['name'];?></h2>
                <h6 class="text-secondary">Phone.No: <?php echo $row['phone']; ?></h6>
                <h6 class="text-secondary">Rating: <span class="badge badge-primary"><?php echo $row['rating']; ?></span></h6>
              </div>
              <div class="col-10 col-sm-5 col-md-5 mt-1 scont">
                <h5>Status: <span class="badge badge-danger">Closed</span></h5>
                <button class="btn btn-secondary btn-sm">Pre-Order</button>
              </div>
            </div>    
          </div>
       </div>
     <?php
       }
     }
    ?>
    <div class="container-lg mitems mt-2">
      <h3 class="text-secondary">Top Menu Items</h3>
      <div class="container-lg">
        <section class="center slider">
        <?php
            //  $query1 = "SELECT * FROM `catdetails` ORDER BY RAND() LIMIT 6";
             $query1 = "SELECT * FROM `fooditems` WHERE `restaurant`='$name' LIMIT 6";
             if($qrun1 = mysqli_query($conn,$query1))
             {
               while($row1 = mysqli_fetch_assoc($qrun1))
               {
               ?>
              <div class="crd border border-light">
                <div class="crd-body">
                  <img src="<?php echo $row1['image']; ?>" style="width:100%">
                </div>
                <div class="crd-text">
                  <!-- <p class="text-dark"><?php //echo $row1['title']; ?></p> -->
                  <p class="text-dark"><?php echo $row1['item']; ?></p>
                </div>
              </div> 
               <?php
               }
             }
            ?>
        </section>
      </div>
    </div>
    <div class="container-lg mt-5" id="accordionBlock">
        <?php
        $query2 = "SELECT * FROM `categories`";
        if($qrun2 = mysqli_query($conn,$query2))
        {
          while($row2 = mysqli_fetch_assoc($qrun2))
          {
            if($row2['type']=="Categories")
            {
              $cat[] = $row2['title'];
            }
          }
        }
        foreach($cat as $x => $value)
        {
          //  echo $value.'<br>';
          echo '<button class="accordion" style="font-weight:bold;">'.$value.'</button>';
          echo '<div class="panel">';
          echo '<div id="divCard" class="row icard">';
          $query3 = "SELECT * FROM `fooditems` WHERE `itemType`='$value' AND `restaurant`='$name'";
          if($qrun3 = mysqli_query($conn,$query3))
          {
            $num = mysqli_num_rows($qrun3);
            if($num<1)
            {
              echo '<button class="btn btn-primary">Items will be added later..!</button>'; 
            }
            else
            {
            while($row3 = mysqli_fetch_assoc($qrun3))
            {
              echo '<div class="card col-sm-5 col-md-5 icards">';
              echo '<div class="card-body">';
              echo '<section style="float:left;">';
              echo '<img src="'.$row3['image'].'" alt="" width="150px" height="140px">';
              echo '</section>';
              echo '<div>';
              // echo '<h6 class="card-title" style="">'.$row3['title'].'</h6>';
              echo '<h6 class="card-title" style="">'.$row3['item'].'</h6>';
              echo '<div style="height:70px;overflow:auto;">';
              echo '<p class="card-text" style="">'.$row3['description'].'</p>';
              echo '</div>';
              ?>

                <!--  Modal  -->
                <div class="modal fade" id="<?php echo str_replace(" ","",$row3['item']); ?>">
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
                            <img class="card-img-top" src="<?php echo $row3['image']; ?>" alt="Card image" style="width:100%;height:250px;">
                            <div class="card-body" style="display:flex;flex-wrap:wrap;">
                              <h4 class="card-title text-center"><?php echo $row3['item']; ?></h4>
                              <!-- <p class="card-text"><?php //echo $row['description']; ?></p> -->
                              <input class="ml-2" type="number" placeholder="Quantity" id="quan<?php echo $row3['item']; ?>" name="quan<?php echo $row3['item']; ?>">
                          </div>
                          </div>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                          <button onclick="add('<?php echo $row3['item']; ?>',document.getElementById('quan<?php echo $row3['item']; ?>').value,<?php echo $row3['cost']; ?>,'<?php echo $row3['image']; ?>','<?php echo $row3['restaurant']; ?>');" class="btn btn-secondary">Add+</button>
                        </div> 
                    </div>
                  </div>
               </div>
        
                <!--  -->

              <span class="badge badge-primary ml-2"><?php echo $row3['rating']; ?></span>
              <span class="badge badge-danger ml-2">Rs.<?php echo $row3['cost']; ?></span>
              <!-- <input class="ml-2" type="number" placeholder="Quantity" id="quan<?php //echo $row3['item']; ?>" name="quan<?php //echo $row3['item']; ?>"> -->
              <?php
              echo '<div style="float:right;margin-bottom:0px;">';
              ?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo str_replace(" ","",$row3['item']); ?>">Proceed to Cart</button>
              <?php
              echo '</div>'; 
              echo '</div>'; 
              echo '</div>'; 
              echo '</div>'; 
            }
          }
          }
          echo '</div>';
          echo '</div>';
        }
        ?>
    </div>
    <?php
        $query4 = "SELECT * FROM `categories`";
            if($qrun4 = mysqli_query($conn,$query4))
            {
              while($row4 = mysqli_fetch_assoc($qrun4))
              {
                if($row4['type']=="Categories")
                {
                  $catd[] = $row4['title'];
                }
              }
            }
        echo '<div class="container-lg mt-5" id="block">';
        echo '<div id="divCard" class="row icard">';
        foreach($catd as $x => $val)
        {
          echo '<h4 class="col-12 text-center"><span style="border-bottom:1px solid black; font-size:40px;">'.$val.'</span></h4>';
          $query4 = "SELECT * FROM `fooditems` WHERE `itemType`='$val' AND `restaurant`='$name'";
          if($qrun4 = mysqli_query($conn,$query4))
          {
            $num = mysqli_num_rows($qrun4);
            if($num<1)
            {
              echo '<button class="btn btn-primary">Items will be added later..!</button>'; 
            }
            else
            {
            while($row4 = mysqli_fetch_assoc($qrun4))
            {
              ?>
          <div class="card col-sm-5 col-md-5 icards">
              <div class="card-body">
                <section style="float:left">
                  <img src="<?php echo $row4['image']; ?>" alt="" width="150px" height="140px">
                </section>
                <div>
                  <!-- <h6 class="card-title" style=""><?php //echo $row4['title']; ?></h6> -->
                  <h6 class="card-title" style=""><?php echo $row4['item']; ?></h6>
                  <div style="height:70px;overflow:auto;">
                    <p class="card-text" style=""><?php echo $row4['description']; ?></p>
                  </div>

                <!--  Modal  -->
                <div class="modal fade" id="des<?php echo str_replace(" ","",$row4['item']); ?>">
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
                            <img class="card-img-top" src="<?php echo $row4['image']; ?>" alt="Card image" style="width:100%;height:250px;">
                            <div class="card-body" style="display:flex;flex-wrap:wrap;">
                              <h4 class="card-title text-center"><?php echo $row4['item']; ?></h4>
                              <!-- <p class="card-text"><?php //echo $row['description']; ?></p> -->
                            <input class="" style="width:100%" type="number" placeholder="Quantity" id="quanD<?php echo $row4['item']; ?>" name="quanD<?php echo $row4['item']; ?>">
                          </div>
                          </div>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                          <button onclick="add('<?php echo $row4['item']; ?>',document.getElementById('quanD<?php echo $row4['item']; ?>').value,<?php echo $row4['cost']; ?>,'<?php echo $row4['image']; ?>','<?php echo $row4['restaurant']; ?>');" class="btn btn-warning">Add+</button>
                        </div> 
                    </div>
                  </div>
               </div>
                  <span class="badge badge-primary ml-2"><?php echo $row4['rating']; ?></span>
                  <span class="badge badge-danger ml-2">Rs.<?php echo $row4['cost']; ?></span>
                  <div style="float:right;margin-bottom:0px;">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#des<?php echo str_replace(" ","",$row4['item']); ?>">Proceed to Cart</button>
                    <!-- <button onclick="add('<?php //echo $row4['item']; ?>',document.getElementById('quanD<?php //echo $row4['item']; ?>').value,<?php //echo $row4['cost']; ?>,'<?php //echo $row4['image']; ?>','<?php //echo $row4['restaurant']; ?>');" class="btn btn-secondary">Add+</button> -->
                  </div>
                </div>
              </div>
          </div>
              <?php
            }
          }
          }
        }
        echo '</div>';
        echo '</div>';
    ?>
  <div class="dtitle"><span class="title">ABOUT</span></div>
 <?php require_once('about.php');?>
  <div class="dtitle"><span class="title">REVIEWS</span></div>
 <?php require_once('review.php');?>
      <div id="snackbar">Signin to continue...</div>
      <div id="snackbarR" style="background-color:green;"></div>
      <?php require_once('footer.php'); ?>
</body>
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

      auth = "<?php echo $auth; ?>";

      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) 
      {
        acc[i].addEventListener("click", function() {
          this.classList.toggle("activeA");
          var panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          } 
        });
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

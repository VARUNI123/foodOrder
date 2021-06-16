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
        margin-top:60px;
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
/* map styles */
.mapouter{
  position:relative;
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
    <div id="mNav">
      <?php require('mobileNav.php'); ?>
    </div>
    <div id="lNav">
      <?php require('navbar.php'); ?>
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
            <div class="row rdet ">
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
             $query1 = "SELECT * FROM `catdetails` ORDER BY RAND() LIMIT 6";
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
                  <p class="text-dark"><?php echo $row1['title']; ?></p>
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
          $query3 = "SELECT * FROM `fooditems` WHERE `itemType`='$value' && `restaurant`='$name'";
          if($qrun3 = mysqli_query($conn,$query3))
          {
            while($row3 = mysqli_fetch_assoc($qrun3))
            {
              echo '<div class="card col-sm-5 col-md-5 icards">';
              echo '<div class="card-body">';
              echo '<section style="float:left;">';
              echo '<img src="'.$row3['image'].'" alt="" width="150px" height="140px">';
              echo '</section>';
              echo '<div>';
              echo '<h6 class="card-title" style="">'.$row3['item'].'</h6>';
              echo '<div style="height:70px;overflow:auto;">';
              echo '<p class="card-text" style="">'.$row3['description'].'</p>';
              echo '</div>';
              echo '<div style="float:right;margin-bottom:0px;">';
              echo '<button onclick="add();" class="btn btn-secondary">Add+</button>';
              echo '</div>'; 
              echo '</div>'; 
              echo '</div>'; 
              echo '</div>'; 
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
          $query4 = "SELECT * FROM `fooditems` WHERE `itemType`='$val' && `restaurant`='$name'";
          if($qrun4 = mysqli_query($conn,$query4))
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
                  <h6 class="card-title" style=""><?php echo $row4['item']; ?></h6>
                  <div style="height:70px;overflow:auto;">
                    <p class="card-text" style=""><?php echo $row4['description']; ?></p>
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
        }
        echo '</div>';
        echo '</div>';
    ?>
  </div>
  <div class="dtitle"><span class="title">ABOUT</span></div>
 <?php require_once('about.php');?>
  </div>
  </div>
  <div class="dtitle"><span class="title">REVIEWS</span></div>
 <?php require_once('review.php');?>
  </div>
      <div id="snackbar">Signin to continue...</div>
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

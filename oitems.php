<?php
require_once('connect.php');
require_once('googleLogin/config.php');

$_SESSION['url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
				"https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
				$_SERVER['REQUEST_URI'];

        $auth = isset($_SESSION['access_token']);
if(isset($_GET['otype1']))
{
  $otype1 = $_GET['otype1'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers</title>
    <?php require_once('links.php'); ?>
    <style>
    
    .carousel-inner{
        height:450px;
    }
    img{
        object-fit:contain;
        filter:contrast(70%);
    }
    .des{
        background-color:grey;
        padding:0 50px;
    }
    .container{
        margin:auto;
    }
   .otitle{
       /* font-size:30px;
       font-weight:15px; */
       font-family:times;
       text-align:center;
       margin:50px;
   }
   .des{
        background-color:black;
        padding:0 70px;
        box-shadow:rgba(0, 0, 0, 0.75) 0px 5px 15px;
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
      margin:0;
      padding:2px;
    }
    
   
    @media (max-width:800px){
    .carousel-control-prev , .carousel-control-next{
        margin-bottom:80px;
    }
    .otitle{
       font-size:25px;
       font-family:times;
       text-align:center;
       margin: 0px 5px;
   }
   .des{
        background-color:black;
        padding:0 30px;
        box-shadow:rgba(0, 0, 0, 0.75) 0px 5px 15px;
    }
   /* #carouselExampleIndicators .carousel-indicators{
     display:none;
   } */
    }
    </style>
</head>
<body>
<div>
    <?php require_once('navbarM.php'); ?>
  </div>
    <div >
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
  <?php
            $i=0;
             $query1 = "SELECT * FROM `fooditems` WHERE `otype1`='$otype1' LIMIT 6";
             if($qrun1 = mysqli_query($conn,$query1))
             {
               while($row1 = mysqli_fetch_assoc($qrun1))
               {
    ?>
    <div class="carousel-item <?php echo $a = $i==0? "active":"" ;?>" >
      <img class="d-block w-100 h-50" src="<?php echo $row1['image'];?>" alt="First slide" height="400px">
      <?php $i++;?>
    </div>
    <?php
               }
             }
            ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="otitle">
   
    <h1><span class="des">&nbsp;</span><span class="otitle"><b><?php echo $otype1?></b></span><span class="des">&nbsp;</span></h1>
    
</div>
<div class="container-lg mt-5" id="block">
    <div id="divCard" class="row icard">
    <?php
            $i=0;
             $query1 = "SELECT * FROM `fooditems` WHERE `otype1`='$otype1'";
             if($qrun1 = mysqli_query($conn,$query1))
             {
               while($row1 = mysqli_fetch_assoc($qrun1))
               {
    ?>
    <div class="card col-sm-5 col-md-5 icards">
              <div class="card-body">
                <section style="float:left">
                  <img src="<?php echo $row1['image']; ?>" alt="" width="150px" height="130px">
                </section>
                <div>
                  <h6 class="card-title" style=""><?php echo $row1['item']; ?></h6>
                  <div style="height:70px;overflow:auto;">
                    <p class="card-text" style=""><?php echo $row1['description']; ?></p>
                  </div>
                  <span class="badge badge-primary ml-2"><?php echo $row1['rating']; ?></span>
                  <span class="badge badge-danger ml-2">Rs.<?php echo $row1['cost']; ?></span>
                  <input class="ml-2" type="number" placeholder="Quantity" id="quanD<?php echo $row1['item']; ?>" name="quanD<?php echo $row4['item']; ?>">
                  <div style="float:right;margin-bottom:0px;">
                    <button onclick="add('<?php echo $row1['item']; ?>',document.getElementById('quanD<?php echo $row1['item']; ?>').value,<?php echo $row1['cost']; ?>,'<?php echo $row1['image']; ?>');" class="btn btn-secondary">Add+</button>
                  </div>
                </div>
              </div>
          </div>
    <?php
     }
    }
    ?>
    
</body>
</html>
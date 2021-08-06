<?php
$auth = isset($_SESSION['access_token']);
$dbauth = isset($_SESSION['userid']);
if(!$auth && !$dbauth)
{
  header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
   <?php require('links.php'); ?>
   <link href="uidev.css" re="stylesheet">
   <link href="uidev.js" re="stylesheet">
  
   <style>
     .navbar{
       position:absolute;
       background:transparent!important;
       width:100%;
       z-index:10;
       border-bottom: 1px solid rgba(255,255,255,0.3);
     }
     .dropdown a :hover{
      text-decoration: none;
  color:  #20C2F7;
  border-bottom: 2px  solid  #20C2F7 ;
 
     }

     .search-bar{
       position:absolute;
       z-index:1;
       top: 80px;
       width:100%;
       margin-right:0px;
     }
     .input-group>.form-control:focus{
       box-shadow:none;
     }
     .input-group>.form-control{
       margin-right:5px;
     }
     .btn-outline-secondary{
       border-right:1px solid #000;
       border-left:0;
       border-top:0;
       border-bottom:0;
       border-radius:0;
       background-color: #ffffff;
       font-style:
     }
     .btn-outline-secondary:not(:disabled):not(.disabled).active, .btn-outline-secondary:not(:disabled):not(.disabled):active, .show>.btn-outline-secondary.dropdown-toggle {
    color: #000;
    background-color: #ffffff;
    }
    .btn-outline-secondary:hover{
      color:#8a8a8a;
      background-color: #f8f9fa;
    }
    .btn-outline-secondary:focus{
      box-shadow:none!important;

    }
    .navbar-brand{
        padding-right:2%;
    }
    .fa-map-marker-alt{
      padding-right:5px;
      color:#ed1156;
    }
    @media only screen and (max-width:768px){
.smallscreen{
    display:none;
}
form{
    display:block;

    width:70%;
    margin:0 auto;
}
form input{
    font-size:14px!important;
}
} 
@media only screen and(max-width:900px){
form{
    display:block;;
    width:80%;
}
} 
     </style>
  </head>
  <body>
<nav class="navbar navbar-inverse navbar-expand-sm fixed-top bg-light">
   <a class="navbar-brand" href=""><img src="images/logo.png" height="50px" width="50px"></a>
   <div >
   <h2 class=""> <b>FOOD4U</b> </h2>
   </div>
     <div id="collapseId" class="collapse navbar-collapse">
    <ul class="navbar-nav navbar-right mr-auto w-100 justify-content-end">
    <li class="dropdown">
    <?php
      if($auth){
    ?>
        <a style="cursor: pointer;text-decoration: none;color:#ff4584;" href="googleLogin/logout.php">
        <img class="rounded-circle" src="images/mug_2x.jpg" width="30px" height="30px">logout</a>
    <?php
    }
    else if($dbauth){
      ?>
      <a style="cursor: pointer;text-decoration: none;color:#ff4584;" href="googleLogin/logout.php">
        <img class="rounded-circle" src="images/mug_2x.jpg" width="30px" height="30px">logout</a>
    <?php
    }
    ?>
        <a><span class="caret"></span></a>
        
      </li>
      </ul>
   </div>
  </nav>

<section class="search-bar">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <form>
          <div class="p-1 bg-light shadow-sm">
            <div class="input-group">
            <div class="input-group-append">
            <div class="container">
               <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-map-marker-alt"></i>Pulivendula
                    
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i class="fas fa-location"></i>Detect Current Location <br><small>Using GPS</small></a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                    </button>
                  </div>
                </div> 
  </div>
              <input ty="search" placeholder="Search.." class="form-control">
              
              <!-- Example single danger button -->
              
                <div class="input-group-append">
                  <button type="submit" class="btn btn-link"><i class="fa fa-search"></i></button>
              </div>
            </div>
          
        </form>
      </div>
    </div>
  </div>
</section>

</body>
</html>
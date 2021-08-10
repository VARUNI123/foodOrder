<?php
require_once('connect.php');
require_once('googleLogin/config.php');

   $dbauth = isset($_SESSION['userid']);
   if($dbauth)
   {
     $usertype=$_SESSION['usertype'];
     if($usertype==="admin")
     {
       header('Location:adminpanel/index.php');
     }
   }

if(!isset($_SESSION['access_token']) && !isset($_SESSION['userid']))
{
  header('Location:http://localhost/fprjct/index.php');
}
else
{
?>


<!DOCTYPE html>
<html>
<head>
   <?php require('links.php'); ?>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   <title>My Profile</title>
   <link rel="stylesheet" type="text/css" href="css/stylep.css">
   <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet"> 
   
</head>
<body>
   
   <div class="root">
      <div class="grid-container">
  <div class="item1">
   <?php require_once('navprof.php');?>
  </div><!--item1-->
  <div class="item2">
   <div class="heroimg">
 
<div class="left">
      <img src="images/mug_2x.jpg" class="imgcls">
      <div class="det">
                <div color="#FFFFFF" class="name" style=" font-weight: 600;"><h4>
                   <?php 
                   if($auth)
                   {
                     echo $_SESSION['name'];
                   }
                   else
                   {
                      echo $_SESSION['user_name'];
                   }
                  ?>
                </h4></div>
                <div class="loc">
                <i class="symbol" color="#FFFFFF" size="14">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" width="14" height="14" viewBox="0 0 20 20" aria-labelledby="icon-svg-title- icon-svg-desc-" role="img" class="symbol1">
                   <title>location-fill</title>
                    <path d="M10.2 0.42c-4.5 0-8.2 3.7-8.2 8.3 0 6.2 7.5 11.3 7.8 11.6 0.2 0.1 0.3 0.1 0.4 0.1s0.3 0 0.4-0.1c0.3-0.2 7.8-5.3 7.8-11.6 0.1-4.6-3.6-8.3-8.2-8.3zM10.2 11.42c-1.7 0-3-1.3-3-3s1.3-3 3-3c1.7 0 3 1.3 3 3s-1.3 3-3 3z">
                    </path>
                  </svg>
                </i>
                <span class="symbol3">kadapa</span>
              </div><!--loc-->
      </div><!--det-->
                
     
 </div><!---left-->


<div  class="right">
         <button class="btnp" role="button" tabindex="0" aria-disabled="false">
            <span class="follow1">Follow</span>
         </button>
  
      <div class="tviews">
             
    <div class="review">
    0
    <!-- -->
     <span>Reviews</span>
    </div>
    <div class="photo">
      0
      <!-- -->
       <span>Photos</span>
    </div>
    <div class="follower">
      0
    <span>Followers</span>
     </div>
</div> <!---tviews--->
  </div> <!----right-->
</div><!--heroimg-->
   </div><!--item2--->




    <!--sidenav-->
    
    <div class="item3">

    <div class="cardP">
       <ul class="cardP-ul">
          <h4 class="cardP-text">Activity</h4>
          <div class="cardP-in">
             <div class="one"></div>
             <a href="" class="cardP-link">Reviews</a><br>
             <a href="" class="cardP-link">Photos</a><br>
             <a href="" class="cardP-link">Followers</a><br>
             <a href="" class="cardP-link">Recently viewed</a><br>
             <a href="" class="cardP-link">Bookmarks</a><br>
             <a href="" class="cardP-link">Blogposts</a><br>
          </div>
       </ul>
    </div><!--activity-->

     <div class="cardP">
       <ul class="cardP-ul">
          <h4 class="cardP-text">Online Ordering</h4>
          <div class="cardP-in">
             <div  class="two"></div>
             <a href="" class="cardP-link">Order History</a><br>
             <a href="" class="cardP-link">My Addresses</a><br>
             <a href="" class="cardP-link">Fav Orders</a><br>
          </div>
       </ul>
    </div><!--on-order-->

     <div class="cardP">
       <ul class="cardP-ul">
          <h4 class="cardP-text">Payment methods</h4>
          <div class="cardP-in">
             <div  class="three"></div>
             <a href="" class="cardP-link">Zomato Credits</a><br>
             <a href="" class="cardP-link">Manage Wallets</a><br>
             <a href=""class="cardP-link">Manage Cards</a><br>
          </div>
       </ul>
    </div><!--payment-->


     <div class="cardP">
       <ul class="cardP-ul">
          <h4 class="cardP-text">Table Bookings</h4>
          <div class="cardP-in">
             <div  class="four"></div>
             <a href="" class="cardP-link">Your Bookings</a>
          </div>
       </ul>
    


    
</div><!--bookings--->

    







 </div><!--item3--> 
<div class="item4">
   <section class="page">
      <h2 class="page-heading">Reviews</h2>
       
      
   </section><!--page-->
</div><!--item4-->

   
   </div><!--gridcontainer-->
   


<div id="item5"><?php require('footer.php'); ?></div>

  
                     
                 
                  
    
     
      
      
    
    
     
   

   </div><!--root-->

</body>
</html>
<?php
}
?>
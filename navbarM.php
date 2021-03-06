<?php
$dbauth =isset($_SESSION['userid']);
  require_once('connect.php');
  $auth = isset($_SESSION['access_token']);
  $dbauth = isset($_SESSION['userid']);

  if($dbauth)
   {
     $usertype=$_SESSION['usertype'];
     if($usertype==="admin")
     {
       header('Location:adminpanel/index.php');
     }
   }

  if($auth!="")
  {
    $email = $_SESSION['email'];
    $query1 = "SELECT * FROM `cartitems` WHERE `email`='$email' AND `item_status`=0 ";
    if($qrun1 = mysqli_query($conn,$query1))
    {
      $count = mysqli_num_rows($qrun1);
    }
  }
  else if($dbauth!=""){
    $dbemail = $_SESSION['dbemail'];
    $query1 = "SELECT * FROM `cartitems` WHERE `email`='$dbemail' AND `item_status`=0 ";
    if($qrun1 = mysqli_query($conn,$query1))
    {
      $count = mysqli_num_rows($qrun1);
    }
  }
?>
<!DOCTYPE html>
<!-- Created By Code4Education -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Food ordering Website</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">

    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  outline: none;
  box-sizing: border-box;
  font-family: 'Montserrat', sans-serif;
}
/* body{
  background: #f2f2f2;
  background-image: url(images/bg-2.jpg);
  background-size: cover;
  background-position: center;
  min-height: 450px;
  height: 100vh; 
} */
nav{
  background: #171c24;
  /* background:grey; */
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  height: 70px;
  padding: 0 100px;
}
nav .logo{
  color: #fff;
  font-size: 30px;
  font-weight: 600;
  letter-spacing: -1px;
}
nav .nav-items{
  display: flex;
  flex: 1;
  padding: 0 0 0 40px;
}
nav .nav-items li{
  list-style: none;
  padding: 0 15px;
}
nav .nav-items li a{
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  text-decoration: none;
}
nav .nav-items li a:hover{
  color: #ff4584;
}
nav form{
  display: flex;
  height: 40px;
  padding: 2px;
  background: #1e232b;
  min-width: 18%!important; 
  border: 1px solid rgba(155,155,155,0.2);
  border-radius: 36px;

}
nav form .search-data{
  width: 100%;
  height: 100%;
  padding: 0 10px;
  color: #fff;
  font-size: 17px;
  border: none;
  font-weight: 500;
  background: none;
}
nav form button{
  padding: 0 15px;
  color: #fff;
  font-size: 17px;
  background: #26d63b;
  border: none;
  border-radius: 2px;
  border-top-right-radius: 12px;
  border-bottom-right-radius: 12px;
  cursor: pointer;
  transition: .2s all;
}
nav form button:hover{
  background: #2b9638;
}
nav .menu-icon,
nav .cancel-icon,
nav .search-icon{
  width: 40px;
  text-align: center;
  margin: 0 50px;
  font-size: 18px;
  color: #fff;
  cursor: pointer;
  display: none;
}
nav .menu-icon span,
nav .cancel-icon,
nav .search-icon{
  display: none;
}

/*dropdown*/
.dropdown-content
{
  display:none;
  right:5px;
  margin-top:5px;
  position:absolute;
  background-color: #f1f1f1;
  width: 250px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index:1;
}
.dropdown-content a
{
  display:block;
  text-decoration:none;
  color:black;
  padding:12px 16px;
}
.dropdown-content a:hover
{
  color:orange;
}
.drpbtn:hover .dropdown-content {display:block;}

.oref
{
  display:none;
}

@media (max-width: 1245px) {
  nav{
    padding: 0 50px;
  }
}
@media (max-width: 1140px){
  nav{
    padding: 0px;
  }
  nav .logo{
    flex: 2;
    text-align: left;
    font-size:22px;
  }
  nav .nav-items{
    position: fixed;
    z-index: 99;
    top: 70px;
    width: 100%;
    left: -100%;
    height: 100%;
    padding: 10px 50px 0 50px;
    text-align: center;
    background: #14181f;
    display: inline-block;
    transition: left 0.3s ease;
  }
  nav .nav-items.active{
    left: 0px;
  }
  nav .nav-items li{
    line-height: 40px;
    margin: 30px 0;
  }
  nav .nav-items li a{
    font-size: 20px;
  }
  nav form{
    position: absolute;
    top: 80px;
    right: 50px;
    opacity: 0;
    pointer-events: none;
    transition: top 0.3s ease, opacity 0.1s ease;
  }
  nav form.active{
    top: 95px;
    opacity: 1;
    pointer-events: auto;
  }
  nav form:before{
    position: absolute;
    content: "";
    top: -13px;
    right: 0px;
    width: 0;
    height: 0;
    z-index: -1;
    border: 10px solid transparent;
    border-bottom-color: #1e232b;
    margin: -20px 0 0;
  }
  nav form:after{
    position: absolute;
    content: '';
    height: 60px;
    padding: 2px;
    background: #474c55;
    border-radius: 2px;
    min-width: calc(100% + 20px);
    z-index: -2;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }
  nav .menu-icon{
    display: block;
  }
  nav .search-icon,
  nav .menu-icon span{
    display: block;
  }
  nav .menu-icon span.hide,
  nav .search-icon.hide{
    display: none;
  }
  nav .cancel-icon.show{
    display: block;
    color:#26d63b;
  }
}
@media (max-width: 980px){
  nav .menu-icon,
  nav .cancel-icon,
  nav .search-icon{
    margin: 0 20px;
  }
  nav form{
    right: 30px;
  }
}
@media (max-width: 350px){
  nav .menu-icon,
  nav .cancel-icon,
  nav .search-icon{
    margin: 0 10px;
    font-size: 16px;
  }
}
@media (max-width:304px)
{
  .pimage
  {
    width:30px;
    height:30px;
  }
}
@media (max-width:284px)
{
  .oref
  {
     display:block;
  }
  .pimage
  {
    display:none;
  }
}
</style>
  </head>
  <body>
  
    <nav> 
        <div class="menu-icon">
            <span style="color:white;" class="fas fa-bars"></span>
        </div>

      <div class="logo"><a href="index.php" style="text-decoration:none;color:white;">Food4U</a></div>

        <div class="nav-items">
          <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="contactus/contact.php">Contact Us</a></li>
          <?php
            if($auth || $dbauth)
            //if(isset($_SESSION['access_token']))
            {
            ?>
          <li><a href="http://localhost/fprjct/cartDisplay.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; Cart<p class="badge badge-pill badge-success " id ="list"><?php echo $count;?></p></a></li>
          <li><a href="http://localhost/fprjct/googleLogin/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign Out</a></li>
          <li class="oref"><a href="profile.php">Profile</a></a>
          <li class="oref"><a href="order.php">Your order history</a></li>
          <li class="oref"><a href="#">Track order</a></li>
            <?php
            }
           
            else
            {
            ?>
          <li><a href="http://localhost/fprjct/googleLogin/login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Sign In</a></li>
            <?php
            }
            ?>
            </div>
    <div class="search-icon">
        <span class="fas fa-search"></span>
      </div>

      <div class="cancel-icon">
        <span class="fas fa-times"></span>
      </div>

      <form action="#">
        <input type="search" class="search-data" placeholder="Search" required>
        <button type="submit" class="fas fa-microphone"></button>
      </form>
      
      <?php
        if($auth)
        {
        ?>

      
      <!-- <li><a style="text-decoration:none;" href="http://localhost/fprjct/profile.php">&nbsp;<img class="rounded-circle" src="<?php //echo $_SESSION['picture']; ?>" width="50px" height="50px"></a></li> -->
      <li>
        <div class="btn drpbtn">&nbsp;<img class="rounded-circle pimage" src="<?php echo $_SESSION['picture']; ?>" width="50px" height="50px">
          <div class="dropdown-content">
            <a href="profile.php">Profile</a>
            <a href="order.php">Your order history</a>
            <a href="#">Track order</a>
          </div>
        </div>
      </li>
        <?php
        }
        else if($dbauth){
          ?>
           <li>
              <div class="btn drpbtn">&nbsp;<h6 style="color:white;"><?php echo $_SESSION['user_name'];?></h6>
                <div class="dropdown-content">
                  <a href="profile.php">Profile</a>
                  <a href="order.php">Your order history</a>
                  <a href="#">Track order</a>
                </div>
              </div>
            </li>
          <!-- <div>
          <li><a style="text-decoration:none;color:white;" class="drpbtn" href="http://localhost/fprjct/profile.php">&nbsp;<?php //echo $_SESSION['user_name'];?></a></li>
          <div class="dropdown-content">
            <a href="profile.php">Profile</a>
            <a href="order.php">Your order history</a>
            <a href="#">Track order</a>
          </div>
          </div> -->
          <?php
        }
      ?>
    </div>
    </nav>
    <script>
      const menuBtn = document.querySelector(".menu-icon span");
      const searchBtn = document.querySelector(".search-icon");
      const cancelBtn = document.querySelector(".cancel-icon");
      const items = document.querySelector(".nav-items");
      const form = document.querySelector("form");
      menuBtn.onclick = ()=>{
        items.classList.add("active");
        menuBtn.classList.add("hide");
        searchBtn.classList.add("hide");
        cancelBtn.classList.add("show");
      }
      cancelBtn.onclick = ()=>{
        items.classList.remove("active");
        menuBtn.classList.remove("hide");
        searchBtn.classList.remove("hide");
        cancelBtn.classList.remove("show");
        form.classList.remove("active"); 
      }
      searchBtn.onclick = ()=>{
        form.classList.add("active");
        searchBtn.classList.add("hide");
        cancelBtn.classList.add("show");
      }
    </script>
  </body>
</html>



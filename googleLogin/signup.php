<?php
 require('../connect.php');

 if(isset($_POST['submit']))
 {
   if(!empty($_POST['user_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_passw']))
   {
    $username = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_pass = $_POST['confirm_passw'];
    $userid = md5($username);

    if($password===$c_pass)
    {
      $pass = md5($password);
      $que1 = "SELECT `userid`,`name`,`email` FROM `login` WHERE `userid`='$userid' OR `name`='$username' OR `email`='$email'";
      if($quer1 = mysqli_query($conn,$que1))
      {
        $rows = mysqli_num_rows($quer1);
        // echo '<script>alert("'.$rows.'");</script>';
        if($rows>=1)
        {
          echo '<script>alert("Username or email already exists..!!");</script>';
        }
        else
        {
          $que2 = "INSERT INTO `login` (userid,name,password,email,usertype) VALUES ('$userid','$username','$pass','$email','user')";
          if($quer2 = mysqli_query($conn,$que2))
          {
            echo '<script>alert("Submitted");window.open("login.php","_self");</script>'; 
            // header('Location:login.php');
          }
          else{
            echo '<script>alert("Check your details once again..!");</script>';
          }
        }
      }
    }
    else
    {
      echo '<script>alert("Passwords does not match");</script>';
    }
  }
  else
  {
    echo "<script>alert('Please enter correct details');</script>";
  }
 }
?>



<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css"/>
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">

          <!--<form  class="sign-in-form" method="post">
            <h2 class="title">Sign in</h2>
            <div class="input-field" >
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="user_name" method="post"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password"  name="password" method="post"/>
            </div>
            <input type="submit" value="Login" class="btn solid" />
            <p class="social-text">Or Sign in with Google</p>
            <div class="social-media">
             
              <a href="#" class="social-icon">
                <i class="fab fa-google" onclick="window.location=' //echo $google_client->createAuthUrl();?>'"></i>
              </a>
             
            </div>
          </form>-->
          <form  class="sign-up-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2 class="title">Sign up</h2>
            
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="user_name" required/><span class="error">*</span>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="mail@gmail.com" name="email" required/><span class="error">*</span>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="confirm_passw" required/>
            </div>
            <input type="submit" class="btn" value="Sign up" name="submit"/>
          </form>
        </div>
      </div>

      <div class="panels-container">
       <!-- <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Not Registered yet!Click to create your account!
            </p>
            <br><br>-->
           <!-- <button class="btn transparent" type="submit" on-click="signup.php">
              Sign up
            </button>-->
         <!--  <a href="signup.php" id="button" type="submit">Signup</a><br><br>
          </div>
         
        </div>-->
        <!-- <div class="panel right-panel"> -->
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Please sign in to continue and order your favourite dish
            </p><br><br>
            <a href="login.php" id="button" type="submit">Signin</a><br><br>
          </div>
          
        <!-- </div> -->
      </div>
    </div>
    </body>
</html>
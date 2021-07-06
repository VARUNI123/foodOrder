<?php 
session_start();

  require_once("../connect.php");
  // include("functions.php");
  $emailErr=" ";
  $nameErr=" ";
function random_num($length)
{
	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  
  

if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //something was posted

    
    if(isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['confirm_passw'])){
      $user_name = $_POST['user_name'];
      $email=$_POST['email'];
      $password = $_POST['password'];
      $cpassword=$_POST['confirm_passw'];
    }
    $query= "SELECT * FROM `login`";
	  if($qurn=mysqli_query($conn,$query))
    {
		  while($user = mysqli_fetch_assoc($qurn))
         {
			    if((($user['name'] != $user_name) &&($user['password'] != $password)) && (($user['name'] != $user_name) &&($user['email'] != $email)))
			      {
              
              echo '<script>alert("username or email already exists .....!")</script>';
              die();
            }
          }
        }
    if($password == $cpassword){
        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //save to database
            $user_id = random_num(20);
            $query = "INSERT INTO `login` (userid,name,password,email,usertype) VALUES ('$user_id','$user_name','$password','$email','user')";
            if($qurn = mysqli_query($conn, $query)){
              echo "signed in successfully";
              header("Location: login.php");
              die;
            }
        }
        else{
            header("location:signup.php");
        }
      }
      else{    
        echo '<script>alert("please enter valid password and details.....!")</script>';
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
          <form  class="sign-up-form" method="POST" action=" ">
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
            <input type="submit" class="btn" value="Sign up" />
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
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Please sign in to continue and order your favourite dish
            </p><br><br>
            <a href="login.php" id="button" type="submit">Signin</a><br><br>
          </div>
          
        </div>
      </div>
    </div>
<?php
  function pre_r($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
  }
?>
    <!--<script src="app.js"></script>-->
  </body>
</html>

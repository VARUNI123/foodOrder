<?php
session_start();
require_once('../connect.php');
  
function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// $valid="no";


if ($_SERVER["REQUEST_METHOD"]== "POST") {	
    $lname = test_input($_POST["user_name"]);
	// $email = test_input($_POST["email"]);
    $lpassword = test_input($_POST["password"]);
		$password = md5($lpassword);
	// $lcpassword = test_input($_POST["confirm_passw"]);
	
	
	// $query= "SELECT * FROM `login`";
	$query = "SELECT * FROM `login` WHERE `name`='$lname' AND `password`='$password'";
	if($qurn=mysqli_query($conn,$query))
    {
			$row = mysqli_num_rows($qurn);
			if($row===1)
			 {
					while($user = mysqli_fetch_assoc($qurn))
					{
					// if(($user['name'] === $lname) && ($user['password'] === $lpassword))
					
						
						$_SESSION['userid']= $user['userid'];
						$_SESSION['dbemail'] = $user['email'];
						$_SESSION['user_name']=$user['name'];
						$_SESSION['usertype'] = $user['usertype'];
						echo '<script>
							fdbauth = <?php echo $dbauth; ?>;
							fdbmail= <?php echo $dbmail; ?>
							console.log(fdbauth);
							console.log(fdbmail);
						</script>';
						if($user['usertype']=='user')
						{
							$url = $_SESSION['url'];
							// $valid="yes";
							header('Location:'.$url.'');
							die;
						}
						else if($user['usertype'] =='admin')
						{
							// $valid="yes";
							header("Location: ../adminpanel/index.php");
							die;
						}
						else
						{
							header('Location:../adminpanel/resAdmin.php');
							die;
						}
										
					}
			 }
			else
			{
				echo '<script>alert("Invalid username or password..!");window.open("login.php","_self");</script>';
				// header('Location:login.php');
				// die();
			}
		
    }
  //   if($valid=="no"){

	// 	header("location:login.php");
	// 	die();
	// }
	
}
?>
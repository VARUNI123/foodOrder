<?php
session_start();
require_once('../connect.php');
  
function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$valid="no";


if ($_SERVER["REQUEST_METHOD"]== "POST") {	
    $lname = test_input($_POST["user_name"]);
	$email = test_input($_POST["email"]);
    $lpassword = test_input($_POST["password"]);
	$lcpassword = test_input($_POST["confirm_passw"]);
	
	
	$query= "SELECT * FROM `login`";
	if($qurn=mysqli_query($conn,$query))
    {
		while($user = mysqli_fetch_assoc($qurn))
         {
			if(($user['name'] == $lname) &&($user['password'] == $lpassword))
			 {
				 
				$_SESSION['userid']= $user['userid'];
				$_SESSION['dbemail'] = $user['email'];
				$_SESSION['user_name']=$lname;
				echo '<script>
					fdbauth = <?php echo $dbauth; ?>;
					fdbmail= <?php echo $dbmail; ?>
					console.log(fdbauth);
					console.log(fdbmail);
				</script>';
				if($user['usertype']=='user')
				{
					$valid="yes";
					header("Location: ../index.php");
					die;
				}
				else if($user['usertype'] =='admin')
				{
					$valid="yes";
					header("Location: adminpage.php");
					die;
				}
               
			 }
			 
		}
		
    }
    if($valid=="no"){

		header("location:login.php");
		die();
	}
	
}
?>
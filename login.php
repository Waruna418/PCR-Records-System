<?php
session_start();

	include("functions.php");
	include("connection.php");
	
  	#InsertData
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password))
		{
			$query = "select * from users where user_name = '$user_name' limit 1";

			$result = mysqli_query($con,$query);

			if($result){

				if($result && mysqli_num_rows($result) > 0) {
 				
 					$user_data = mysqli_fetch_assoc($result);
 				
 					$pass_en = $user_data['password'];

 					$password_de = "password";

					$decryp_pass =openssl_decrypt($pass_en,"AES-128-ECB",$password_de);

 					if( $decryp_pass == $password){

 				 	$_SESSION['user_id'] = $user_data['user_id'];

 				 	header("location: index.php");
 					 die;
 					}
 					else
 					{
 				echo '<div class="alert alert-danger alert-dismissible fade in" align="center">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    		      <strong>Error!</strong> Wrong username .
  				  </div>';
 					}
 				}
 				else
				{
				echo '<div class="alert alert-danger alert-dismissible fade in" align="center">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    		      <strong>Error!</strong> password or username is wrong . please enter the correct information.
  				  </div>';
				}
			}
	 			
		}else{
				echo '<div class="alert alert-danger alert-dismissible fade in" align="center">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    		      <strong>Error!</strong> Feilds cannot be empty. please enter the relevent information.
  				  </div>';
		}
	}
?>

<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
<meta charset="ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
	integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
		
div.container{
background-color: white;
opacity: 0.9;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
border-radius: 25px;
width: 800px;
}
</style>
</head>
<body style="background-image: url(bg.jpg);">
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div align="center" class="container">
		<h1>Login</h1>
		<br>
		<form method="post">	
	
		<input type="text" name="user_name"placeholder="User Name" class="form-control mb-4 col-8"  >
	
		<input type="password" name="password" placeholder="Password" class="form-control mb-4 col-8"  >
		
		<button type="submit" class="btn btn-info btn-lg">Login</button> <br><br>
	
		<a href="signup.php">Click to Signup</a><br>
		<a style="color: red;"href="forgotpassword.php">Forgot Password?</a><br>
		<a style="color: green;"href="resetpassword.php">Reset Password?</a><br><br>

		</form>
	</div>
</body>
</html>
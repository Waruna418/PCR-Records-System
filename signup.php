<?php 
	session_start();

	include("functions.php");
	include("connection.php");
	
  	#InsertData
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !empty($email))
		{
			$user_id = random_num(20);

			$password_en = "password";
			$encryp_pass =openssl_encrypt($password,"AES-128-ECB",$password_en);
			$query = "insert into users (user_id,user_name,email,password) values('$user_id','$user_name','$email','$encryp_pass')";

			mysqli_query($con,$query);
			header("Location: login.php");
			exit();
		}
		else
		{
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
<title>Sign up</title>
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
		<h1>Sign Up</h1>
			<br>
		<form method="post">	
	
		<input type="text"  name="user_name"placeholder="User Name" class="form-control mb-4 col-8">

		<input type="text" name="email"placeholder="Email" class="form-control mb-4 col-8" >
	
		<input type="password" name="password" placeholder="Password" class="form-control mb-4 col-8">
		
		<input type="submit" class="btn btn-info btn-lg" value="Signup"> <br><br>
	
		<a href="login.php">Click to Login</a><br>
		<a style="color: red;"href="forgotpassword.php">Forgot Password?</a><br>
		<a style="color: green;" href="resetpassword.php">Reset Password?</a><br><br>	
		</form>
	</div>
</body>
</html>
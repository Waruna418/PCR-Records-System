<?php 
	session_start();

	include("functions.php");
	include("connection.php");
	
  	#InsertData
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$email = $_POST['email'];
		$password = $_POST['new_password'];
		$con_pass = $_POST['con_new_password'];
		$old_pass = $_POST['old_password'];

		if(!empty($user_name) && !empty($password) && !empty($email) && !empty($con_pass) && !empty($old_pass))
		{

			$select_que = "Select * from users where user_name = '$user_name' and email = '$email'";

			$selectResult = mysqli_query($con,$select_que);

			if ($selectResult){
				$user_data = mysqli_fetch_assoc($selectResult);

				$old_p = $user_data['password'];

				$password_de = "password";

				$decryp_pass =openssl_decrypt($old_p,"AES-128-ECB",$password_de);

				if($old_pass == $decryp_pass){

					if ($password == $con_pass)
					{
						$searchQuery = "select * from users where user_name = '$user_name' and email = '$email'";
						$searchResult = mysqli_query($con,$searchQuery);

						if ($searchQuery && mysqli_num_rows($searchResult) == 1){	

						$encryp_pass_n = openssl_encrypt($password,"AES-128-ECB", $password_de);

						$query = "update users set password = '$encryp_pass_n' where user_name = '$user_name' and email = '$email'";

						mysqli_query($con,$query);

						echo '<div style="font-size:14;" align="center" class="alert alert-success alert-dismissible fade in">
			    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    			  <strong>Success!</strong> The password has been update to the new password. Please Navigate to Login.
			  				  </div>';
						}
						else{
							echo '<div class="alert alert-danger alert-dismissible fade in" align="center">
			    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    		      <strong>Error!</strong> Wrong user name or email or old password. please enter the correct information. if you need more info please contact the <strong>ADMIN</strong>.
			  				  </div>';
						}
					}
					else
					{
							echo '<div class="alert alert-danger alert-dismissible fade in" align="center">
			    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    		      <strong>Error!</strong> The Passwords are not Matching. Please enter the correct password.
			  				  </div>';
					}

				} 
				else{
					echo '<div class="alert alert-danger alert-dismissible fade in" align="center">
			    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        <strong>Error!</strong> Wrong old password. please enter the correct password. if you need more info please contact the <strong>ADMIN</strong>.
			  		</div>';
				    } 
			}
			
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
<title>Reset Password</title>
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
		<h1>Reset Password</h1>
			<br>
		<form method="post">	
	
		<input type="text"  name="user_name"placeholder="User Name" class="form-control mb-4 col-8">

		<input type="text" name="email"placeholder="Email" class="form-control mb-4 col-8" >

		<input type="password" name="old_password" placeholder="Old Password" class="form-control mb-4 col-8">
	
		<input type="password" name="new_password" placeholder="New Password" class="form-control mb-4 col-8">

		<input type="password" name="con_new_password" placeholder="Confirm New Password" class="form-control mb-4 col-8">
		
		<input type="submit" class="btn btn-info btn-lg" value="Reset Password"> <br><br>
	
		<a href="login.php">Click to Login</a><br><br>	
		</form>
	</div>
</body>
</html>
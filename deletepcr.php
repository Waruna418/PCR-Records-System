<?php 
session_start();	

	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);
	if(isset($_GET['deleteid'])){
		$id = $_GET['deleteid'];
		

		$query = "delete from pcr where s_no = '$id'";
		$result = mysqli_query($con,$query);

		if ($result){
			echo '<div class="alert alert-success alert-dismissible fade in">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			  <strong>Success!</strong> This alert box could indicate a successful or positive action.
  				  </div>';
 			
  	        header("location: pcrlist.php");
  		    

		}else{

			echo '
				 <div class="alert alert-danger alert-dismissible fade in" align="center" id="success-alert">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    		      <strong>Error!</strong> Feilds cannot be empty. please enter the relevent information.
  				  </div>';
		}
	}


?>
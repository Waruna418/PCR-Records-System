<?php 
session_start();	

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	#InsertData
	$s_no = $_GET['updateid'];
	$query_3 = "select * from pcr where s_no='$s_no'";
	$result_3 = mysqli_query($con,$query_3);
	$row = mysqli_fetch_assoc($result_3);

  $emp_no_1 = $row['emp_no'];
	$pcr_name_1= $row['pcr_name'];
	$pcr_no_1= substr($row['pcr_no'],3);
	$page_type_1= $row['page_type'];
	$reason_1= $row['reason'];
	$subject_no_1= $row['subject_no'];


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$emp_no = $row['emp_no'];
		$pcr_name = $_POST['pcr_name'];
		$pcr_no = $_POST['pcr_no'];
		$page_type = $_POST['page_type'];
		$reason = $_POST['reason'];
		$subject_no = $_POST['subject_no'];

		if(!empty($pcr_name) && !empty($pcr_no) && !empty($page_type) && !empty($reason) && !empty($subject_no))
		{
			if($pcr_name == "EC" || $pcr_name == "EU" || $pcr_name == "EM"|| $pcr_name == "ER" )
			{

				if($reason == "Increment" || $reason == "VOP" || $reason == "T/Out" || $reason == "T/In" || $reason == "Pension" || $reason == "Allowance" || $reason == "Maturnity" || $reason == "Restate" ||  $reason == "Interdiction" || $reason == "Other") {
				
				$tempPcrNo = $pcr_name.''.$pcr_no;

				$query_1 = "select * from pcr where emp_no = '$emp_no' limit 1";

				$result_1 = mysqli_query($con,$query_1);

					if($result_1){

						if($result_1 && mysqli_num_rows($result_1) > 0) {
 				
 							$status = "Complete";
 							$query_2 = "update pcr  set status = '$status' where emp_no = '$emp_no'";
 							mysqli_query($con,$query_2);
 						}
 						else
 						{
 							$status = "Incomplete";	
 						}
 				}

			
			$query = "update  pcr  set s_no = '$s_no', emp_no = '$emp_no' ,pcr_name ='$pcr_name' ,pcr_no = '$tempPcrNo',page_type = '$page_type',reason = '$reason',subject_no = '$subject_no',status = '$status' where s_no = '$s_no' ";

			mysqli_query($con,$query);
			echo '<div class="alert alert-success alert-dismissible fade in">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			  <strong>Success!</strong> This alert box could indicate a successful or positive action.
  				  </div>';
  		header("location:pcrlist.php");

				}

			}
			else{
				echo '
				 <div class="alert alert-danger alert-dismissible fade in" align="center" id="success-alert">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    		      <strong>Error!</strong> please enter correct PCR Name.
  				  </div>';
			}

			

		}
		else
		{
			echo '
				 <div class="alert alert-danger alert-dismissible fade in" align="center" id="success-alert">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    		      <strong>Error!</strong> Feilds cannot be empty. please enter the relevent information.
  				  </div>';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Index</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>		
div.container{
background-color: white;
opacity: 0.8;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
border-radius: 25px;
}
</style>
</head>
<body style="background-image: url(bg.jpg);">
<!-- Navigation Bar Start -->	
<div class="container-sm" >
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="pcrlist.php">PCR Rrquest List</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
     <li class="dropdown">
 	 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $user_data['user_name'];?><span class="caret"></span></a>
  	 <ul class="dropdown-menu" role="menu">
		<!--- Put your menu-item here -->
		<li><a href="logout.php" role="option" style="font-weight: bold; color: red;">Logout</a></li>
  	 </ul>
	</li>
    </ul>
  </div>
</nav>
 </div>	
 <!-- Navigation Bar End -->
<br>
<br>
<br>
<br>
 <!-- Form Start -->	 
<div align="center" class="container">
		<h1>PCR Note Update</h1><br>
		<form method="post">
		
		<div class="form-row">	
			<div class="form-group col-md-2">
				<label >Date</label><br>
			</div>
			<div class="form-group col-md-9">
				<input type="text" id="d" name="date"placeholder="Date" class="form-control mb-4 col-6" readonly>
	  	</div>
	  </div>
		 <br>

		<div class="form-row">
					<div class="form-group col-md-2">
						<label>PCR Name</label><br>
					</div>
					<div class="form-group col-md-9">
						<input type="text"  name="pcr_name" title="EC , EU , EM , ER" class="form-control" value="<?php  echo $pcr_name_1;?>" >
					</div>
		</div>
		
	<div class="form-row">
			<div class="form-group col-md-2">
				<label >PCR No.</label>
			</div>
			<div class="form-group col-md-9">
				<input type="text" name="pcr_no"  class="form-control mb-4 col-8" value="<?php  echo $pcr_no_1;?>">
			</div>
	</div>	

	<div class="form-row">
			<div class="form-group col-md-2">
				<label >Page Type.</label>
			</div>
		 	<div class="form-group col-md-9">
				<input type="text"  name="page_type" class="form-control mb-4 col-8" value="<?php  echo $page_type_1;?>">
			</div>
	</div>

	<div class="form-row">
			<div class="form-group col-md-2">
				<label >Reason.</label>
			</div>
			<div class="form-group col-md-9">
				<input type="text" name="reason" class="form-control" value="<?php  echo $reason_1;?>">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-2">
				<label >Subject No.</label>
			</div>
			<div class="form-group col-md-9">
				<input type="text" name="subject_no" placeholder="Subject No." class="form-control mb-4 col-8" value="<?php  echo $subject_no_1;?>">
			</div>
		</div>	

		<div class="form-row">
			<div class="form-group col-md-12" align="center">
				<input type="submit" class="btn btn-info btn-lg" value="Update"> <br><br>
			</div>
		</div>	
		
		</form>
	</div>
 <!-- Form End -->
 <script>
document.getElementById("d").value = Date();
</script>
</body>
</html>
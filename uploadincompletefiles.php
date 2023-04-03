<?php 
session_start();	

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	#InsertData
	$s_no = $_GET['uploadid'];
	$query_3 = "select * from pcr where s_no='$s_no'";
	$result_3 = mysqli_query($con,$query_3);
	$row = mysqli_fetch_assoc($result_3);

  $pcr_no_1 = $row['pcr_no'];
  $serial_no_1 = $row['serial_no'];
	$pcr_name_1= $row['pcr_name'];
	$page_type_1= $row['page_type'];
	$reason_1= $row['reason'];
	$subject_no_1= $row['subject_no'];
	$file1_temp = $row['file1'];
	$file_temp = $row['file'];
	   
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			#file insert	
		 	if(isset($_POST['submit'])){
				if(isset($_FILES['file1'])){
					$s_no_1 = $_GET['uploadid'];

					if (empty($file1_temp) && !empty($file_temp)){
							$pdf = rand(6001,10000)."-".$_FILES['file1']['name'];
				 			$pdf_type = $_FILES['file1']['type'];
				 			$pdf_size = $_FILES['file1']['size'];
				 			$pdf_temp_loc = $_FILES['file1']['tmp_name'];
				 			$pdf_store = "files/".$pdf;
				 			move_uploaded_file($pdf_temp_loc, $pdf_store);

				 			$query_1 = "select * from pcr where s_no = '$s_no_1' limit 1";

				    		$result_1 = mysqli_query($con,$query_1);

					    	if($result_1){

						    	if($result_1 && mysqli_num_rows($result_1) > 0 && !empty($pdf)) {
		 					    	$status = "Complete";
		 				    	}
		 				    	else
		 				    	{
		 					    	$status = "Incomplete";	
		 				    	}
		 		    		}
							
							$query = "update  pcr  set status = '$status', file1 = '$pdf' where s_no = '$s_no' ";

			    		mysqli_query($con,$query);
			    		echo '<div class="alert alert-success alert-dismissible fade in">
		    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    			  <strong>Success!</strong> This alert box could indicate a successful or positive action.
		  				  </div>';

					}else if (!empty($file1_temp) && empty($file_temp)) {
						$pdf = rand(1000,6000)."-".$_FILES['file1']['name'];
		 				$pdf_type = $_FILES['file1']['type'];
		 				$pdf_size = $_FILES['file1']['size'];
		 				$pdf_temp_loc = $_FILES['file1']['tmp_name'];
		 				$pdf_store = "files/".$pdf;
		 				move_uploaded_file($pdf_temp_loc, $pdf_store);

		 				$query_1 = "select * from pcr where s_no = '$s_no_1' limit 1";

		    		$result_1 = mysqli_query($con,$query_1);

				    	if($result_1){
				    		
					    	if($result_1 && mysqli_num_rows($result_1) > 0 && !empty($pdf)) {
	 					    	$status = "Complete";
	 				    	}
	 				    	else
	 				    	{
	 					    	$status = "Incomplete";	
	 				    	}
	 		    		}
						$query = "update  pcr  set status = '$status', file = '$pdf' where s_no = '$s_no' ";

	    			mysqli_query($con,$query);
	    			echo '<div class="alert alert-success alert-dismissible fade in">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			  <strong>Success!</strong> This alert box could indicate a successful or positive action.
  				  </div>';

							}							
 		    		}
  				header("location:pcrlist.php");
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
      <li class="active"><a href="index.php">Home</a></li>
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
		<h1>PCR Note Registration - Upload Incomplete File</h1><br>
		<form method="post" enctype="multipart/form-data">
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
						<label>Serial No</label><br>
					</div>
					<div class="form-group col-md-9">
						<input type="text"  name="emp_no" class="form-control" value="<?php  echo $serial_no_1;?>" readonly >
					</div>
		</div>

		<div class="form-row">
					<div class="form-group col-md-2">
						<label>PCR Name</label><br>
					</div>
					<div class="form-group col-md-9">
						<input type="text"  name="pcr_name" title="EC , EU , EM , ER" class="form-control" value="<?php  echo $pcr_name_1;?> " readonly >
					</div>
		</div>
		
	<div class="form-row">
			<div class="form-group col-md-2">
				<label >PCR No.</label>
			</div>
			<div class="form-group col-md-9">
				<input type="text" name="pcr_no"  class="form-control mb-4 col-8" value="<?php  echo $pcr_no_1;?> " readonly>
			</div>
	</div>	

	<div class="form-row">
			<div class="form-group col-md-2">
				<label >Page Type.</label>
			</div>
		 	<div class="form-group col-md-9">
				<input type="text"  name="page_type" class="form-control mb-4 col-8" value="<?php  echo $page_type_1;?>" readonly>
			</div>
	</div>

	<div class="form-row">
			<div class="form-group col-md-2">
				<label >Reason.</label>
			</div>
			<div class="form-group col-md-9">
				<input type="text" name="reason" class="form-control" value="<?php  echo $reason_1;?>" readonly>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-2">
				<label >Subject No.</label>
			</div>
			<div class="form-group col-md-9">
				<input type="text" name="subject_no" placeholder="Subject No." class="form-control mb-4 col-8" value="<?php  echo $subject_no_1;?>" readonly>
			</div>
		</div>	

	<div class="form-row">
			<div class="form-group col-md-2">
				<label >Upload Incomplete File</label>
			</div>
			<div class="form-group col-md-9">
						<input type="file" name="file1" class="form-control mb-4 col-4" required><br>
			</div>
	</div> 

<div class="form-row">
			<div class="form-group col-md-12" align="center">
				<input type="submit" name ="submit" class="btn btn-info btn-lg" value="Update"> <br><br>
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
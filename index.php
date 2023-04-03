<?php 
session_start();	

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	#InsertData
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$pcr_name = $_POST['pcr_name'];
		$page_type = $_POST['page_type'];
		$reason = $_POST['reason'];
		$subject_no = $_POST['subject_no'];

				#check if the values are empty
				if(!empty($pcr_name)  && !empty($page_type) && !empty($reason) && !empty($subject_no)){

				
					$sql_q = "select serial_no from pcr";
					$sql_q_1 = "select serial_no from pcr order by s_no desc limit 1";

					$sql_result = mysqli_query($con,$sql_q);
					$sql_result_1 = mysqli_query($con,$sql_q_1);
					$year = date("Y"); 
					if($sql_result && mysqli_num_rows($sql_result) == 0) {

						$nos = 1;
						$temp_no_s = $year."/"."00".$nos; 
					}
					if($sql_result_1 && mysqli_num_rows($sql_result_1) == 1) {

						$row = mysqli_fetch_assoc($sql_result_1);
						$temp_serial = substr($row['serial_no'],7);
						$temp_serial_1 = (int) $temp_serial + 1;
						$temp_no_s = $year."/"."00".$temp_serial_1; 
					}

		 			$tempPcrNo = $pcr_name."/".$temp_no_s;

		 				#file insert	
		 				if(isset($_POST['submit'])){
							if(isset($_FILES['file'])){

								$pdf = rand(1000,6000)."-".$_FILES['file']['name'];
		 						$pdf_type = $_FILES['file']['type'];
		 						$pdf_size = $_FILES['file']['size'];
		 						$pdf_temp_loc = $_FILES['file']['tmp_name'];
		 						$pdf_store = "files/".$pdf;
		 						move_uploaded_file($pdf_temp_loc, $pdf_store);	
							}
							if(isset($_FILES['file1'])){

								$pdf1 = rand(6001,10000)."-".$_FILES['file1']['name'];
		 						$pdf_type1 = $_FILES['file1']['type'];
		 						$pdf_size1 = $_FILES['file1']['size'];
		 						$pdf_temp_loc1 = $_FILES['file1']['tmp_name'];
		 						$pdf_store1 = "files/".$pdf1;
		 						move_uploaded_file($pdf_temp_loc1, $pdf_store1);	
							}


		 					$pdf_1_temp = substr($pdf1, strpos($pdf1, "-") + 1);
		 					
		 					if($pdf_1_temp == "" || empty($pdf_1_temp))
		 					{
		 						$Ori_pdf1 = "";
		 					}
		 					else{
		 						$Ori_pdf1 = $pdf1; 	
		 					} 

		 					if(!empty($pdf) && $Ori_pdf1 == ""){
							
		 						$status = "Incomplete";
		 					}
		 					else if(!empty($pdf) && $Ori_pdf1 != "")
		 					{
		 						$status = "Complete";
		 					}
		 					else if(empty($pdf) && $Ori_pdf1 != "")
		 					{
		 						$status = "Incomplete";
		 					}
	
						}

						#insert Query
						$query = "insert into pcr (pcr_name,pcr_no,page_type,reason,subject_no,status,file,file1,serial_no) values('$pcr_name','$tempPcrNo','$page_type','$reason','$subject_no','$status','$pdf','$Ori_pdf1','$temp_no_s')";

						mysqli_query($con,$query);
						$check = "Submit";
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
opacity: 0.9;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
border-radius: 25px;

}
input[type=text] {
  border: 2px solid lightblue;
  border-radius: 6px;
}
input[type=file] {
  border: 2px solid lightblue;
  border-radius: 6px;
}
</style>
<script>
$(document).ready(function(){
  	$("button").click(function(){
    $("#div3").fadeIn(2000);
    $("#div3").fadeOut(2000);
  	});
});
</script>
</head>
<body style="background-image: url(bg.jpg);">

<?php
 if($user_data['user_name'] == "admin" || $user_data['user_name'] == "Admin" || $user_data['user_name'] == "ADMIN")
 {
 	$Btn_Visibility = "";
 }
 else
 {
 	$Btn_Visibility = 'onclick = "return false;"';
 }
?>	
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
		<li><a href="resetpassword.php" role="option" style="font-weight: bold; color: blue;" <?php echo $Btn_Visibility; ?>>Reset Password</a></li>
		<li><a href="logout.php" role="option" style="font-weight: bold; color: red;">Logout</a></li>
  	 </ul>
	</li>
    </ul>
  </div>
</nav>
 </div>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){ 

	if(!empty($pcr_name) && !empty($page_type) && !empty($reason) && !empty($subject_no)){

		if($check == "Submit"){
				echo '<div class="alert alert-success alert-dismissible fade in">
    			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			  <strong>Success!</strong> Record Enterd successfully.	
  				  </div>';
  		}
		}
		else
		{
			echo '
				 <div id="#div3"class="alert alert-danger alert-dismissible fade in" align="center" id="success-alert">
    			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    		     <strong>Error!</strong> Feilds cannot be empty. please enter the relevent information.
  				 </div>';
		}
	}
	
 ?>

 <!-- Navigation Bar End -->
<br>
<br>
 <!-- Form Start -->	 
<div align="center" class="container">
		<h1>PCR Note Registration</h1><br>
		<form action="index.php" method="post" enctype="multipart/form-data">	
	
		<input type="text" id="d" name="date"placeholder="Date" class="form-control mb-4 col-8" readonly> <br>

		<select style="border: 2px solid lightblue; border-radius: 6px;" type="text" name="pcr_name" class="form-control mb-4 col-8">
			  <option value="PCR Name">PCR Name</option>
			  <option value="EC">EC</option>
			  <option value="EU">EU</option>
			  <option value="EM">EM</option>
			  <option value="ER">ER</option>
		</select><br>
	
		<!-- <input type="text" name="pcr_no" placeholder="PCR No." class="form-control mb-4 col-8"><br> -->

		<input type="text"  name="page_type"placeholder="Page Type" class="form-control mb-4 col-8"><br>

		<select style="border: 2px solid lightblue; border-radius: 6px;" type="text" name="reason" class="form-control mb-4 col-8">
			  <option value="PCR Name">Reason</option>
			  <option value="Increment">Increment</option>
			  <option value="VOP">VOP</option>
			  <option value="T/Out">T/Out</option>
			  <option value="T/In">T/In</option>
			  <option value="Pension">Pension</option>
			  <option value="Allowance">Allowance</option>
			  <option value="Maturnity">Maturnity</option>
			  <option value="Restate">Restate</option>
			  <option value="Interdiction">Interdiction</option>
			  <option value="Other">Other</option>
		</select><br>

		<select style="border: 2px solid lightblue; border-radius: 6px;" type="text" name="subject_no" class="form-control mb-4 col-8">
			  <option value="Subject No.">Subject No.</option>
			  <option value="FE-01">FE-01</option>
			  <option value="FE-02">FE-02</option>
			  <option value="FE-03">FE-03</option>
			  <option value="FE-04">FE-04</option>
			  <option value="FE-05">FE-05</option>
			  <option value="FE-06">FE-06</option>
			  <option value="FE-07">FE-07</option>
			  <option value="FE-08">FE-08</option>
			  <option value="FE-09">FE-09</option>
			  <option value="FE-10">FE-10</option>
			  <option value="FE-11">FE-11</option>
			  <option value="FE-12">FE-12</option>
			  <option value="FE-13">FE-13</option>
			  <option value="FE-14">FE-14</option>
			  <option value="FE-15">FE-15</option>
			  <option value="FE-16">FE-16</option>
			  <option value="FE-17">FE-17</option>
			  <option value="FE-18">FE-18</option>
			  <option value="FE-19">FE-19</option>
			  <option value="FE-20">FE-20</option>
			  <option value="FE-21">FE-21</option>
			  <option value="FE-22">FE-22</option>
			  <option value="FE-23">FE-23</option>
			  <option value="FE-24">FE-24</option>
			  <option value="FE-25">FE-25</option>
			  <option value="FE-26">FE-26</option>
			  <option value="FE-27">FE-27</option>
			  <option value="FE-28">FE-28</option>
			  <option value="FE-29">FE-29</option>
			  <option value="FE-30">FE-30</option>
		</select><br>

		<input type="file" name="file" class="form-control mb-4 col-4" required><br>

		<input type="file" name="file1" class="form-control mb-4 col-4"><br>
		
		<button type="submit" class="btn btn-info btn-lg" name="submit" value="Submit">Submit</button><br><br>
		</form>
	</div>
 <!-- Form End -->
 <script>
document.getElementById("d").value = Date();
</script>
</body>
</html>
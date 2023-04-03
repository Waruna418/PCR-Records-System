<?php 			
session_start();	

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PCR LIST</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>		
div.container{
background-color: white;
opacity: 0.8;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
border-radius: 25px;
width: 1500px;
}

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}

input[type=text] {
  border: 3px solid lightblue;
  border-radius: 6px;
}
</style>
</head>
<body style="background-image: url(bg.jpg);">

	<?php 

	if($user_data['user_name'] == "admin" || $user_data['user_name'] == "Admin" || $user_data['user_name'] == "ADMIN")
				 	{
				 		$Btn_Visibility_1 = "";
				 	}
				 	else
				 	{
				 		$Btn_Visibility_1 = 'onclick = "return false;"';
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
		<li><a href="resetpassword.php" role="option" style="font-weight: bold; color: blue;" <?php echo $Btn_Visibility_1; ?>>Reset Password</a></li>
		<li><a href="logout.php" role="option" style="font-weight: bold; color: red;">Logout</a></li>
  	 </ul>
	</li>
    </ul>
  </div>
</nav>
 </div>	
 <!-- Navigation Bar End -->
<br>
<div class="container">
	<h1 align="center"  >PCR Note Registration List</h1>
	<br>
	<div align="center"  >
		<!--   searchBar-start -->
  	<form  method="post">
  	<div class="form-row">	
			<div class="form-group col-md-10">
				<input  type="text" id="d" name="search_text"placeholder="Search"  class="form-control mb-4 col-6">
	  	</div>
	  	<div class="form-group col-md-2">
				<input type="submit" name="search" class="btn btn-primary" value="Search">
				<input type="submit" name="clear" class="btn btn-danger" value="Clear">
			</div>
	  </div>
			<!--   searchBar-end -->	  

  </form>
	</div>
		 <br>
		 <br>
	<table  id="dtDynamicVerticalScrollExample" class="table table-striped" cellspacing="0" >
		<thead>
			<tr>
			<th>No</th>
			<th>Date</th>
			<th>Serial No</th>
			<th>PCR Name</th>
			<th>PCR No</th>
			<th>Page Type</th>
			<th>Reason</th>
			<th>Subject No</th>
			<th>Status</th>
			<th>Uploaded File 1</th>
			<th>Uploaded File 2</th>
			<th>Upload Incomplete File</th>
			<th>Download File 1</th>
			<th>Download File 2</th>
			<th>Update Action</th>
			<th>Delete Action</th>
			</tr>
		</thead>
		<tbody>
			<?php

					if(isset($_POST['search'])){
			
			$search_text_en = $_POST['search_text'];
			$query_search = "select * from pcr where status like '$search_text_en%' or pcr_no like '$search_text_en%' or pcr_name like '$search_text_en%' or reason like '$search_text_en%' or subject_no like '$search_text_en%' or page_type like '$search_text_en%' or date like '$search_text_en%' ";
			
			$result_seach = mysqli_query($con,$query_search);

			if($result_seach)
			{
					if($user_data['user_name'] == "admin" || $user_data['user_name'] == "Admin" || $user_data['user_name'] == "ADMIN")
				 	{
				 		$Btn_Visibility = "";
				 	}
				 	else
				 	{
				 		$Btn_Visibility = 'onclick = "return false;"';
				 	}
			while ($row=mysqli_fetch_assoc($result_seach)) {
					$s_no  = $row['s_no'];
							$date= $row['date'];
							$serial_no = $row['serial_no'];
							$pcr_name= $row['pcr_name'];
							$pcr_no= $row['pcr_no'];
							$page_type= $row['page_type'];
							$reason= $row['reason'];
							$subject_no = $row['subject_no'];
							$status= $row['status'];
							$file = $row['file'];
							$file1 = $row['file1'];
    			
    			if ($status == "Incomplete"){
    				$color_t ='#FD0000';
    			}		
    			else if ($status == "Complete"){
    				$color_t ='#06CD4E ';
    			}
					if ($status == "Incomplete"){
    					$admin = 'onclick = "return false;"';
    				}		
    				else if ($status == "Complete"){
    					$admin = "";
    				}
					echo '
					
						<tr>
							<th scope="row">'.$s_no.'</th>
							<td >'.$date.'</td>
							<td>'.$serial_no.'</td>
							<td>'.$pcr_name.'</td>
							<td>'.$pcr_no.'</td>
							<td>'.$page_type.'</td>
							<td>'.$reason.'</td>
							<td>'.$subject_no.'</td>
							<td style="font-weight: bold; color:'.$color_t.' ;">'.$status.'</td>
							<td>'.$file.'</td>
							<td>'.$file1.'</td>

							<td align="center"><a href="uploadincompletefiles.php?uploadid='.$s_no.'" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span></a></td>
							
							<td align="center"><a style="background-color: green; !important" href="downloadfile.php?file='.$file.'" class="btn btn-primary" download><span class="glyphicon glyphicon-download-alt"></span></a></td>
							
							<td align="center"><a style="background-color: green; !important" '.$admin.' href="downloadfile.php?file='.$file1.'" class="btn btn-primary" download><span class="glyphicon glyphicon-download-alt"></span></a></td>

							<td align="center"><a href="updatepcr.php?updateid='.$s_no.'?" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>

							<td align="center"><a href="deletepcr.php?deleteid='.$s_no.'?" '.$Btn_Visibility.' class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
							</tr>
					';
				}
				}
			}
			else if(isset($_POST['clear']))
			{
					$query_search_c = "select * from pcr";
					$result_seach_c = mysqli_query($con,$query_search_c);

					if($result_seach_c)
					{
					if($user_data['user_name'] == "admin" || $user_data['user_name'] == "Admin" || $user_data['user_name'] == "ADMIN")
				 	{
				 		$Btn_Visibility = "";
				 	}
				 	else
				 	{
				 		$Btn_Visibility = 'onclick = "return false;"';
				 	}
						while ($row=mysqli_fetch_assoc($result_seach_c)) {
					$s_no  = $row['s_no'];
							$date= $row['date'];
							$serial_no = $row['serial_no'];
							$pcr_name= $row['pcr_name'];
							$pcr_no= $row['pcr_no'];
							$page_type= $row['page_type'];
							$reason= $row['reason'];
							$subject_no = $row['subject_no'];
							$status= $row['status'];
							$file = $row['file'];
							$file1 = $row['file1'];

    			
    			if ($status == "Incomplete"){
    				$color_t ='#FD0000';
    			}		
    			else if ($status == "Complete"){
    				$color_t ='#06CD4E ';
    			}
    			if ($status == "Incomplete"){
    					$admin = 'onclick = "return false;"';
    				}		
    				else if ($status == "Complete"){
    					$admin = "";
    				}
					
					echo '
					
						<tr>
							<th scope="row">'.$s_no.'</th>
							<td>'.$date.'</td>
							<td>'.$serial_no.'</td>
							<td>'.$pcr_name.'</td>
							<td>'.$pcr_no.'</td>
							<td>'.$page_type.'</td>
							<td>'.$reason.'</td>
							<td>'.$subject_no.'</td>
							<td style="font-weight: bold; color:'.$color_t.' ;">'.$status.'</td>
							<td>'.$file.'</td>
							<td>'.$file1.'</td>

							<td align="center"><a href="uploadincompletefiles.php?uploadid='.$s_no.'" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span></a></td>
							
							<td align="center"><a style="background-color: green; !important" href="downloadfile.php?file='.$file.'" class="btn btn-primary" download><span class="glyphicon glyphicon-download-alt"></span></a></td>
							
							<td align="center"><a style="background-color: green; !important" '.$admin.' href="downloadfile.php?file='.$file1.'" class="btn btn-primary" download><span class="glyphicon glyphicon-download-alt"></span></a></td>

							<td align="center"><a href="updatepcr.php?updateid='.$s_no.'?" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>

							<td align="center"><a href="deletepcr.php?deleteid='.$s_no.'?" '.$Btn_Visibility.' class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
							</tr>
					';
				}
				}
			}
			else
			{

			$query = "select * from pcr";
			$result = mysqli_query($con,$query);

			if($result)
			{
				if($user_data['user_name'] == "admin" || $user_data['user_name'] == "Admin" || $user_data['user_name'] == "ADMIN")
				 	{
				 		$Btn_Visibility = "";
				 	}
				 	else
				 	{
				 		$Btn_Visibility = 'onclick = "return false;"';
				 	}

				while ($row=mysqli_fetch_assoc($result)) {
					$s_no  = $row['s_no'];
							$date= $row['date'];
							$serial_no = $row['serial_no'];
							$pcr_name= $row['pcr_name'];
							$pcr_no= $row['pcr_no'];
							$page_type= $row['page_type'];
							$reason= $row['reason'];
							$subject_no = $row['subject_no'];
							$status= $row['status'];
							$file = $row['file'];
							$file1 = $row['file1'];
    			
    				if ($status == "Incomplete"){
    					$color_t ='#FD0000';
    				}		
    				else if ($status == "Complete"){
    					$color_t ='#06CD4E ';
    				}

    				if ($status == "Incomplete"){
    					$admin = 'onclick = "return false;"';
    				}		
    				else if ($status == "Complete"){
    					$admin = "";
    				}
					
					echo '
					
						<tr>
							<th scope="row">'.$s_no.'</th>
							<td>'.$date.'</td>
							<td>'.$serial_no.'</td>
							<td>'.$pcr_name.'</td>
							<td>'.$pcr_no.'</td>
							<td>'.$page_type.'</td>
							<td>'.$reason.'</td>
							<td>'.$subject_no.'</td>
							<td style="font-weight: bold; color:'.$color_t.' ;">'.$status.'</td>
							<td>'.$file.'</td>
							<td>'.$file1.'</td>

							<td align="center"><a href="uploadincompletefiles.php?uploadid='.$s_no.'" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span></a></td>
							
							<td align="center"><a style="background-color: green; !important" href="downloadfile.php?file='.$file.'" class="btn btn-primary" download><span class="glyphicon glyphicon-download-alt"></span></a></td>
							
							<td align="center"><a style="background-color: green; !important" '.$admin.' href="downloadfile.php?file='.$file1.'" class="btn btn-primary" download><span class="glyphicon glyphicon-download-alt"></span></a></td>

							<td align="center"><a href="updatepcr.php?updateid='.$s_no.'?" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>

							<td align="center"><a href="deletepcr.php?deleteid='.$s_no.'?" '.$Btn_Visibility.' class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
							</tr>
					';
				}
			}
			}


			?>
		</tbody>
	</table>
</div>
<br>
<br>
<script>
		$(document).ready(function () {
		$('#dtDynamicVerticalScrollExample').DataTable({
		"scrollY": "50vh",
		"scrollCollapse": true,
		});
		$('.dataTables_length').addClass('bs-select');
		});
</script>


</body>
</html>
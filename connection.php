<?php 
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "pcr";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	echo "failed to connect";
    exit();
}

?>
<?php

if(!empty($_GET['file']))
{
	$filename = basename($_GET['file']);
	$filePath = "files/".$filename;


	if(!empty($filename) && file_exists($filePath)){

		header('Content-Description: File Transfer');
		header('Content-Type: application/force-download');
		header("Content-Disposition: attachment; filename=.$filename.");
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		ob_clean();
		flush();

		readfile($filePath);
		exit;
	}
	else{
		"error";
	}
}
if(!empty($_GET['file1']))
{
	$filename = basename($_GET['file1']);
	$filePath = "files/".$filename;

	if(!empty($filename) && file_exists($filePath)){

		header('Content-Description: File Transfer');
		header('Content-Type: application/force-download');
		header("Content-Disposition: attachment; filename=.$filename.");
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		ob_clean();
		flush();

		readfile($filePath);
		exit;
		}
}
else{
	echo "error";
}

?>
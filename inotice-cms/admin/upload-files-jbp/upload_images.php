<?php

//include mysql connection information
require_once('connect.php');

ob_start();

//get code from the eid hidden field
$iid = $_GET[id];

//if files have been selected, upload and insert into database
if (!empty($_FILES)) {

	//make sure the files really are just image files
	$ext = strtolower(end(explode(".",$_FILES['Filedata']['name']))); //get extension
	$allowed = array("jpg","png","gif");
	if (!in_array($ext,$allowed)) {
		die;
	}
	//

	//get file information
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
	//

	//upload the file
	move_uploaded_file($tempFile,$targetFile);
	//

	//insert the file into the database
	mysql_query("INSERT INTO images (image_code, image_file) VALUES
	
		(
			'".$_GET[id]."',
			'".addslashes($_FILES['Filedata']['name'])."'
		)
	
	");
	//

	//echo the file name
	echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);

}
//
?>
<?php

$folder = "../images/inventory/";
$iid = $_GET[eid];

if (!empty($_FILES)) {
//	$tempFile = $_FILES['Filedata']['tmp_name'];
//	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
//	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];

	//GENERATE RANDOM CODE FOR FILE NAME
		$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$rand = substr(str_shuffle($alphanum), 0, 8);
	//END
	
	$imagewidth = 600;
	
		$imageid = '';
		$ori_name = $_FILES['Filedata']['name'][$key];
		$ori_name = $rand.".jpg";
		$tmp_name = $_FILES['Filedata']['tmp_name'][$key];
		$src = imagecreatefromjpeg($tmp_name);
		list($width,$height)=getimagesize($tmp_name);
		$newwidth=$imagewidth;
		$newheight=($height/$width)*$imagewidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$filename = "$folder/". $ori_name;
		chmod($filename,0777);
		imagejpeg($tmp,$filename,100);
		$imageid = $ori_name;
	
	// Create thumbnail...
		$newwidth=145;
		$newheight=($height/$width)*145;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$extname = "thumb-$ori_name";
		$filename = "$folder/". $extname;
		chmod($filename,0777);
		imagejpeg($tmp,$filename,100);
	
		imagedestroy($src);
		imagedestroy($tmp);	
	
		mysql_query("INSERT INTO images (image_inv, image_file) VALUES 
		(".$iid.", 
		'".$imageid."'
		)
		");

//	END INSERT IMAGES
//
//	move_uploaded_file($tempFile,$targetFile);
//	echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);

}
?>
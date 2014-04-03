<?php
	$config_data = upload_file_config("banner_image",-1);
	
	$positive_msg = "";
	$error_msg = "";
	$error_msg2 = "";
	$tip_msg = "";
	//Undo crop Image
	IF ((isset($_GET['action'])) && (($_GET['action']) == "undo_img") && (isset($_GET['subject'])) && (!(isset($_POST['submit']))) )
	{
	  if ( undo_crop_img($_GET['subject'],$_GET['img']) ) {
		$positive_msg = "Image return to original";
	  }  else  {
		$error_msg = "Undo failed!!!";
	  }
	}
	//


	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	$data['deleted_img'] = $_POST['deleted_img'];
	  if (del_banner_images($data)) {
		//$positive_msg = "Saved";
	  }  else  {
		//$error_msg = "Saved failed!!!";
	 }
	} 
	else Save_err_msg("");
	
	$error_msg2 = Select_err_msg();
	
	$banner_image_count = Count_banner_image(-1);
	$banner_image_data = Select_banner_image(-1);
	
	//Views Template("control_banner_img_list");
	require_once('views/control_banner_img_list.php');
?>
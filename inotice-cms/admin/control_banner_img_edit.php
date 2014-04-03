<?php
	$config_data = upload_file_config("banner_image",-1);
	$transition_flow_list = array("in", "out");
	$transition_direction_list = array("right", "left", "up", "down");
	
	$positive_msg = "";
	$error_msg = "";
	$tip_msg = "";

 If (isset($_REQUEST['id'])) {
	$id = ($_REQUEST['id']);
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
	
	//Save the image information
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['transition'] = $_POST['transition'];
		//$data['transition_flow'] = $_POST['transition_flow'];
		//$data['transition_direction'] = $_POST['transition_direction'];
		
		if (Save_banner_image($id, $data)) {
			$positive_msg = "Saved";
		}  else  {
			$error_msg = "Saved failed!!!";
		}
	}
	//
	
	$banner_image_count = Count_banner_image($id);
	$banner_image_data = Select_banner_image($id);
	
	//Views Template("control_banner_img_edit");
	require_once('views/control_banner_img_edit.php');
} ?>
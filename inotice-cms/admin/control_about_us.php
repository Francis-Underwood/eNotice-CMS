<?php
	$config_data = upload_file_config("about_us",-1);
	
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
		$error_msg = "Undo failed";
	  }
	}
	//
	
	//Save the about us info & image
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['about_us_desc'] = $_POST['about_us_desc'];
		$data['deleted_img'] = $_POST['deleted_img'];

		if (Save_about_us($data)) {
				$positive_msg = "Message Saved";
			}  else  {
				$error_msg = "Message Saved failed!!!";
			}
	}
		else Save_err_msg("");
	//
	
	//echo "<tr><td><font color=\"red\"><strong>".Select_err_msg()."</strong></font></td></tr>";
	$crop_error_msg = Select_err_msg();
	$about_us_data = Select_about_us();
	
	//Views Template("control_about_us");
	require_once('views/control_about_us.php');
?>
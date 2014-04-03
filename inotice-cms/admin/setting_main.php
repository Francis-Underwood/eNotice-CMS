<?php
	$positive_msg = "";
	$error_msg = "";
	$tip_msg = "";
	
	//***Undo crop Image***
	IF ((isset($_GET['action'])) && (($_GET['action']) == "undo_img") && (isset($_GET['subject'])) && (!(isset($_POST['submit']))) )
	{
	  if ( undo_crop_img($_GET['subject'],$_GET['img']) ) {
		$positive_msg = "Image return to original";
	  }  else  {
		$error_msg = "Undo failed!!!";
	  }
	}
	//
	
	//***Update Title***
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['company_title'] = substr($_POST['company_title'],0,45);
		$data['company_title_color'] = substr($_POST['company_title_color'],0,45);
		$data['company_subtitle'] = substr($_POST['company_subtitle'],0,45);
		$data['company_subtitle_color'] = substr($_POST['company_subtitle_color'],0,45);
		$data['curr_time_color'] = substr($_POST['curr_time_color'],0,45);
		$data['weather_temp_color'] = substr($_POST['weather_temp_color'],0,45);
		$data['banner_type'] = substr($_POST['banner_type'],0,2);

		if (Save_config_title($data)) {
			$positive_msg = "Saved";
		}  else  {
			$error_msg = "Save failed!!!";
		}
	}
	//
	
	//***Delete Image***
	IF ((isset($_GET['action'])) && (($_GET['action']) == "del") && (isset($_GET['subject'])) && (!(isset($_POST['submit']))) )
	{
	  if (del_image(($_GET['subject']),(isset($_GET['id']))?($_GET['id']):-1) ) {
		$positive_msg = "Deleted";
	  }  else  {
		$error_msg = "Delete failed!!!";
	  }
	}
	//
	
	//***Get Data***
	//1. Title and other info
	$config_title_data = Select_config_title();
	//2. logo
	$config_data['logo'] = upload_file_config("logo",-1);
	$company_logo_image = Select_images("logo",-1,0);
	//3. Background
	$config_data['bg'] = upload_file_config("bg",-1);
	$background_image = Select_images("bg",-1,0); 
	//4. Menu Icons
	$config_data['menu_icons'] = upload_file_config("menu_icons",-1);
	$menu_icon_count = Count_images("menu_icons",-1,0);
	$menu_icon_data = Select_images("menu_icons",-1,0);
	
	//Views Template("setting_main");
	require_once('views/setting_main.php');
?>
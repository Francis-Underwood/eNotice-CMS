<?php
	$news_id = (isset($_REQUEST["news_id"]))?($_REQUEST["news_id"]):0;
	$config_data = upload_file_config("news",-1);
	
	$positive_msg = "";
	$error_msg = "";
	$error_msg2 = "";
	$tip_msg = "";
	
	//$mode = (($_GET["action"]="edit") && (isset($_GET["id"])))?"edit":"add";
	$mode = ($news_id > 0)?"edit":"add";
	
	//echo $mode;

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
	
	//$news_id = $_POST['news_id'];
	$data['title'] = substr($_POST['title'],0,80);
	$data['xdate'] = substr($_POST['xdate'],0,10);
	$data['deleted_news_img'] = $_POST['deleted_news_img'];
	$data['summary'] = substr($_POST['summary'],0,500);
	$data['content'] = $_POST['content'];
	
	if (Save_news($news_id, $data)) {
		$positive_msg = "Saved";
		switch ($mode) {
			case "add":
				//Change to EDIT mode after saved
				$news_id = mysql_insert_id();
				//$mode = "edit";
				redirect("main.php?page=control_news_edit&news_id=$news_id");
				break;
			default:
				break;
		}
	}  else  {
		//$error_msg = "Saved failed!!!";
	}
	
	}
	else Save_err_msg("");
	
	$error_msg2 = Select_err_msg();
	
	
	//Delete news image
	IF ((isset($_GET['action'])) && (isset($_GET['news_id'])) && (isset($_GET['img_id'])) && (($_GET['action']) == "del") )
	{
		if (del_news_image($_GET['img_id'])) {
			$positive_msg = "Image Deleted";
		}  else  {
			$error_msg = "Image delete failed!!!";
		}
		Redirect("main.php?page=control_news_edit&news_id=".$_GET['news_id']);	
	}
	//	
	
	switch ($mode) {
		case "edit":
			$news_data = Select_news($news_id);
			$subtitle = "Editing Mode";
			break;
		default:
			$news_data = null;
			$subtitle = "Adding Mode";
			break;
	}
	
	//Views Template("control_news_edit");
	require_once('views/control_news_edit.tmp.php');
?>
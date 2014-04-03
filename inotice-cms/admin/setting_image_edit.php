<?php
$positive_msg = "";
$error_msg = "";
$error_msg2 = "";
$tip_msg = "";

if (isset($_GET['subject']))   {
	$subject = ($_GET['subject']);
	$id = ((isset($_REQUEST['id']))?($_REQUEST['id']):(-1));
	/* $top = "";
	switch ($subject) {
		case "logo":
		case "bg":
			$top = "bg";
			break;
		case "menu_icons":
			$top = "menu";
			break;
	}
	$up_page = "main.php?page=setting_main&top=$top";   */
	$up_page = "main.php?page=setting_main&subject=$subject";
	
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
		$show_msg = false;
		
		switch ($subject) {
			case "menu_icons":
				$show_msg = true;
				$data['label'] = $_POST['label'];
				$save_result = Save_menu_icon_data($id, $data);
		   break;
		}
		
	   if ($show_msg) {
		if ($save_result) {
			$positive_msg = "Messgae Saved";
		}  else  {
			$error_msg = "Message Save failed!!!";
		}
	  }
	}
	//else Save_err_msg("");
		
	$error_msg2 = Select_err_msg();

	$config_data = upload_file_config($subject,$id);
	$image_data = Select_images($subject,$id,0);
	
	//Views Template("setting_image_edit");
	require_once('views/setting_image_edit.tmp.php');
}
?>

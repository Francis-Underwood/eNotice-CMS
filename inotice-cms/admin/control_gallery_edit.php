<?php
	$aid = (isset($_REQUEST['aid']))?($_REQUEST['aid']):(0);
	$mode = ($aid > 0)?"edit":"add";
	
	$config_data = upload_file_config("gallery",-1);
	$up_page = "main.php?page=control_main&cpage=control_gallery_list";

	$positive_msg = "";
	$error_msg = "";
	$tip_msg = "";
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['deleted_img'] = $_POST['deleted_img'];
		$data['as_cover'] = $_POST['as_cover'];
		$data['title'] = $_POST['title'];
		$data['xdate'] = $_POST['xdate'];
		
												 //The Album will deleted if the album is empty!!!
		if ((Save_gallery_album($aid, $data)) && (del_gallery_photos($aid, $data)))  {
			$positive_msg = "Saved";
			switch ($mode) {
				case "add":
					//Change to EDIT mode after saved
					$aid = mysql_insert_id();
					$mode = "edit";			
					break;
				default:
					break;
			}
		
		}  else  {
			$error_msg = "Saved failed!!!";
		}
	}
	
	switch ($mode) {
		case "edit":
			//Photos Listing
			$gallery_photo_count = Count_gallery_photo($aid, -1);
			$gallery_photo_data = Select_gallery_photo($aid, -1);
			
			$subtitle = "Editing Mode";
			break;
		default:
			$gallery_photo_data = null;
			$subtitle = "Adding Mode";
			break;
	}

	if ($aid >0 ) {
		//Read the album Information
		$gallery_album_data = Select_gallery_album($aid);
		
		//If the Album is not exist, redirect to gallery_list
		if ($gallery_album_data == null) Redirect($up_page);
	}

	//Views Template("control_gallery_edit");
	require_once('views/control_gallery_edit.php');
?>
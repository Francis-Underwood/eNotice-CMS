<?php
	$aid = (isset($_REQUEST['aid']))?($_REQUEST['aid']):(0);
	
	$config_data = upload_file_config("gallery",-1);
	$up_page = "main.php?page=control_gallery_edit&aid=$aid";

	$positive_msg = "";
	$error_msg = "";
	
	switch ($_REQUEST['msg']) {
	case "succ":
			$positive_msg .= "Images Sorted";
		break;
	case "faied":
			$error_msg .= "Images Sort failed";
		break;
	}
	//Photos Listing
	$gallery_photo_count = Count_gallery_photo($aid, -1);
	$gallery_photo_data = Select_gallery_photo($aid, -1);

	if (($aid >0) && ($gallery_photo_count > 1)){
		//Read the album Information
		$gallery_album_data = Select_gallery_album($aid);

		//Views Template("control_gallery_sort");
		require_once('views/control_gallery_img_sort.tmp.php');
	}	
?>
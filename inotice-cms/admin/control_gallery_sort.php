<?php
	$config_data = upload_file_config("gallery",-1);
	$up_page = "main.php?page=control_gallery_list";

	$positive_msg = "";
	$error_msg = "";
	
	switch ($_REQUEST['msg']) {
	case "succ":
			$positive_msg .= "Albums Sorted";
		break;
	case "faied":
			$error_msg .= "Albums Sort failed";
		break;
	}
	
	del_empty_gallery_album();
	$gallery_album_count = Count_gallery_album(-1);
	$gallery_album_data = Select_gallery_album(-1);
	
	if ($gallery_album_count > 1) {
		require_once('views/control_gallery_sort.tmp.php');
	}
?>
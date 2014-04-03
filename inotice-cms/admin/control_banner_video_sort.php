<?php
	$config_data = upload_file_config("banner_video",-1);
	$up_page = "main.php?page=control_banner_video_list";

	$positive_msg = "";
	$error_msg = "";
	
	switch ($_REQUEST['msg']) {
	case "succ":
			$positive_msg .= "Banner Videos Sorted";
		break;
	case "faied":
			$error_msg .= "Banner Videos failed";
		break;
	}
	
	$banner_video_count = Count_banner_video(-1);
	$banner_video_data = Select_banner_video(-1);
	
	if ($banner_video_count > 1) {
		require_once('views/control_banner_video_sort.tmp.php');
	}
?>
<?php
	$config_data = upload_file_config("banner_image",-1);
	$up_page = "main.php?page=control_banner_img_list";

	$positive_msg = "";
	$error_msg = "";
	
	switch ($_REQUEST['msg']) {
	case "succ":
			$positive_msg .= "Banner Images Sorted";
		break;
	case "faied":
			$error_msg .= "Banner Images Sort failed";
		break;
	}
	
	$banner_image_count = Count_banner_image(-1);
	$banner_image_data = Select_banner_image(-1);
	
	if ($banner_image_count > 1) {
		require_once('views/control_banner_img_sort.tmp.php');
	}
?>
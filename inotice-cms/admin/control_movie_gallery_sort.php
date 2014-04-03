<?php
	$config_data = upload_file_config("movie_gallery",-1);
	$up_page = "main.php?page=control_movie_gallery_list";

	$positive_msg = "";
	$error_msg = "";
	
	switch ($_REQUEST['msg']) {
	case "succ":
			$positive_msg .= "Gallery Videos Sorted";
		break;
	case "faied":
			$error_msg .= "Gallery Videos failed";
		break;
	}
	
	$movie_gallery_count = Count_movie_gallery(-1);
	$movie_gallery_data = Select_movie_gallery(-1);
	
	if ($movie_gallery_count > 1) {
		require_once('views/control_movie_gallery_sort.tmp.php');
	}
?>
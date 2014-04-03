<?php
	switch ($_REQUEST["cpage"]){
		case "control_banner_img_list":
		$control_page_title = "Cover Banner";
			break;
		case "control_banner_img_edit":
		$control_page_title = "Cover Banner Image Config Edit";
			break;
		case "control_banner_video_list":
		$control_page_title = "Cover Video";
			break;
		case "control_banner_video_edit":
		$control_page_title = "Cover Banner Video Config Edit";
			break;
		case "control_casting":
		$control_page_title = "Banner Casting";
			break;
		case "control_about_us":
		$control_page_title = "About Us";
			break;
		case "control_news_list":
		$control_page_title = "News Listing";
			break;
		case "control_news_edit":
		$control_page_title = "News Editor";
			break;
		case "control_gallery_list":
		$control_page_title = "Gallery Album Listing";
			break;
		case "control_gallery_edit":
		$control_page_title = "Gallery Album";
			break;
		case "control_gallery_img_edit":
		$control_page_title = "Album Photo Info";
			break;
		case "control_movie_gallery_list":
		$control_page_title = "Movie Gallery Listing";
			break;
		case "control_movie_gallery_edit":
		$control_page_title = "Movie Gallery Config Edit";
			break;
		default:
		case "control_1crop_img":
		$control_page_title = "Crop Image";
			break;
		default:
		$control_page_title = "Welcome";
	}

	//Views Template("control_main");
	require_once('views/control_main.php');
?>

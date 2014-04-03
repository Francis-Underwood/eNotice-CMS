<?php
	$config_data = upload_file_config("movie_gallery",-1);
	$positive_msg = "";
	$error_msg = "";
	$error_msg2 = "";
	$tip_msg = "";
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['deleted_video'] = $_POST['deleted_video'];
		
		if (del_movie_gallery($data)) {
			$positive_msg = "Saved";
		}  else  {
			$error_msg = "Saved failed!!!";
		}
	}
	else Save_err_msg("");
	
	$error_msg2 = Select_err_msg();
	
	$movie_gallery_count = Count_movie_gallery(-1);
	$movie_gallery_data = Select_movie_gallery(-1);
	$sizeLimit_mb = 85 * 1024 * 1024;
	
	//Views Template("control_movie_gallery_list");
	require_once('views/control_movie_gallery_list.php');
?>
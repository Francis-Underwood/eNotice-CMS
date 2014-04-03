<?php
$config_data = upload_file_config("movie_gallery",-1);
$positive_msg = "";
$error_msg = "";
$tip_msg = "";

 If (isset($_REQUEST['id'])) {
	$id = ($_REQUEST['id']);
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['title'] = $_POST['title'];
		$data['aspect_option'] = $_POST['aspect_option'];
		$data['aspect_width'] = $_POST['aspect_width'];
		$data['aspect_height'] = $_POST['aspect_height'];
		
		if (Save_movie_gallery($id, $data)) {
			$positive_msg = "Saved";
		}  else  {
			$error_msg = "Saved failed!!!";
		}
	}
	
	$movie_gallery_count = Count_movie_gallery($id);
	$movie_gallery_data = Select_movie_gallery($id);
	
	//Views Template("control_movie_gallery_edit");
	require_once('views/control_movie_gallery_edit.tmp.php');
} ?>
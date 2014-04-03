<?php
$config_data = upload_file_config("banner_video",-1);

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

		if (Save_banner_video($id, $data)) {
			$positive_msg = "Saved";
		}  else  {
			$error_msg = "Saved failed!!!";
		}
	}
	$banner_video_count = Count_banner_video($id);
	$banner_video_data = Select_banner_video($id);
	
	//Views Template("control_banner_video_edit");
	require_once('views/control_banner_video_edit.tmp.php');
} ?>
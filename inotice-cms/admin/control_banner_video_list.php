<?php
	$config_data = upload_file_config("banner_video",-1);

	$positive_msg = "";
	$error_msg = "";
	$error_msg2 = "";
	$tip_msg = "";
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Del selected Videos") )
	{
		$data['deleted_video'] = $_POST['deleted_video'];
		

		if (del_banner_video($data)) {
			$positive_msg = "Videos Deleted";
		}  else  {
			$error_msg = "Videos Delete failed!!!";
		}
	}
	//else Save_err_msg("");
	
	$error_msg2 = Select_err_msg();
	
	$banner_video_count = Count_banner_video(-1);
	$banner_video_data = Select_banner_video(-1);
	$sizeLimit_mb = "100MB";
	
	//Views Template("control_banner_video_list");
	require_once('views/control_banner_video_list.tmp.php');
?>
<?php 
	$config_data = upload_file_config("gallery",-1);
	$positive_msg = "";
	$error_msg = "";
	$tip_msg = "";
	
	IF ((isset($_GET['action'])) && (($_GET['action']) == "del") && (isset($_GET['id'])) )
	{
		if (del_gallery_album($_GET['id'])) {
			$positive_msg = "Album Deleted";
		 }  else  {
			$error_msg = "Album delete failed!!!";
		 }
	}
	
	del_empty_gallery_album();
	$gallery_album_count = Count_gallery_album(-1);
	$gallery_album_data = Select_gallery_album(-1);

	//Views Template("control_gallery_list");
	require_once('views/control_gallery_list.tmp.php');
?>
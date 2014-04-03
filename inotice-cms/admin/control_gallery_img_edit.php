<?php
	$config_data = upload_file_config("gallery",-1);
 If (isset($_REQUEST['id'])) {
	$id = ($_REQUEST['id']);
	$aid = ($_REQUEST['aid']);

	$positive_msg = "";
	$error_msg = "";
	$tip_msg = "";
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['title'] = $_POST['title'];
		$data['description'] = $_POST['description'];
		$data['as_cover'] = $_POST['as_cover'];
		
		if (Save_gallery_photo($aid, $id, $data)) {
			$positive_msg = "Saved";
		}  else  {
			$error_msg = "Saved failed!!!"; 
		  }
	}
	$gallery_album_data = Select_gallery_album($aid);
	
	$gallery_photo_count = Count_gallery_photo($aid, $id);
	$gallery_photo_data = Select_gallery_photo($aid, $id);

	//Views Template("control_gallery_img_edit");
	require_once('views/control_gallery_img_edit.tmp.php');
} ?>
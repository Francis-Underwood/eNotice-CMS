<?php
If ((isset($_GET['subject'])) && (isset($_GET['img_id'])) ) {
	$subject = ($_GET['subject']);
	$image_id = ($_GET['img_id']);
	$id2 = (isset($_GET['id2']))?($_GET['id2']):0;
	$config_data = upload_file_config($subject,-1);
	$image_data = Select_images($subject, $image_id, 0);
	//完成後返回路徑
	switch ($subject) {
		case "logo":
		case "bg":
			$Redirect = "main.php?page=setting_main";
			break;
		case "menu_icons":
			//$Redirect = "main.php?page=setting_main";
			$Redirect = "main.php?page=setting_image_edit&subject=$subject&id=$image_id";
			break;			
		case "news":
			$Redirect = "main.php?page=control_main&cpage=control_news_edit&action=edit&news_id=$id2";
			break;
		case "about_us":
			$Redirect = "main.php?page=control_main&cpage=control_about_us";
			break;
		case "banner_image":
			$Redirect = "main.php?page=control_main&cpage=control_banner_img_edit&id=$image_id";
			//$Redirect = "main.php?page=control_main&cpage=control_banner_img_list";
			break;
		default:
			$Redirect = "main.php?page=control_main";
			break;				}
	//
	
	//未經裁剪的圖片路徑
	$image_path = $config_data['folder'];
	$file_info = pathinfo($image_data['image'][0]);
	$src = $image_path."/non-crop/".$file_info['basename'];
	//
	
	//圖片解析度 及 系統要求 合適解析度
	$srcSize = getimagesize($src);
	$img_width = $srcSize[0];
	$img_height = $srcSize[1];
	
	$best_resolution = explode(" x ", $config_data['finished_resolution_text']);
	$matched_width = $best_resolution[0];
	$matched_height = $best_resolution[1];
	//

	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Crop") )
	{
		/*    $targ_w = 120;
		$targ_h = 90;
		$jpeg_quality = 100;

		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
		$targ_w,$targ_h,$_POST['w'],$_POST['h']);

		header('Content-type: image/jpeg');
		imagejpeg($dst_r,null,$jpeg_quality);    */
		
		//從non-crop($src) 產生 自訂剪出的圖片 輸出至原來的位置

		if ((isset($_POST['w'])) && ($_POST['w'] > 0)) {
			$btn_disabled=" disabled='1' ";
			
			$dest1 = $image_path."/".$file_info['basename'];
			$x = ($_POST['x']);
			$y = ($_POST['y']);
			
			//如果crop出的長/闊大於圖片的長/闊，設定crop出的長/闊為圖片的長/闊
			$crop_width = ($_POST['w']);
			$crop_height = ($_POST['h']);
			$crop_width = ($crop_width  > $img_width)?($img_width):($crop_width);
			$crop_height = ($crop_height  > $img_height)?($img_height):($crop_height);
			//

			imagesResize_custom($src,$dest1, $x, $y, $matched_width, $matched_height, $crop_width, $crop_height);
			
			//**Waiting for 0 sec for proc the image**
			//Redirect($Redirect);
			
			//**Waiting for 1 sec for proc the image**
			Redirect_wait($Redirect,1);
		}
	} 
	
	//Views Template("control_1crop_img");
	require_once('views/control_1crop_img.php');
}
?>
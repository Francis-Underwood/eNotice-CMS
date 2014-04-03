<?php
									//依長寬比判斷長寬像素
function imagesResize($img, $newfilename, $w, $h) { 

		 //Check if GD extension is loaded
		 if (!extension_loaded('gd') && !extension_loaded('gd2')) {
			trigger_error("GD is not loaded", E_USER_WARNING);
			return false;
		 }
		 
		 //Get Image size info
		 $imgInfo = getimagesize($img);
		 switch ($imgInfo[2]) {
			case 1: $im = imagecreatefromgif($img); break;
			case 2: $im = imagecreatefromjpeg($img);  break;
			case 3: $im = imagecreatefrompng($img); break;
			default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
		 }
		 
		 //If image dimension is smaller, do not resize
		 if ($imgInfo[0] <= $w && $imgInfo[1] <= $h) {
			$nHeight = $imgInfo[1];
			$nWidth = $imgInfo[0];
		 }else{
		  //yeah, resize it, but keep it proportional
		  
		  /*if ($w/$imgInfo[0] > $h/$imgInfo[1]) {    Org Code
			$nWidth = $w;
			$nHeight = $imgInfo[1]*($w/$imgInfo[0]);
		  }else{
			$nWidth = $imgInfo[0]*($h/$imgInfo[1]);
			$nHeight = $h;
		  }   */
		  
			$nHeight = $h;
			$nWidth = $w;
			//依長寬比判斷長寬像素
			$srcRatio  = $imgInfo[0] / $imgInfo[1];
			if($srcRatio > 1){
				$nHeight = $nWidth / $srcRatio;
			}
			else{
				$nHeight = $nWidth; 
				$nWidth = $nWidth * $srcRatio;  
			}
		  
		 }
			$nWidth = round($nWidth);
			$nHeight = round($nHeight);
		 
			$newImg = imagecreatetruecolor($nWidth, $nHeight);
		 
		 /* Check if this image is PNG or GIF, then set if Transparent*/  
		// if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
			imagealphablending($newImg, false);
			imagesavealpha($newImg,true);
			$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
			imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
		// }
			imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);
		 
		 //Generate the file, and rename it to $newfilename
		 switch ($imgInfo[2]) {
			case 1: imagegif($newImg,$newfilename); break;
			case 2: imagejpeg($newImg,$newfilename);  break;
			case 3: imagepng($newImg,$newfilename); break;
			default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
		 }
		//釋放資源
		imagedestroy($newImg);
}
									//取出圖片中間的正方形部份，並輸出至指定size的正方形
function imagesResize_square($img, $newfilename, $w) { 

		 //Check if GD extension is loaded
		 if (!extension_loaded('gd') && !extension_loaded('gd2')) {
			trigger_error("GD is not loaded", E_USER_WARNING);
			return false;
		 }
		 
		 //Get Image size info
		 $imgInfo = getimagesize($img);
		 switch ($imgInfo[2]) {
			case 1: $im = imagecreatefromgif($img); break;
			case 2: $im = imagecreatefromjpeg($img);  break;
			case 3: $im = imagecreatefrompng($img); break;
			default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
		 }

		$oHeight = $imgInfo[1];
		$oWidth = $imgInfo[0];
		$nWidth = $w;
		$nHeight = $w;
		
		 //如果圖片細於指是大小，不做縮圖動作
		 if ($imgInfo[0] <= $w && $imgInfo[1] <= $w) {
			$nHeight = $imgInfo[1];
			$nWidth = $imgInfo[0];
		 }else{
			
			if ($oWidth > $oHeight) {
			//橫圖片
				$crop_width = $oHeight;
				$crop_height = $oHeight;
				$x = ($oWidth - $oHeight) / 2 ;
				$y = 0;
			}
			else  {
			//直圖片
				$crop_width = $oWidth;
				$crop_height = $oWidth;
				$x = 0;
				$y = ($oHeight - $oWidth) / 2;
			}
		 }
			$x = round($x);
			$y = round($y);
			$nWidth = round($nWidth);
			$nHeight = round($nHeight);
		 
			$newImg = imagecreatetruecolor($nWidth, $nHeight);
		 
		 /* Check if this image is PNG or GIF, then set if Transparent*/  
		// if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
			imagealphablending($newImg, false);
			imagesavealpha($newImg,true);
			$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
			imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
		// }
			imagecopyresampled($newImg, $im, 0, 0, $x, $y, $nWidth, $nHeight, $crop_width, $crop_height);
		 
		 //Generate the file, and rename it to $newfilename
		 switch ($imgInfo[2]) {
			case 1: imagegif($newImg,$newfilename); break;
			case 2: imagejpeg($newImg,$newfilename);  break;
			case 3: imagepng($newImg,$newfilename); break;
			default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
		 }
		//釋放資源
		imagedestroy($newImg);
}

												//自訂大小，如果圖形細於輸出Size, 把圖形勉強放大
function imagesResize_custom($img, $newfilename, $x, $y, $nWidth, $nHeight, $crop_width, $crop_height) { 

		 //Check if GD extension is loaded
		 if (!extension_loaded('gd') && !extension_loaded('gd2')) {
			trigger_error("GD is not loaded", E_USER_WARNING);
			return false;
		 }
		 
		 //Get Image size info
		 $imgInfo = getimagesize($img);
		 switch ($imgInfo[2]) {
			case 1: $im = imagecreatefromgif($img); break;
			case 2: $im = imagecreatefromjpeg($img);  break;
			case 3: $im = imagecreatefrompng($img); break;
			default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
		 }
		 
		//tolog("x: ".$x);
		//tolog("y: ".$y);
		
		$nX = 0;
		$nY = 0;
		
		/*如果開始點出了界，則調回0 */
		if (($x < 0)) $x = 0;
		if (($y < 0)) $y = 0;
		//                  
		
		/* tolog("x after adj: ".$x);
		tolog("y after adj: ".$y);

		tolog("nx: ".$nX);
		tolog("ny: ".$nY);    
		
		tolog("nWidth:".$nWidth);
		tolog("nHeight:".$nHeight);
		tolog("crop_width:".$crop_width);
		tolog("crop_height:".$crop_height);   */
		
		$crop_width = round($crop_width);
		$crop_height = round($crop_height);
	
		
		$newImg = imagecreatetruecolor($nWidth, $nHeight);
		
		//fill with white for background color

		//$background = imagecolorallocatealpha($newImg, 255, 0, 0, 110);        //紅色80%透明
		//$background = imagecolorallocatealpha($newImg, 255, 255, 255, 110);        //白色80%透明
		$background = imagecolorallocatealpha($newImg, 255, 255, 255, 127);        //純透明底
		imagealphablending($newImg, false);
		imagesavealpha($newImg, true); 
		imagefill($newImg, 0, 0, $background);
		//			
		
		 /* Check if this image is PNG or GIF, then set if Transparent 
		 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){

			$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
			imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
			
			imagealphablending($newImg, false);
			imagesavealpha($newImg,true);			
		 }  */
	 
		imagecopyresampled($newImg, $im, $nX, $nY, $x, $y, $nWidth, $nHeight, $crop_width, $crop_height);
		 
		 //Generate the file, and rename it to $newfilename
		 switch ($imgInfo[2]) {
			case 1: imagegif($newImg,$newfilename); break;
			case 2: imagejpeg($newImg,$newfilename);  break;
			case 3: imagepng($newImg,$newfilename); break;
			default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
		 }
		//釋放資源
		imagedestroy($newImg);
}

													//自訂大小，如果圖形細於輸出Size, 把圖形置中
function imagesResize_custom_orgSize($img, $newfilename, $x, $y, $nWidth, $nHeight, $crop_width, $crop_height) { 

		 //Check if GD extension is loaded
		 if (!extension_loaded('gd') && !extension_loaded('gd2')) {
			trigger_error("GD is not loaded", E_USER_WARNING);
			return false;
		 }
		 
		 //Get Image size info
		 $imgInfo = getimagesize($img);
		 switch ($imgInfo[2]) {
			case 1: $im = imagecreatefromgif($img); break;
			case 2: $im = imagecreatefromjpeg($img);  break;
			case 3: $im = imagecreatefrompng($img); break;
			default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
		 }
		 
		//tolog("x: ".$x);
		//tolog("y: ".$y);
		
		$nX = 0;
		$nY = 0;
		
		/*如果開始點出了界，則調回0 */
		if (($x < 0)) $x = 0;
		if (($y < 0)) $y = 0;
		//                    
		
		/* tolog("x after adj: ".$x);
		tolog("y after adj: ".$y);    */
		
		if ($nWidth > $imgInfo[0]) {
			$nX = round(($nWidth - $imgInfo[0]) / 2);
		}
		
		if ($nHeight > $imgInfo[1]) {
			$nY = round(($nHeight - $imgInfo[1]) / 2);
		}
		
		/*
		tolog("nx: ".$nX);
		tolog("ny: ".$nY);    
		
		tolog("nWidth:".$nWidth);
		tolog("nHeight:".$nHeight);
		tolog("crop_width:".$crop_width);
		tolog("crop_height:".$crop_height);   */
		
		$crop_width = round($crop_width);
		$crop_height = round($crop_height);
	
		
		$newImg = imagecreatetruecolor($nWidth, $nHeight);
		
		/*fill with white for background color */

		//$background = imagecolorallocatealpha($newImg, 255, 0, 0, 110);        //紅色80%透明
		//$background = imagecolorallocatealpha($newImg, 255, 255, 255, 110);        //白色80%透明
		$background = imagecolorallocatealpha($newImg, 255, 255, 255, 127);        //純透明底
		imagealphablending($newImg, false);
		imagesavealpha($newImg, true); 
		imagefill($newImg, 0, 0, $background);
		//			
		
		 /* Check if this image is PNG or GIF, then set if Transparent 
		 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){

			$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
			imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
			
			imagealphablending($newImg, false);
			imagesavealpha($newImg,true);			
		 }   */
	 
		imagecopyresampled($newImg, $im, $nX, $nY, $x, $y, $imgInfo[0], $imgInfo[1], $crop_width, $crop_height);
		 
		 //Generate the file, and rename it to $newfilename
		 switch ($imgInfo[2]) {
			case 1: imagegif($newImg,$newfilename); break;
			case 2: imagejpeg($newImg,$newfilename);  break;
			case 3: imagepng($newImg,$newfilename); break;
			default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
		 }
		//釋放資源
		imagedestroy($newImg);
}


function imagesResize_square_old($src,$dest,$destW,$destH) { 
	if (file_exists($src)  && isset($dest))  { 
		//取得檔案資訊
		$srcSize  = getimagesize($src);
		$width = $srcSize[0];    //640
		$height = $srcSize[1];   //480
		$srcExtension = $srcSize[2];
		
		//Create thumbnails.
        $new_width = $destW; //pixels.    480
        $new_height = $destW;     //480

        if($width < $height) {
			$smallest_size = $width;   //480
		}
		else {
			$smallest_size = $height;
		}

        //The crop size will be same as that of the largest side   
        $crop_percent = 1;   
        $crop_width   = $smallest_size * $crop_percent;   //480
        $crop_height  = $smallest_size * $crop_percent;   //480

        $c1 = array("x"=>($width-$crop_width)/2, "y"=>($height-$crop_height)/2);    //x=80, y=0
		
		//建立影像 
        //Create new image with new dimensions to hold thumb
        $destImage = imagecreatetruecolor($new_width,$new_height);


		//根據檔案格式讀取圖檔 
		switch ($srcExtension) { 
			case 1: $srcImage = imagecreatefromgif($src); break; 
			case 2: $srcImage = imagecreatefromjpeg($src); break; 
			//case 3: $srcImage = imagecreatefrompng($src); break;
			case 3:
				$srcImage = imagecreatefrompng($src);
				imagealphablending($srcImage, false);
				imagesavealpha($srcImage, true);
			break;
		}
		
        //Copy and resample original image into new image.
        imagecopyresampled($destImage,$srcImage,0,0,$c1['x'],$c1['y'],$new_width,$new_height,$crop_width,$crop_height);
			
		//輸出圖檔 
		switch ($srcExtension) { 
			case 1: imagegif($destImage,$dest); break; 
			case 2: imagejpeg($destImage,$dest,85); break;
			case 3: imagepng($destImage,$dest); break;

		//釋放資源
		imagedestroy($destImage);
		}
 }
}


function check_image_resolution($src,$w,$h,$adj) {
	//tolog("checking"); 
	//取得檔案資訊
	$srcSize = getimagesize($src);
	$width = $srcSize[0];    //640
	$height = $srcSize[1];   //480
	$srcExtension = $srcSize[2];
	//tolog("(vvv $w vvv) $width");
	//tolog("(vvv $h vvv) $height");
	//判斷解析度
	if (!(($width == $w) && ($height == $h)))   {
		if (($width < ($w - $adj)) || ($width > ($w + $adj)) || ($height < ($h - $adj)) || ($height > ($h + $adj)))  {
			return false;
		}
	}
	return true;
}

function check_image_min_resolution($src,$w,$h,$adj) {
	$srcSize = getimagesize($src);
	$width = $srcSize[0];
	$height = $srcSize[1];
	$srcExtension = $srcSize[2];

	if (!(($width == $w) && ($height == $h)))   {
		if (($width < ($w - $adj)) || ($height < ($h - $adj)))  {
			return false;
		}
	}
	return true;
}

function check_image_resolution_ratio($src,$min_ratio,$max_ratio) {
	$srcSize = getimagesize($src);
	$width = $srcSize[0];
	$height = $srcSize[1];
	$srcExtension = $srcSize[2];

	$ratio = $width / $height;
	//tolog("Width is $width");
	//tolog("Height is $height");
	//tolog("Ratio is $ratio");
	
	if (($ratio < $min_ratio) || ($ratio > $max_ratio))  {
		return false;
	}
	return true;
}

function output_image($img,$show_width,$border,$zoom_path,$err_msg) {
	$width_text = ($show_width > 0)?(" width=\"$show_width\" "):("");
	//tolog($img);
	if ((file_exists($img)) && ($img != "") ) {
		if ($zoom_path != "") {
			echo "<a href=\"$zoom_path\" target=\"zoom_img\"><img src=\"$img\" border=\"$border\" $width_text></a>";
		}
		else{
			echo "<img src=\"$img\" border=\"$border\" $width_text>";
		}
	}
	else {
		if ($err_msg != "") {
			echo "<font color='red'>$err_msg</font>";
		}
	}
} 

function show_scissor($img,$show_width,$subject,$img_id,$id2,$err_msg) {

   if ((strpos($img, "preview") === false))  {
	$width_text = ($show_width > 0)?(" width=\"$show_width\" "):("");
	// 顯示剪刀
	if (!((file_exists($img)) && ($img != "") )) {
		//看看non-crop folder 是否有指定相片存在
		$file_info = pathinfo($img);
		$non_crop_name = $file_info['dirname']."/non-crop/".$file_info['basename'];
		if ((file_exists($non_crop_name)) && ($img != "") ) {
			echo "<img src=\"$non_crop_name\" border=\"$border\" $width_text>";		
			echo "<a href=\"main.php?page=control_1crop_img&subject=$subject&img_id=$img_id&id2=$id2\"><img src=\"images/icons/edit-cut-md1.png\" width=\"40\" border=\"0\"></a>";
		}
		else	{
		if ($err_msg != "") {
			echo "<font color='red'>$err_msg</font>";
		}
		}
	}

	// 顯示復原按鈕
	if (((file_exists($img)) && ($img != "") )) {

		$file_info = pathinfo($img);
		$non_crop_name = $file_info['dirname']."/non-crop/".$file_info['basename'];
		if ((file_exists($non_crop_name)) && ($img != "") ) {	
			//echo "<a href='?".$_SERVER['QUERY_STRING']."&subject=$subject&action=undo_img&img=".dotToUnderscore($file_info['basename'])."'><img src='images/icons/undo1.png' width='32' border='0'></a>";
			echo "<a href=\"#\" onclick=\"decision('Are you sure return to original size?','?".$_SERVER['QUERY_STRING']."&subject=$subject&action=undo_img&img=".dotToUnderscore($file_info['basename'])."')\"><img src=\"images/icons/undo1.png\" width=\"32\" border=\"0\"></a>";
		}
		else	{
			if ($err_msg != "") {
				//echo "<font color='red'>$err_msg</font>";
			}
		}
	}
  }
} 


function undo_crop_img($subject,$img) {
	$config_data = upload_file_config($subject,-1);
	$img = underscoreToDot($img);
	$src = $config_data['folder']."/".$img;
	tolog($src);
	
	if ( (file_exists($src)) && ($img != "") ) {
		if ( delete_media($config_data['folder'],$img,false) ) {
			return true;
		}
		else	{
			return false;
		  }
	}
	else {
		return false;
	}
} 
?>
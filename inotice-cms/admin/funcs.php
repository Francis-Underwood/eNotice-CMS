<?php

function isLoggedIn() 
{
    if(isset($_SESSION['user'])) 
	{
        return(true);
    } else 
	{
        return(false);
    }
}


function RequireLogin() 
{
    if(isLoggedIn()) 
	{
        return;
		//Redirect('main.php');           Die Loop, don't put this line
    }
    Redirect('login.php');
}



function getRealIpAddr()
{  
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet  
    {  
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy  
    {  
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }  
    else  
    {  
      $ip=$_SERVER['REMOTE_ADDR'];
    }  
    return $ip;
}  

function Template($TemplateFileName) 
{
    if(file_exists($TemplateFileName.'.php')) 
	{
        include($TemplateFileName.'.php');
    }
}

function views_Template($TemplateFileName) 
{
    if(file_exists('views/'.$TemplateFileName.'.php')) 
	{
        include('views/'.$TemplateFileName.'.php');
    }
}

function get_casting_color_to_cbo($select_color)
{  
	$result = "";
	$color_name = array("Black","White","Red","Cyan","Blue","DarkBlue","LightBlue","Purple","Yellow","Lime","Fuchsia","Silver","Grey","Orange","Brown","Maroon","Green","Olive");
	$color_code = array("000000","FFFFFF","FF0000","00FFFF","0000FF","0000A0","ADD8E6","800080","FFFF00","00FF00","FF00FF","C0C0C0","808080","FFA500","A52A2A","800000","008000","808000");

	$count = count($color_name);
	for ($i = 0; $i < $count; $i++) {
		if ($color_name[$i] == "White")
			$result .= "<option value='#$color_code[$i]' style='background-color: #$color_code[$i];color: #000000;'".($select_color == $color_code[$i]?"selected":"").">$color_name[$i]</option>";
		else
			$result .= "<option value='#$color_code[$i]' style='background-color: #$color_code[$i];color: #FFFFFF;'".($select_color == $color_code[$i]?"selected":"").">$color_name[$i]</option>";
	}
    return $result;
}  

function upload_file_config($subject, $id) {
	$data['page_title'] = ""; 
	$data['best_resolution_text'] = "";
	$data['best_max_width'] = 0;
	$data['cover_max_width'] = 0;
	$data['thumb_max_width'] = 0;
	$data['fileExt'] = "*.jpg;*.gif;*.png";
	$data['fileDesc'] = "Image File";
	$data['queueSizeLimit'] = 1;
	$data['folder'] = "";
	
	switch ($subject) {
		case "logo":
			$data['page_title'] = "System --> Company Logo"; 
			$data['best_resolution_text'] = "255 x 255";
			$data['best_max_width'] = 255;
			$data['thumb_max_width'] = 100;
			$data['folder'] = "../images/logo";
			break;
		case "bg":
			$data['page_title'] = "System --> Background";
			$data['best_resolution_text'] = "1920 x 1080";
			$data['best_max_width'] = 1920;
			$data['thumb_max_width'] = 500;
			$data['folder'] = "../images/background";
			break;
		case "menu_icons":
			if ($id == -1) {
				$data['page_title'] = "System --> Menu Icons --> Add Icons";
			}
			else {
				$data['page_title'] = "System --> Menu Icons --> ID ".$id;
			}
			$data['best_resolution_text'] = "189 x 189";
			$data['best_max_width'] = 189;
			$data['thumb_max_width'] = 80;
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../images/menu";
			break;
		case "news":
			$data['best_resolution_text'] = "180 x 220";
			$data['best_max_width'] = 220;
			$data['thumb_max_width'] = 101;
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../images/news/photos";
			break;
		case "about_us":
			$data['best_resolution_text'] = "500 x 180";
			$data['best_max_width'] = 500;
			$data['thumb_max_width'] = 200;
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../images/portfolio";
			break;
		case "banner_image":
			$data['best_resolution_text'] = "820 x 540";
			$data['best_max_width'] = 820;
			$data['thumb_max_width'] = 200;
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../images/banner";
			break;
		case "banner_video":
			$data['best_resolution_text'] = "";
			$data['thumb_max_width'] = 112;
			$data['fileExt'] = "*.flv;*.mov;*.mpg";
			$data['fileDesc'] = "Video File";
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../videos";
			break;
		case "gallery":
			$data['best_resolution_text'] = "";
			$data['best_max_width'] = 800;
			$data['cover_max_width'] = 144;
			$data['thumb_max_width'] = 113;
			$data['queueSizeLimit'] = 12;
			$data['folder'] = "../images/gallery";
			break;
		case "movie_gallery":
			$data['best_resolution_text'] = "";
			$data['thumb_max_width'] = 112;
			$data['fileExt'] = "*.flv;*.mov;*.mpg";
			$data['fileDesc'] = "Video File";
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../movgallery";
			break;			
	}
	return $data;
}


function left($string, $count){
    return substr($string, 0, $count);
}

function right($value, $count){
    return substr($value, ($count*-1));
}

function properCase($str) {
                    $converted_str = "";
                    $str_array = explode(" ",$str);
                    foreach($str_array as $key=>$value):
                        if(strpos($value, '-')):
                             $value = str_replace("-", " ", $value);
                             $value = ucwords(strtolower($value));
                             $value = str_replace(" ", "-", $value);
                        else:
                            $value = ucwords(strtolower($value));
                        endif;
                        $converted_str .= " ".$value;
                    endforeach;
                  return $converted_str;
 }

 
 

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
		 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
			imagealphablending($newImg, false);
			imagesavealpha($newImg,true);
			$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
			imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
		 }
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
		 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
			imagealphablending($newImg, false);
			imagesavealpha($newImg,true);
			$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
			imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
		 }
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

function imagesResize_NotSuppTran($src,$dest,$destW,$destH) { 
		if (file_exists($src)  && isset($dest)) { 
			//取得檔案資訊
			$srcSize   = getimagesize($src); 
			$srcExtension = $srcSize[2];
			$srcRatio  = $srcSize[0] / $srcSize[1]; 
			//依長寬比判斷長寬像素
			if($srcRatio > 1){
				$destH = $destW / $srcRatio;
			}
			else{
				$destH = $destW; 
				$destW = $destW * $srcRatio;  
			}
		} 
		//建立影像 
		$destImage = imagecreatetruecolor($destW,$destH); 	

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

		//取樣縮圖 
		imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $destW, $destH, imagesx($srcImage), imagesy($srcImage)); 

		//輸出圖檔 
		switch ($srcExtension) { 
			case 1: imagegif($destImage,$dest); break; 
			case 2: imagejpeg($destImage,$dest,85); break;
			case 3: imagepng($destImage,$dest); break;

		//釋放資源
		imagedestroy($destImage);
		} 		
}

function check_image_resolution($src,$w,$h,$adj) {
	tolog("checking"); 
	//取得檔案資訊
	$srcSize  = getimagesize($src);
	$width = $srcSize[0];    //640
	$height = $srcSize[1];   //480
	$srcExtension = $srcSize[2];
	tolog("(vvv $w vvv) $width");
	tolog("(vvv $h vvv) $height");
	//判斷解析度
	if (!(($width == $w) && ($height == $h)))   {
		if (($width < ($w - $adj)) || ($width > ($w + $adj)) || ($height < ($h - $adj)) || ($height > ($h + $adj)))  {
			tolog("failed");
			return false;
		}
	}
	tolog("succ");
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
		echo "<font color='red'>$err_msg</font>";
	}
} 



























function tolog($str) { 
	$myFile = "_log.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	$str = Now()."-$str \r";
	fwrite($fh, $str);
	fclose($fh);
}


$ErrorText = '';
$InfoText = '';

$_pageParas = array();


function pv($paraName,$Name2='') 
{
    global $_pageParas;
    if(isset($_pageParas[$paraName])) 
	{
        return($_pageParas[$paraName]);
    }
    return('');
}
function pv2($paraName,$Name2) 
{
    global $_pageParas;
		
    if(isset($_pageParas[$paraName])) 
	{
		
        if(isset($_pageParas[$paraName][$Name2])) 
		{
            return ($_pageParas[$paraName][$Name2]);
        }
    }
    return('');
}
function Render($ContentPageName, $Params = array(), $Title = '') 
{
	global $Config;
	global $ErrorText;
	global $InfoText;

    $RenderParams = array();
    foreach($Params as $k => $v) 
	{
        $RenderParams[$k] = $v;
    }
    foreach($Config['View'] as $k => $v) 
	{	
        $RenderParams[$k] = $v;
    }
    if(!isset($RenderParams['AlertMessage'])) 
	{
        $RenderParams['AlertMessage'] = '';
    }
	

	if(!isset($RenderParams['InfoMessage'])) 
	{
        $RenderParams['InfoMessage'] = '';
    }

    $RenderParams['BodyPage'] = (isset($_SESSION['user']) ? 'menubody' : 'blankbody');
    $RenderParams['ContentPage'] = $ContentPageName;
    $RenderParams['AlertMessage'] = $ErrorText;
	$RenderParams['InfoMessage'] = $InfoText;

    $s = $Title;
    if($s != '') 
	{
        $s .= ' - ';
    }
    $s .= $Config['SystemName'];
    $RenderParams['Title'] = $s;
    $RenderParams['Version'] = $Config['Version'];
    global $_pageParas;
    $_pageParas = $RenderParams;

    ob_start();
    Template('page');
    ob_end_flush();
}
function Redirect($RedirectTo) 
{
    @header('location: '.$RedirectTo);
	echo "<script>location='$RedirectTo'</script>";
    exit();
}

function ErrText($text) 
{
    global $ErrorText;
    $ErrorText = $text;
}

function InfoText($text) 
{
    global $InfoText;
    $InfoText = $text;
}

function IsErr() 
{
    global $ErrorText;
    return($ErrorText != '');
}
function Now() 
{
    return(date('Y-m-d H:i:s'));
}
function out($s) 
{
    return($s);
}

?>
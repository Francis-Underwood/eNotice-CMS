<?phprequire_once('../includes/app.inc.php');//RequireLogin();           //Don't Run this Line because of the Uploadify: HTTP ERROR?><?php//ob_start();       //Don't Run this Line because of the Uploadify: HTTP ERROR//get code from the eid hidden field$iid = $_GET[id];//$image_id = (isset($_REQUEST['image_id']))?$_REQUEST['image_id']:0;$image_id = $_REQUEST['image_id'];$subject = $_REQUEST['subject'];$config_data = upload_file_config($subject,-1);//if files have been selected, upload and insert into databaseif ((!empty($_FILES)) && (!($config_data == null))) {	//make sure the files really are just image files	$ext = strtolower(end(explode(".",$_FILES['Filedata']['name']))); //get extension	//upload the file		//檔案命名	$Name = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . substr(md5(uniqid(rand())),0,5) . substr(md5(uniqid(rand())),0,5) . "." . $ext;	/*get file information             (For uploadify v2.x.x)	$tempFile = $_FILES['Filedata']['tmp_name'];	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';		//$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];	$targetFile =  str_replace('//','/',$targetPath) . $Name;			//End of get file information					*/		//get file information            (For uploadify v3.2)	$tempFile = $_FILES['Filedata']['tmp_name'];	tolog("_REQUEST['folder']:      ".$_REQUEST['folder']);	tolog("_SERVER['SCRIPT_NAME']:   ".$_SERVER['SCRIPT_NAME']);			$path_parts = pathinfo($_SERVER['SCRIPT_NAME']);	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $path_parts['dirname'] . '/' . '../'. $_REQUEST['folder'] ;		tolog("targetPath before cov:     $targetPath");	$targetPath = canonicalize($targetPath) ;	tolog("targetPath after cov:     $targetPath");		//$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];	$targetFile =  str_replace('//','/',$targetPath) . '/' . $Name;	tolog("targetFile     $targetFile");		//End of get file information			$pass = true;	Save_err_msg("");		//**Check File Extension***		/*make sure the files really are just image files	   <----No Need check, because it already checked by uploadify	//$allowed = array("mov","flv");	//if (!in_array($ext,$allowed)) {		//die;	//}	*/		$allowed_ext_str = str_replace("*.", "", $config_data['fileExt']);	$allowed_ext = explode(";", $allowed_ext_str);	if (!in_array($ext,$allowed_ext)) {		$pass = false;		$err_msg = "Incorrect file type, should be <u>".$config_data['fileDesc']."</u> (".$config_data['fileExt'].")!<br>";		Save_err_msg($err_msg);	}			//Upload the Video if the file type is match the requirement if ($pass)   {	if (move_uploaded_file($tempFile,$targetFile))  {	/*  Echo Error Messasge	switch ($_FILES['Filedata']['error'])        {                 case 0:             $msg = ""; // comment this out if you don't want a message to appear on success.             break;            case 1:              $msg = "The file is bigger than this PHP installation allows";              break;            case 2:              $msg = "The file is bigger than this form allows";              break;            case 3:              $msg = "Only part of the file was uploaded";              break;            case 4:             $msg = "No file was uploaded";              break;            case 6:             $msg = "Missing a temporary folder";              break;            case 7:             $msg = "Failed to write file to disk";             break;            case 8:             $msg = "File upload stopped by extension";             break;            default:            $msg = "unknown error ".$_FILES['Filedata']['error'];            break;        }    }    if ($msg)        { $stringData = "Error: ".$_FILES['Filedata']['error']." Error Info: ".$msg; }    else        { $stringData = "1"; } // This is required for onComplete to fire on Mac OSX    echo $stringData;  */	/*   ***For Resize Image***	//最佳尺寸	$src  = $targetPath . "/" . $Name;	$dest1 = $targetPath . "/best/" . $Name;	$destW = $config_data['best_max_width'];	$destH = 1;	imagesResize($src,$dest1,$destW,$destH);		//預覽圖	$src  = $targetPath . "/" . $Name;	$dest1 = $targetPath . "/thumb/" . $Name;	$destW = $config_data['thumb_max_width'];	$destH = 1;	imagesResize($src,$dest1,$destW,$destH);		*/		//***For Video proc***		if (extension_loaded('ffmpeg'))	{		//$base means the filename without ext		$base = basename($targetFile, ".".$ext);		tolog("have ffmpeg");		/*  OLD Version					//ececute ffmpeg generate flv		//$new_file = $base . '.flv';		//$new_flv = $targetPath . "/flv/" . $new_file;		//exec('ffmpeg -i '.$targetFile.' -f flv -s 320x240 '.$new_flv.'');    		//execute ffmpeg and create thumb		$new_image_path = $targetPath . "/thumb/" . $new_image;		exec('ffmpeg -i '.$targetFile.' -f mjpeg -vframes 1 -s '.$config_data['thumb_max_width'].'x'.$config_data['thumb_max_width'].' -an '.$new_image_path.'');								//echo 'Thank You For Your Video!<br>'; 				*/				//產生First frame圖片		$new_image = $base . '.jpg';				$ffmpegInstance = new ffmpeg_movie($targetFile);				//	取First frame作為圖片		//$ff_frame = $ffmpegInstance->getFrame(2);  		//	取影片的中間作為圖片 (最大為第280格，第28秒)		$frame_count = $ffmpegInstance->getFrameCount();		tolog("frame_count = ".$frame_count);		$take_frame_at = (($frame_count / 4) > 280 )?(280):(round($frame_count / 4));		tolog("take_frame_at = ".$take_frame_at);		$ff_frame = $ffmpegInstance->getFrame($take_frame_at);						$gd_image = $ff_frame->toGDImage();					$ff_img = $targetPath . "/first_frame/".$new_image; 		imagejpeg($gd_image, $ff_img);		imagedestroy($gd_image);				//把First frame 縮細，作為預覽圖		$dest1 = $targetPath . "/thumb/".$new_image;		$destW = $config_data['thumb_max_width'];		$destH = 1;		switch ($subject)		{   			case "banner_video":			case "movie_gallery":				imagesResize_square($ff_img,$dest1,$destW);				break;			default:				imagesResize($ff_img,$dest1,$destW,$destH);			   break;		}		//取得影片的長寬		$video_width = 0;		$video_height = 0;		$video_width = $ffmpegInstance->getFrameWidth();		$video_height = $ffmpegInstance->getFrameHeight();				//Update the file name into the database		/* switch ($subject)			{     				case "banner_video":				$id2 = 0;				 break;				default:				$id2 = 0;				break;			}					*/					Update_videos($subject, $video_id, $_FILES['Filedata']['name'], $Name, $new_image, $id2, $video_width, $video_height);				//echo the file name		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);	}	// 如果沒有ffmpeg，直接儲存	else {   		//取得影片的長寬		$video_width = 0;		$video_height = 0;				Update_videos($subject, $video_id, $_FILES['Filedata']['name'], $Name, $new_image, $id2, $video_width, $video_height);				//echo the file name		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);		}  } }}//?> 
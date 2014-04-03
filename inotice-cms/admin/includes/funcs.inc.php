<?php
require_once('funcs_img.inc.php');

function show_msg($positive_msg, $error_msg, $tip_msg) 
{
	if 	($positive_msg != "") {
		//echo "<td><font color=\"blue\"><strong>$positive_msg</strong></font></td>";
		echo "<div class=\"mws-form-message success\">$positive_msg</div>";
	}
	if 	($error_msg != "") {
		//echo "<td><font color=\"red\"><strong>$error_msg</strong></font></td>";
		echo "<div class=\"mws-form-message error\">$error_msg</div>";
	}
	if 	($tip_msg != "") {
		//echo "<td><font color=\"yellow\"><strong>$tip_msg</strong></font></td>";
		echo "<div class=\"mws-form-message warning\">$tip_msg</div>";
	}
}

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


/* 	REF: http://php.net/manual/en/function.realpath.php
	Example: 
	$url = 'http://www.example.com/something/../else';
	echo canonicalize($url); //http://www.example.com/else
*/
function canonicalize($address)
{
    $address = explode('/', $address);
    $keys = array_keys($address, '..');

    foreach($keys AS $keypos => $key)
    {
        array_splice($address, $key - ($keypos * 2 + 1), 2);
    }

    $address = implode('/', $address);
    $address = str_replace('./', '', $address);
	return $address;
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
        //include('views/'.$TemplateFileName.'.php');
		require_once('views/'.$TemplateFileName.'.php');
    }
}

function get_basic_color_to_cbo($select_color)
{  
	$result = "";
	$color_name = array("Black","White","Red","Blue","LightBlue","Purple","Yellow","Lime","Silver","Grey","Orange","Brown","Green");
	$color_code = array("000000","FFFFFF","FF0000","0000FF","ADD8E6","800080","FFFF00","00FF00","C0C0C0","808080","FFA500","A52A2A","008000");
	tolog($select_color);
	$count = count($color_name);
	for ($i = 0; $i < $count; $i++) {
		if ($color_name[$i] == "White")
			$result .= "<option value='$color_code[$i]' style='background-color: #$color_code[$i];color: #000000;'".($select_color == $color_code[$i]?"selected":"").">$color_name[$i]</option>";
		else
			$result .= "<option value='$color_code[$i]' style='background-color: #$color_code[$i];color: #FFFFFF;'".($select_color == $color_code[$i]?"selected":"").">$color_name[$i]</option>";
	}
    return $result;
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
	$data['best_ratio_range'] = "";
	$data['fixed_resolution'] = true;
	$data['finished_resolution_text'] = "";
	$data['best_max_width'] = 0;
	$data['cover_max_width'] = 0;
	$data['thumb_max_width'] = 0;
	$data['display_height'] = 0;
	$data['display_width'] = 0;
	$data['fileExt'] = "*.jpg;*.jpeg;*.gif;*.png";
	$data['fileDesc'] = "Image File";
	$data['queueSizeLimit'] = 1;
	$data['folder'] = "";
	
	switch ($subject) {
		case "logo":
			$data['page_title'] = "System --> Company Logo"; 

			$data['best_resolution_text'] = "100 x 100";
			$data['best_ratio_range'] = "1 - 8.7";

			$data['fixed_resolution'] = false;
			//$data['finished_resolution_text'] = "870 x 100";
			
			$data['best_max_width'] = 0;
			$data['thumb_max_width'] = 0;
			$data['display_height'] = 100;
			$data['display_width'] = 150;
			$data['folder'] = "../images/logo";
			break;
		case "bg":
			$data['page_title'] = "System -> Background";
			$data['best_resolution_text'] = "1920 x 1080";
			$data['finished_resolution_text'] = "1920 x 1080";
			$data['best_max_width'] = 0;
			$data['thumb_max_width'] = 0;
			$data['display_width'] = 450;
			$data['folder'] = "../images/background";
			break;
		case "menu_icons":
			if ($id == -1) {
				$data['page_title'] = "System -> Menu Icons -> Add Icons";
			}
			else {
				$data['page_title'] = "System -> Menu Icons -> ID ".$id;
			}
			$data['best_resolution_text'] = "180 x 180";
			$data['finished_resolution_text'] = "180 x 180";
			$data['thumb_max_width'] = 0;
			$data['display_width'] = 140;
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../images/menu";
			break;
		case "news":
			$data['best_resolution_text'] = "180 x 180";
			$data['finished_resolution_text'] = "180 x 220";
			$data['best_max_width'] = 0;
			$data['thumb_max_width'] = 101;
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../images/news/photos";
			break;
		case "about_us":
			$data['best_resolution_text'] = "500 x 180";
			$data['finished_resolution_text'] = "500 x 180";
			$data['best_max_width'] = 0;
			$data['queueSizeLimit'] = 1;
			$data['folder'] = "../images/portfolio";
			break;
		case "banner_image":
			$data['best_resolution_text'] = "720 x 480";
			//$data['best_resolution_text'] = "100 x 100";
			$data['finished_resolution_text'] = "820 x 540";
			$data['best_max_width'] = 0;
			$data['thumb_max_width'] = 0;
			$data['queueSizeLimit'] = 5;
			$data['folder'] = "../images/banner";
			break;
		case "banner_video":
			$data['fixed_resolution'] = false;
			$data['thumb_max_width'] = 112;
			$data['fileExt'] = "*.flv;*.mov;*.mpg;*.mp4;";
			$data['fileDesc'] = "Video File";
			$data['queueSizeLimit'] = 5;
			$data['folder'] = "../videos";
			break;
		case "gallery":
			$data['fixed_resolution'] = false;
			$data['best_max_width'] = 700;
			$data['cover_max_width'] = 144;
			$data['thumb_max_width'] = 113;
			$data['queueSizeLimit'] = 18;
			$data['folder'] = "../images/gallery";
			break;
		case "movie_gallery":
			$data['fixed_resolution'] = false;
			$data['thumb_max_width'] = 112;
			$data['fileExt'] = "*.flv;*.mov;*.mpg;*.mp4;";
			$data['fileDesc'] = "Video File";
			$data['queueSizeLimit'] = 5;
			$data['folder'] = "../movgallery";
			break;			
	}
	return $data;
}

function video_aspect_name($id) {
	$result = "";
	switch ($id) {
			case 0:
				$result = "Keep Aspect Ratio";
				break;
			case 1:
				$result = "Fill Screen";
				break;
			case 2:
				$result = "Custom Size";
				break;
		}
    return $result;
}

function noNextLine($str) {
	$result = str_replace("\r", "", $str);
	$result = str_replace("\n", " ", $result);
    return $result;
}

function to_normal_size($str) {
	$result = $str;
	$zoom_size = 5;
	for ($i = 1; $i <= 7; $i++) {
		$size = $i * $zoom_size;
		$result = str_replace("<font size=\"$i\">", "<font size=\"$size\">", $result);
	}
    return $result;
}

function to_small_size($str) {
	$result = $str;
	$zoom_size = 5;
	for ($i = 1 * $zoom_size; $i <= 7 * $zoom_size; $i=$i + $zoom_size) {
		$size = $i / $zoom_size;
		$result = str_replace("<font size=\"$i\">", "<font size=\"$size\">", $result);
	}
    return $result;
}

function cutBr($str) {
    return str_replace("<br />", "", $str);
}

function dotToUnderscore($str) {
    return str_replace(".", "_|_", $str);
}


function underscoreToDot($str) {
    return str_replace("_|_", ".", $str);
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


 //REF: http://stackoverflow.com/questions/141315/php-check-for-a-valid-date-weird-date-conversions
function is_date($str)  {
    $flag = strpos($str, '-');

    if(intval($flag)<=0){
      $stamp = strtotime( $str );
     }else {
      list($y, $m, $d) = explode('-', $str);      
      $stamp = strtotime("$d-$m-$y");
     } 
      //var_dump($stamp) ;

      if (!is_numeric($stamp))
      {
         return false ;       
      }

      $month = date( 'n', $stamp ); // use n to get date in correct format
      $day   = date( 'd', $stamp );
      $year  = date( 'Y', $stamp );

      if (checkdate($month, $day, $year))
      {
         $dt = "$year-$month-$day" ;
         //return strftime("%d-%b-%Y", strtotime($dt));
         return true;
      }
	  else 
	  {
		return false ;
      }
 }



function file_download_link($file,$text,$hint,$err_msg) {
	if ((file_exists($file)) && ($file != "") ) {
		//echo "<a title=\"$hint\" href=\"$file\">$text</a>";
		echo "<a title=\"$hint\" href=\"#\" onclick=\"decision('Are you sure download?','$file')\">$text</a>";
	}
	else {
		echo "$text<br>";
		echo "<font color='red'>$err_msg</font>";
	}
} 



function delete_media($image_path,$image_bases,$del_type) {

switch ($del_type) {
	case "all":
		//Delete the files in the Path, /thumb, /cover, /best, /non-crop, /first_frame & /flv
		$sub_folder = array("","/thumb","/cover","/best","/non-crop","/first_frame", "/flv");
		break;
	case "":
		$sub_folder = array("");
		break;
	default:
		$sub_folder = array("/".$del_type);
		break;
}

for ($i = 0; $i < count($sub_folder); $i++)  {
	//If the file contain "Preview", don't delete this file
	if ( strpos($image_bases, "preview") === false ) {
		$path = $image_path.$sub_folder[$i]."/".$image_bases;
		if (file_exists($path)) {
			if (is_writable($path)) {
				tolog($path." delete successfully!!");
				if (!(unlink($path))) return false;
			}
		}
		else {
			tolog($path." not exist!!");
		}
	}
 }
return true;
}   

function tolog($str) { 
	$myFile = "_log.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	$str = Now()."-$str \r";
	fwrite($fh, $str);
	fclose($fh);
}

function Redirect($RedirectTo) 
{
    @header('location: '.$RedirectTo);
	echo "<script>location='$RedirectTo'</script>";
    exit();
}

function Redirect_wait($RedirectTo,$sec) 
{
	$RedirectTo = "; url=$RedirectTo";
	echo "<meta http-equiv=\"refresh\" content=\"$sec"."$RedirectTo\" />";
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
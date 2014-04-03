<?php
/* system vars */
$Config['SystemName'] = 'iNotice System';
$Config['Version'] = 'v2.1.1-boc';
$Config['display_name'] = $_SESSION['user']['display_name'];
//$Config['display_name'] = 'ADMINISTRATOR';


	
/* data&files paths */
$Config['logo_folder'] = "../images/logo";
$Config['bg_folder'] = "../images/background";
$Config['menu_icons_folder'] = "../images/menu";
$Config['news_folder'] = "../images/news/photos";
$Config['about_us_folder'] = "../images/portfolio";
$Config['banner_image_folder'] = "../images/banner";
$Config['banner_video_folder'] = "../videos";
$Config['gallery_folder'] = "../images/gallery";
$Config['movie_gallery_folder'] = "../movgallery";


////////////////////////Database connection//////////////////////////

$DBHost = "localhost";
$DBName = "inot-".$Config['Version'];
$DBUser = "root";
$DBPass = "";


$sqlzonehour = 0;
$zonehour = 0;
date_default_timezone_set("Asia/Brunei");

$db_connection = mysql_connect ($DBHost, $DBUser, $DBPass) OR die (mysql_error());  
$db_select = mysql_select_db ($DBName) or die (mysql_error());

mysql_query("SET `time_zone` = '".date('P')."'");
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

///////////////////End of Database connection////////////////////////


error_reporting(E_ERROR);
	
?>


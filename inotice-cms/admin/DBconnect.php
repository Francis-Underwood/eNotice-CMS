<?php
//$version = "2.0";
//$use_auth = 1;

$DBHost = "localhost";
$DBName = "enotice-cms2.0.1";
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
?>
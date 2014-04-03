<?php
	$positive_msg = "";
	$error_msg = "";
	$tip_msg = "";
	
	IF ((isset($_REQUEST['action'])) && (($_REQUEST['action']) == "del") && (isset($_REQUEST['id'])) )
	{
	if (del_news($_REQUEST['id'])) {
		$positive_msg = "News Deleted";
	 }  else  {
		$error_msg = "News delete failed!!!";
	 }
	}
	$news_count = Count_news(-1);
	$news_data = Select_news(-1);
	
	//Views Template("control_news_list");
	require_once('views/control_news_list.tmp.php');
?>
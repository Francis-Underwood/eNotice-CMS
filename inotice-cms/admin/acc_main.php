<?php
	switch ($_REQUEST["cpage"]){
		case "acc_management":
		$control_page_title = "Account Management";
	break;
		case "acc_change_pw":
		$control_page_title = "Change Password";
	break;
	default:
		$control_page_title = "Account Setting";
	}
	
	//Views Template("acc_main");
	require_once('views/acc_main.php');
?>
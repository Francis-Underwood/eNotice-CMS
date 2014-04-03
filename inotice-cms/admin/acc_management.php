<?php
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )	{
		$data['display_name'] = substr($_POST['display_name'],0,50);
		$data['email'] = substr($_POST['email'],0,500);
		
		$positive_msg = "";
		$error_msg = "";
		$tip_msg = "";
		
		if (Save_acc_info($data))  { 
			$positive_msg = "Saved";
			}  else  {
			$error_msg = "Saved failed!!!";
		}
	}
	$acc_data = Select_acc_info();
	
	//Views Template("acc_management");
	require_once('views/acc_management.php');
?>
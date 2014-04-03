<?php
	//Save the new password
	IF ( (isset($_POST['submit'])) && (($_POST['submit']) == "Change Password") )
	{
		$data['curr_pw'] = substr($_POST['curr_pw'],0,50);
		$data['new_pw1'] = substr($_POST['new_pw1'],0,50);
		
		$save_pw_result = Save_acc_pw($data);
		
		$positive_msg_change_pw = "";
		$error_msg_change_pw = "";
		$tip_msg_change_pw = "";
		
		switch ($save_pw_result)  {
			case "not match":
				$error_msg_change_pw = "Old Password Not Match, cannot change!!!";
				break;
			case "succ":
				$positive_msg_change_pw = "Password saved successfully!!!";
				break;
			case "failed":
				$error_msg_change_pw = "Saved failed!!!";
				break;		
		}
		//tolog($error_msg_change_pw);
		//tolog($positive_msg_change_pw);
		//tolog($error_msg_change_pw);		
	}

	

	//Save the Account Information
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )	{
		$data['display_name'] = substr($_POST['display_name'],0,50);
		$data['email'] = substr($_POST['email'],0,500);

		tolog($data['display_name']);
		tolog($data['email']);
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
	require_once('views/acc_management.tmp.php');
?>
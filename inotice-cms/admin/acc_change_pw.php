<?php
	IF ( (isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['curr_pw'] = substr($_POST['curr_pw'],0,50);
		$data['new_pw1'] = substr($_POST['new_pw1'],0,50);
		
		$save_pw_result = Save_acc_pw($data);
		
		$positive_msg = "";
		$error_msg = "";
		$tip_msg = "";
		
		switch ($save_pw_result)  {
			case "not match":
				$error_msg = "Old Password Not Match, cannot change!!!";
				break;
			case "succ":
				$positive_msg = "Password saved successfully!!!";
				break;
			case "failed":
				$error_msg = "Saved failed!!!";
				break;		
		}
	}

	//Views Template("acc_change_pw");
	require_once('views/acc_change_pw.tmp.php');
?>

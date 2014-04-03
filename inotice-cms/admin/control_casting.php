<?php

	$positive_msg = "";
	$error_msg = "";
	$tip_msg = "";
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
		$data['casting_color'] = substr($_POST['casting_color'],0,50);
		$data['casting_text'] = substr(noNextLine($_POST['casting_text']),0,5000);

		if (Save_casting($data)) {
			$positive_msg = "Saved";
		}  else  {
			$error_msg = "Saved failed!!!";
		}
	}
	$casting_data = Select_casting();

	//Views Template("control_casting");
	require_once('views/control_casting.php');
?>
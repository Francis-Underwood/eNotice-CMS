	<div class="mws-panel grid_8">
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg);?>
		<div class="mws-accordion ">
		   <?php
				//Display the top form
				switch ($top) {
					case "title":
						require_once('views/setting_main-title.tmp.php');
						break;
					case "bg":
						require_once('views/setting_main-bg.tmp.php');
						break;
					case "menu":
						require_once('views/setting_main-menu.tmp.php');
						break;
				}
				
				//Display other forms
				if ($top != "title") 	require_once('views/setting_main-title.tmp.php');
				if ($top != "bg") 		require_once('views/setting_main-bg.tmp.php');
				if ($top != "menu") 	require_once('views/setting_main-menu.tmp.php');
		   ?>
		</div>
	</div>
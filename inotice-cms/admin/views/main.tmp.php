<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head> <?php require_once('head.php'); ?> </head>
<body onload="idsquare.wilson.setFocus();">
	<?php 
		$page = $_REQUEST["page"];	
		require_once('page.php'); 
		require_once('1msg.php');
	?>
	<div id="container">
		<!-- Main Container -->
		<?php 
			if (isset($page)) {
				Template($page);
			}
			else
			{
				//require_once('control_main.php');
				
				//Unlink all deleted files when user visit here
				unlink_all_delete_files();	
			}
		?>
		<!-- End Main Container -->
	</div>
	<?php require_once('page_footer.php'); ?>
</body>
</html>
<?php
require_once('app.php');
RequireLogin();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head> <?php require_once('head.php'); ?> </head>
	
<body onload="setFocus();">
	<?php require_once('page.php'); ?>
	<div id="content">
		<?php 
			if (isset($_REQUEST["page"])) {
				Template($_REQUEST["page"]);
			}
			else
			{
				//require_once('control_main.php');
			}
		?>
	</div>
</body>
</html>
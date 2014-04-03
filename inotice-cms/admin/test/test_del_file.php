<?php
require_once('app.php');
$file = "../e-Notice.swf";


if ((file_exists($file)) &&  (is_writable($file))) {
	unlink($file);
}

?>
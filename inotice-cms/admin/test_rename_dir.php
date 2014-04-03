<?php
require_once('app.php');

$dir = "../xml2";
$new_dir = "../xml";

if ((is_dir($dir)) &&  (!(is_dir($new_dir)))) {
	rename($dir, $new_dir);
}

?>
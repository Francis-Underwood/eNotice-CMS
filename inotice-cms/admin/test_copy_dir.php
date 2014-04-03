<?php
require_once('app.php');

$dir = "../empty-image";
$new_dir = "../empty-image2";

if ((is_dir($dir)) &&  (!(is_dir($new_dir)))) {
	full_copy_dir($dir, $new_dir);
}

//Ref: http://www.wallpaperama.com/forums/how-to-copy-file-or-directory-in-php-scripts-code-copying-files-directories-t5847.html

function full_copy_dir($source, $target ) {
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				full_copy_dir( $Entry, $target . '/' . $entry );
				continue;
			}
			copy( $Entry, $target . '/' . $entry );
			tolog("Copy: ". $Entry."->". $target . '/' . $entry );
		}
 
		$d->close();
	}else {
		copy( $source, $target );
		tolog("Copy: ". $source."->". $target );
	}
}



//Ref: http://www.codingforums.com/showthread.php?t=146554
function copydir($source,$destination)   {
	if(!is_dir($destination)){
	$oldumask = umask(0); 
	mkdir($destination, 01777); // so you get the sticky bit set 
	umask($oldumask);
	}
	$dir_handle = @opendir($source) or die("Unable to open");
	while ($file = readdir($dir_handle)) 	{
	if($file!="." && $file!=".." && !is_dir("$source/$file")) //if it is file
		copy("$source/$file","$destination/$file");
	if($file!="." && $file!=".." && is_dir("$source/$file")) //if it is folder
		copydir("$source/$file","$destination/$file");
	}
	closedir($dir_handle);
}
?>
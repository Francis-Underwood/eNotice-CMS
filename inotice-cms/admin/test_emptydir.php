<?php
require_once('app.php');

$dir = "../images";         //***Only Delete the files in the first and the second folder only!!!!!***
if ((is_dir($dir)) &&  (is_writable($dir))) {
	emptyDir($dir);
}

//Ref: http://psoug.org/snippet/PHP-Delete-all-files-in-directory_34.htm

function emptyDir($path) { 
 
     // init the debug string
     $debugStr = '';
     $debugStr .= "Deleting Contents Of: $path<br /><br />";
 
     // parse the folder
     IF ($handle = OPENDIR($path)) {
 
          WHILE (FALSE !== ($file = READDIR($handle))) {
 
               IF ($file != "." && $file != "..") {
 
               // If it's a file, delete it
               IF(IS_FILE($path."/".$file)) {
 
                    IF(UNLINK($path."/".$file)) {
                    $debugStr .= "Deleted File: ".$file."<br />";     
                    }
 
               } ELSE {
 
                    // It's a directory...
                    // crawl through the directory and delete the contents               
                    IF($handle2 = OPENDIR($path."/".$file)) {
 
                         WHILE (FALSE !== ($file2 = READDIR($handle2))) {
 
                              IF ($file2 != "." && $file2 != "..") {
                                   IF(UNLINK($path."/".$file."/".$file2)) {
                                   $debugStr .= "Deleted File: $file/$file2<br />";     
                                   }
                              }
 
                         }
 
                    }
 
                    IF(RMDIR($path."/".$file)) {
                    $debugStr .= "Directory: ".$file."<br />";     
                    }
 
               }
 
               }
 
          }
 
     }
     tolog($debugStr);
	 echo $debugStr;
}
?>
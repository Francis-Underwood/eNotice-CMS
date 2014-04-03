<?php
require_once('app.php');

$dir = "../empty-image";
if ((is_dir($dir)) &&  (is_writable($dir))) {
	Delete($dir);
}

//Ref: http://stackoverflow.com/questions/1334398/how-to-delete-a-folder-with-contents-using-php

function Delete($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));
        foreach ($files as $file)
        {
            Delete(realpath($path) . '/' . $file);
			
			tolog("DELETE: ".realpath($path) . '/' . $file);
        }
        return rmdir($path);
    }
    else if (is_file($path) === true)
    {
		tolog("UNLINK: ".$path);
        return unlink($path);
    }
    return false;
}

function Delete_RecursiveIteratorIterator($path)
{
    if (is_dir($path) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file)
        {
            if (in_array($file->getBasename(), array('.', '..')) !== true)
            {
                if ($file->isDir() === true)
                {
                    rmdir($file->getPathName());
                }

                else if (($file->isFile() === true) || ($file->isLink() === true))
                {
                    unlink($file->getPathname());
                }
            }
        }

        return rmdir($path);
    }
    else if ((is_file($path) === true) || (is_link($path) === true))
    {
        return unlink($path);
    }
    return false;
}
?>
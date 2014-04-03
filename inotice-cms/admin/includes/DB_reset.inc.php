<?php

function unlink_all_delete_files() {
	unlink_all_deleted_media_files();
	unlink_log_files();
}

//���Ʈw�������s�b / �v�Ь��R�����ɮקR�h
function unlink_all_deleted_media_files() {
	unlink_deleted_files("logo");
	unlink_deleted_files("bg");
	unlink_deleted_files("menu_icons");
	unlink_deleted_files("about_us");
	unlink_deleted_files("news");
	unlink_deleted_files("banner_image");
	unlink_deleted_files("banner_video");
	unlink_deleted_files("gallery");
	unlink_deleted_files("movie_gallery");
}

//�R��log files
function unlink_log_files() {
	unlink("_log.txt");
	unlink("../xml/chi/_log.txt");
	unlink("includes/_log.txt");
	unlink("scripts/_log.txt");
}

function unlink_deleted_files($subject) {
	tolog("Start DELETE $subject");
	$config_data = upload_file_config($subject,-1);
	
	$path = $config_data['folder'];
	
	switch ($subject) {
		case "news":
		case "banner_image":
		case "banner_video":
		case "gallery":
		case "movie_gallery":
			//****��k�@�G��w�Ь��R�������R�h****
			
			//�q��ƮwŪ���w�Ь��R�������
			$db_image_count = Count_deleted_medias($subject);
			$db_image = Select_deleted_medias($subject);
			tolog("db_image_count:  ".$db_image_count);
			
			//�R�h�W�����ۤ��M�����Y��
			if (is_dir($path)) {
				for ($i = 0; $i < $db_image_count; $i++) 	{
					if ($db_image['image'][$i] != "") delete_media($path,$db_image['image'][$i],"all");
					if ($db_image['video'][$i] != "") delete_media($path,$db_image['video'][$i],"all");
				 }
			}
			//�q��Ʈw�ä[�R���w�����R�����O��
			Permanent_delete_medias($subject);
			break;
		case "logo":
		case "bg":
		case "menu_icons":
		case "about_us":
			//****��k�G�G�R�h���s�b�ɮ�****
			$db_image_count = Count_images($subject,-1,0);
			$db_image = Select_images($subject,-1,0);
			
			//�ˬd�p���s�b���Ʈw�A�R�h�W�����ۤ��M�����Y��
			if (is_dir($path)) {
				$files = getDirectoryList($path);
				$count = count($files);
				//tolog($count);
				for ($i = 0; $i < $count; $i++) 	{
					if (!(file_exist_in_array($files[$i], $db_image['image'], $db_image_count)))   {
						delete_media($path,$files[$i],"all");
					}
				 }
			}	
			
			//�A�ˬd���_�������ۤ� (��non-crop ���ۤ��A��root�����ۤ�)
			$path = $path."/non-crop";
			if (is_dir($path)) {
				$files = getDirectoryList($path);
				$count = count($files);
				//tolog($count);
				for ($i = 0; $i < $count; $i++) 	{
					if (!(file_exist_in_array($files[$i], $db_image['image'], $db_image_count)))   {
						delete_media($path,$files[$i],"");
					}
				 }
			}	
			break;
			
	}

}

function file_exist_in_array($target_path, $array, $count_of_array)   {
	tolog("count_of_array ".$count_of_array);
	
	$target_file_info = pathinfo($target_path);
	for ($k = 0; $k < $count_of_array; $k++) 	{
		tolog("loop array[k]:   ".$array[$k]);
		tolog("loop target_path:   ".$target_path);	
		if ($array[$k] != "") {
			$array_file_info = pathinfo($array[$k]);
			tolog("loop array_file_info['basename'] ".$array_file_info['basename']);
			tolog("loop target_file_info['basename'] ".$target_file_info['basename']);
			
			if ( $array_file_info['basename'] == $target_file_info['basename'] )  {
				tolog("true");
				return true;
			}
		}
	}
	tolog("false");
	return false;
}

function getDirectoryList ($directory) 	{
    $results = array();

    // create a handler for the directory
    $handler = opendir($directory);

    // open directory and walk through the filenames
    while ($file = readdir($handler)) {

      // if file isn't this directory or its parent, add it to the results
      if ($file != "." && $file != "..") {
		if (!( strpos($file, ".") === false )) {
			$results[] = $file; 
			//echo $file."<br>"; 		
		}
		
      }
    }

    // tidy up: close the handler
    closedir($handler);

    // done!
	//tolog(count($results));
    return $results;

  }

  
  
  
  
  
  
  
  
//��Ӹ�Ʈw�R��
function reset_whole_proc() {
	reset_folder();
	reset_db() ;
}

function reset_folder() {
	$sql = "UPDATE err_msg SET `err_msg`=".GetSQLValueString($msg,"text")." ";
	//tolog($sql);
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	return true;
}

function reset_db() {
	$sql = "UPDATE err_msg SET `err_msg`=".GetSQLValueString($msg,"text")." ";
	
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	return true;
}



?>

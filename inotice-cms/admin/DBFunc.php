<?php
require_once('DButility.php');
require_once('DB_reset.php');

//----------Error msg-----------
function Select_err_msg() {
	$query_rsview = "SELECT err_msg FROM err_msg ";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	$data = "";
	if ($totalRows_rsview >0 ){
			do {
				$data = $row_rsview['err_msg'];
			  } while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}


function Save_err_msg($msg) {
	$sql = "UPDATE err_msg SET `err_msg`=".GetSQLValueString($msg,"text")." ";
	//tolog($sql);
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	return true;
}


//-----Login-----
function AdminUser_getUser($loginname, $u_password) {

	$query_rsview = "SELECT * FROM admin_user WHERE loginname=".GetSQLValueString($loginname,"text");
	$query_rsview .= " AND u_password=".GetSQLValueString(md5($u_password),"text");

	$query_limit_rsview = sprintf("%s LIMIT %d, %d", $query_rsview, 0, 1);
	//echo $query_limit_rsview;
	$rsview = mysql_query($query_limit_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	//$array_rsview = mysql_fetch_array($rsview);

	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				return $row_rsview;
			} while($row_rsview = mysql_fetch_assoc($rsview));
	} 
	return null;
}


function AdminUser_update($data) {
    $SQL = "UPDATE admin_user SET is_login=".GetSQLValueString($data['is_login'],"int").", checkout_time=Now() ";
	$SQL .= "WHERE loginname=".GetSQLValueString($data['loginname'],"text")." ";
	mysql_query($SQL);
	return;
}

function AdminUser_update_adv($data) {
    $SQL = vsprintf("UPDATE admin_user SET u_type=%s, acs_level=%s, loginname=%s, u_password=%s WHERE loginname=%s ",
            array(
                (isset($data['u_type']) ? (GetSQLValueString($data['u_type'],"text")) : "null"),
                (isset($data['acs_level']) ? (GetSQLValueString($data['acs_level'],"int")) : "null"),
                (isset($data['loginname']) ? (GetSQLValueString($data['loginname'],"text")) : "null"),
                (isset($data['u_password']) ? (GetSQLValueString(md5($data['u_password']),"text")) : "null")
            ) );
	mysql_query($SQL);
	return;
}


//----------Account Information-----------
function Select_acc_info() {
	$query_rsview = "SELECT * FROM admin_user ";
	$query_rsview .= "WHERE (loginname = ".GetSQLValueString($_SESSION['user']['loginname'],"text").") ";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['u_password'] = $row_rsview['u_password'];
				$data['display_name'] = $row_rsview['display_name'];
				$data['email'] = $row_rsview['email'];
			  } while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}


function Save_acc_info($data) {
	$sql = "UPDATE admin_user SET `display_name`=".GetSQLValueString($data['display_name'],"text").", `email`=".GetSQLValueString($data['email'],"text")." ";
	$sql .= "WHERE (loginname = ".GetSQLValueString($_SESSION['user']['loginname'],"text").") ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	return true;
}

function Save_acc_pw($data) {
	$user_data = Select_acc_info();
	
	if (isset($user_data['u_password']))  {
		if ($user_data['u_password'] == md5($data['curr_pw']) )  {
			$sql = "UPDATE admin_user SET `u_password`=".GetSQLValueString(md5($data['new_pw1']),"text")." ";
			$sql .= "WHERE (loginname = ".GetSQLValueString($_SESSION['user']['loginname'],"text").") ";
			$result = mysql_query($sql);
			if (!($result)) {
				return "failed";
			}
			else {
				return "succ";
			}
		}
		else
		{
			return "not match";
		}
	}
	else
	{
		return "failed";
	}
}



//--------Casting--------
function Select_casting() {
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (module = 'casting' AND `name` = 'casting_text')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['casting'] = $row_rsview['config_str'];
				$data['casting_color'] = substr($row_rsview['config_str'],14,6);
				$data['casting_text'] = right($row_rsview['config_str'],mb_strlen($data['casting_text'])-22);
				$data['casting_text'] = left($data['casting_text'],mb_strlen($data['casting_text'])-7);
				
			  } while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}

function Select_casting_location() {
	//Xstart
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (module = 'casting' AND `name` = 'casting_xstart')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['xstart'] = $row_rsview['config_str'];		
			  } while($row_rsview = mysql_fetch_assoc($rsview));
	}
	
	//XEnd
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (module = 'casting' AND `name` = 'casting_xend')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['xend'] = $row_rsview['config_str'];		
			  } while($row_rsview = mysql_fetch_assoc($rsview));
	}
	
	//Ystart
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (module = 'casting' AND `name` = 'casting_ystart')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['ystart'] = $row_rsview['config_str'];		
			  } while($row_rsview = mysql_fetch_assoc($rsview));
	}
	
	return $data;
}

function Save_casting($data) {
	$casting_text = str_replace("'", "\'", $data['casting_text']);
	
	$sql = "UPDATE global_config SET `config_str`='<font color=\'".$data['casting_color']."\'>".$casting_text."</font>' ";
	$sql .= "WHERE (module = 'casting' AND `name` = 'casting_text')";
	//tolog("sql: ".$sql);
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	return true;
}

//----------About Us----------
function Select_about_us() {
	//Select the Description
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'about_us' AND `name` = 'about_us_desc')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['about_us_desc'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	//Select the pic
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'about_us' AND `name` = 'about_us_img')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['about_us_img'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}

function Save_about_us($data) {

	$sql = "UPDATE global_config SET `config_str`=".GetSQLValueString($data['about_us_desc'],"text")." ";
	$sql .= "WHERE (`module` = 'about_us' AND `name` = 'about_us_desc') ";
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	if (isset($data['deleted_img'])) {
	  for ($i = 0; $i <= (count($data['deleted_img']) - 1); $i++) {
		$sql = "UPDATE global_config SET `config_str`='' WHERE (`module` = 'about_us' AND `name` = 'about_us_img' AND `id` = ".$data['deleted_img'][$i].") ";
		//echo $sql;
		$result = mysql_query($sql);
		if (!($result)) {
			return false;
		}
	  }
	}
	return true;
}


//------------News-------------

function Count_news($news_id) {
	$query_rsview = "SELECT COUNT(`id`) AS `count_item` FROM news ";

	//Where case
	$query_rsview .= "WHERE ((1 = 1) ";
	$query_rsview .= (!($news_id == -1))?" AND (id = $news_id)":"";
	$query_rsview .= ") ";
	
	$query_rsview .= "ORDER BY `xdate` DESC, `id` DESC ";
	
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$item_count = $row_rsview['count_item'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $item_count;
}

function Select_news($news_id) {
	$query_rsview = "SELECT * , DATE_FORMAT(xdate, '%Y-%m-%d') as `xdate_str` FROM news ";
	
	//Where case
	$query_rsview .= "WHERE ((1 = 1) ";
	$query_rsview .= (!($news_id == -1))?" AND (id = $news_id)":"";
	$query_rsview .= ") ";
	
	$query_rsview .= "ORDER BY `xdate` DESC, `id` DESC ";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	$count = 0;
	$data= null;
	if ($totalRows_rsview >0 ){
			do {
				$data['id'][$count] = $row_rsview['id'];
				$data['xdate_str'][$count] = $row_rsview['xdate_str'];
				$data['title'][$count] = $row_rsview['title'];
				$data['summary'][$count] = $row_rsview['summary'];
				$data['content'][$count] = $row_rsview['content'];
				$data['am_time'][$count] = $row_rsview['am_time'];
				$count = $count + 1;
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}


function Save_news($id, $data) {
	if ($id<>0) {
		$sql = "UPDATE news SET `big`=".GetSQLValueString($data['big'],"text").", `xdate`=".GetSQLValueString($data['xdate'],"date").", ";
		$sql .= "`title`=".GetSQLValueString($data['title'],"text").", `summary`=".GetSQLValueString($data['summary'],"text").", ";
		$sql .= "`content`=".GetSQLValueString($data['content'],"text").", `am_time`=Now() ";
		$sql .= "WHERE (id = ".GetSQLValueString($id,"int").") ";
	}
	else
	{
		$sql = vsprintf("INSERT INTO news ( big, xdate, title, summary, content, cr_time, am_time ) VALUES ( %s, %s, %s, %s, %s, Now(), Now()) ",
            array(GetSQLValueString($data['big'],"text"), 
			GetSQLValueString($data['xdate'],"date"), 
			GetSQLValueString($data['title'],"text"), 
			GetSQLValueString($data['summary'],"text"), 
			GetSQLValueString($data['content'],"text")
			) );
	}
	//tolog($sql);
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	if (isset($data['deleted_news_img'])) {
	  for ($i = 0; $i <= (count($data['deleted_news_img']) - 1); $i++) {
		$sql = "UPDATE news_pic SET `deleted` = 1 WHERE ((`id` = ".$data['deleted_news_img'][$i]."))";
		$result = mysql_query($sql);
		if (!($result)) {
			return false;
		}
	  }
	}

	return true;
}


function del_news($news_id) {
	$sql = "DELETE FROM news ";
	$sql .= "WHERE (id = '$news_id') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	//del the news pic
	$sql = "UPDATE news_pic SET `deleted` = 1 ";
	$sql .= "WHERE (news_id = '$news_id') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	return true;
}
//----------Banner Image-----------------

function Count_banner_image($id) {
	$query_rsview = "SELECT COUNT(`id`) AS `count_item` FROM banner_image ";

	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) ";
	$query_rsview .= (!($id == -1))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	//tolog("COUNT sql: $query_rsview");
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$item_count = $row_rsview['count_item'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $item_count;
}

function Select_banner_image($id) {
	$query_rsview = "SELECT * FROM banner_image ";
	
	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) ";
	$query_rsview .= (!($id == -1))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$query_rsview .= "ORDER BY `id` ASC ";
	//tolog("SELECT sql: $query_rsview");
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	$count = 0;
	$data= null;
	if ($totalRows_rsview >0 ){
			do {
				$data['id'][$count] = $row_rsview['id'];
				$data['image'][$count] = $row_rsview['filename'];
				$data['transition_flow'][$count] = $row_rsview['transition_flow'];
				$data['transition_direction'][$count] = $row_rsview['transition_direction'];
				$count = $count + 1;
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}


function Save_banner_image($id, $data) {
	$data_transition = explode("_", $data['transition']);
	if ($id<>0) {
		$sql = "UPDATE banner_image SET `transition_flow`=".GetSQLValueString($data_transition[0],"text").", `transition_direction`=".GetSQLValueString($data_transition[1],"text").", ";
		$sql .= "`am_time`=Now() ";
		$sql .= "WHERE ((`deleted` = 0) AND (id = ".GetSQLValueString($id,"int").")) ";
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}

	return true;
	}	
}

function del_banner_images($data) {
	if (isset($data['deleted_img'])) {
	  for ($i = 0; $i <= (count($data['deleted_img']) - 1); $i++) {
		$sql = "UPDATE banner_image SET `deleted` = 1  WHERE ((`id` = ".$data['deleted_img'][$i]."))";
		$result = mysql_query($sql);
		if (!($result)) {
			return false;
		}
	  }
	}
	return true;
}

//----------Banner Video-----------------
function banner_flv_config() {
	$query_rsview = "SELECT config_str FROM global_config ";

	$query_rsview .= "WHERE ((`module` = 'banner') AND (`name` = 'banner_flv_config')) ";
	
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$config_str = $row_rsview['config_str'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $config_str;
}

function Count_banner_video($id) {
	$query_rsview = "SELECT COUNT(`id`) AS `count_item` FROM playlist ";

	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) ";
	$query_rsview .= (!($id == -1))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$item_count = $row_rsview['count_item'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $item_count;
}

function Select_banner_video($id) {
	$query_rsview = "SELECT * FROM playlist ";
	
	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) ";
	$query_rsview .= (!($id == -1))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$query_rsview .= "ORDER BY `id` ASC ";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	$count = 0;
	$data= null;
	if ($totalRows_rsview >0 ){
			do {
				$data['id'][$count] = $row_rsview['id'];
				$data['title'][$count] = $row_rsview['title'];
				$data['link'][$count] = $row_rsview['link'];
				$data['thumb'][$count] = $row_rsview['thumb'];
				$data['aspect_option'][$count] = $row_rsview['aspect_option'];
				$data['aspect_width'][$count] = $row_rsview['aspect_width'];
				$data['aspect_height'][$count] = $row_rsview['aspect_height'];
				$data['video_width'][$count] = $row_rsview['video_width'];
				$data['video_height'][$count] = $row_rsview['video_height'];
				$count = $count + 1;
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}

function Save_banner_video($id, $data) {
	if ($id<>0) {
		$sql = "UPDATE playlist SET `title`=".GetSQLValueString($data['title'],"text").", `aspect_option`=".GetSQLValueString($data['aspect_option'],"int").", ";
		$sql .= "`aspect_width`=".GetSQLValueString($data['aspect_width'],"int").", `aspect_height`=".GetSQLValueString($data['aspect_height'],"int").", ";
		$sql .= "`am_time`=Now() ";
		$sql .= "WHERE ((`deleted` = 0) AND (id = ".GetSQLValueString($id,"int").")) ";
	}
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}

	return true;
}

function del_banner_video($data) {
	if (isset($data['deleted_video'])) {
	  for ($i = 0; $i <= (count($data['deleted_video']) - 1); $i++) {
		$sql = "UPDATE playlist SET `deleted` = 1 WHERE ((`id` = ".$data['deleted_video'][$i]."))";
		$result = mysql_query($sql);
		if (!($result)) {
			return false;
		}
	  }
	}
	return true;
}

//---------------Gallery-----------------

function Count_gallery_album($id) {
	$query_rsview = "SELECT COUNT(`id`) AS `count_item` FROM gallery_album ";

	//Where case
	$query_rsview .= "WHERE ((1 = 1) ";
	$query_rsview .= (!($id == -1))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$item_count = $row_rsview['count_item'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $item_count;
}

function Select_gallery_album($id) {
	$query_rsview = "SELECT * , DATE_FORMAT(xdate, '%Y-%m-%d') as `xdate_str` FROM gallery_album ";
	
	//Where case
	$query_rsview .= "WHERE ((1 = 1) ";
	$query_rsview .= (!($id <= 0))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$query_rsview .= "ORDER BY `id` ASC ";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	$count = 0;
	$data= null;
	if ($totalRows_rsview >0 ){
			do {
				$data['id'][$count] = $row_rsview['id'];
				$data['xdate_str'][$count] = $row_rsview['xdate_str'];
				$data['cover'][$count] = Select_gallery_album_cover($row_rsview['id']);
				$data['cr_time'][$count] = $row_rsview['cr_time'];
				$data['title'][$count] = $row_rsview['title'];
				$count = $count + 1;
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}

function Select_gallery_album_cover($aid) {
	$query_rsview = "SELECT * FROM gallery ";
	
	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) AND (`as_cover` = 1) ";
	$query_rsview .= (!($aid == -1))?" AND (aid = $aid)":"";
	$query_rsview .= ") ";
	
	$query_rsview .= "ORDER BY `id` ASC LIMIT 1 ";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	$count = 0;
	$data= null;
	if ($totalRows_rsview >0 ){
			do {
				$data['id'][0] = $row_rsview['id'];
				$data['image'][0] = $row_rsview['big'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	else
	{
		//if no cover image selected
		$data['image'][0] = "preview.jpg";
	}
	return $data['image'][0];
}

function Save_gallery_album($aid, $data) {
	if ($aid > 0) {
		$sql = "UPDATE gallery_album SET `xdate` = ".GetSQLValueString($data['xdate'],"date").", `title`=".GetSQLValueString($data['title'],"text").", ";
		$sql .= "`am_time`=Now() ";
		$sql .= "WHERE (id = ".GetSQLValueString($aid,"int").") ";
	}
	else {
		$sql = "INSERT INTO gallery_album (`title`, `xdate`, `cr_time`) VALUES (".GetSQLValueString($data['title'],"text").", ".GetSQLValueString($data['xdate'],"date").", Now())";
	}
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	if (isset($data['as_cover'])) {
		if (!(Save_gallery_album_cover($aid, $data['as_cover']))) {
			return false;
		}
	}
	return true;
}

function Save_gallery_album_cover($aid, $cover_img_id) {
	//Clear all as_cover for all images to 0 firstly
	$sql = "UPDATE gallery SET `as_cover` = 0 ";
	$sql .= "WHERE ((`deleted` = 0) AND (aid = ".GetSQLValueString($aid,"int").")) ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	$sql = "UPDATE gallery SET `as_cover` = 1, `am_time` = Now() ";
	$sql .= "WHERE ((`deleted` = 0) AND (aid = ".GetSQLValueString($aid,"int").") AND (id = ".$cover_img_id.")) ";
	
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	return true;
}

function del_gallery_album($aid) {

	//Del all photos for this album firstly
	$sql = "UPDATE gallery SET `deleted` = 1 WHERE ((`aid` = ".$aid."))";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	//Del the album
	$sql = "DELETE FROM gallery_album WHERE ((`id` = ".$aid."))";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}

	return true;
}

function Count_gallery_photo($aid, $id) {
	$query_rsview = "SELECT COUNT(`id`) AS `count_item` FROM gallery ";

	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) ";
	$query_rsview .= (($aid >= 0))?" AND (aid = $aid)":"";
	$query_rsview .= (($id >= 0))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$item_count = $row_rsview['count_item'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $item_count;
}

function del_empty_gallery_album()  {
	$gallery_album_count = Count_gallery_album(-1);
	$gallery_album_data = Select_gallery_album(-1);
	if (($gallery_album_count) > 0) {
	  for ($i = 0; $i <= ($gallery_album_count - 1); $i++) {
		$gallery_album_photos_count = Count_gallery_photo($gallery_album_data['id'][$i], -1);
		if ($gallery_album_photos_count == 0) {
			del_gallery_album($gallery_album_data['id'][$i]);
		}
	  }
	}
}


function Select_gallery_photo($aid, $id) {
	$query_rsview = "SELECT * FROM gallery ";
	
	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) ";
	$query_rsview .= (($aid >= 0))?" AND (aid = $aid)":"";
	$query_rsview .= (($id >= 0))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$query_rsview .= "ORDER BY `id` ASC ";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	//echo $query_rsview;
	$count = 0;
	$data= null;
	if ($totalRows_rsview >0 ){
			do {
				$data['id'][$count] = $row_rsview['id'];
				$data['image'][$count] = $row_rsview['big'];
				$data['title'][$count] = $row_rsview['title'];
				$data['description'][$count] = $row_rsview['description'];
				$data['as_cover'][$count] = $row_rsview['as_cover'];
				$count = $count + 1;
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}

function Save_gallery_photo($aid, $id, $data) {
	if ($id<>0) {
		$sql = "UPDATE gallery SET `title`=".GetSQLValueString($data['title'],"text").", `description`=".GetSQLValueString($data['description'],"text").", ";
		$sql .= "`am_time`=Now() ";
		$sql .= "WHERE ((`deleted` = 0) AND (aid = ".GetSQLValueString($aid,"int").") AND (id = ".GetSQLValueString($id,"int").")) ";

	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	if (isset($data['as_cover'])) {
		if (!(Save_gallery_album_cover($aid, $data['as_cover']))) {
			return false;
		}
	}
		return true;	
	}
	else
	{
		return false;
	}
}

function del_gallery_photos($aid, $data) {
	if (isset($data['deleted_img'])) {
	  for ($i = 0; $i <= (count($data['deleted_img']) - 1); $i++) {
		$sql = "UPDATE gallery SET `deleted` = 1 WHERE ((`aid` = $aid) AND (`id` = ".$data['deleted_img'][$i]."))";
		$result = mysql_query($sql);
		if (!($result)) {
			return false;
		}
	  }
	  
	  //Delete the album if there is no photo in the album
	  if (Count_gallery_photo($aid, -1) == 0) {
		  if (!(del_gallery_album($aid)))  {
				return false;
		  }
	  }
	}
	return true;
}


//--------------Movie Gallery-----------------
function Count_movie_gallery($id) {
	$query_rsview = "SELECT COUNT(`id`) AS `count_item` FROM movgallery ";

	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) ";
	$query_rsview .= (!($id == -1))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$item_count = $row_rsview['count_item'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $item_count;
}

function Select_movie_gallery($id) {
	$query_rsview = "SELECT * , DATE_FORMAT(cr_time, '%W %D of %M %Y %r') AS `cr_time_long` FROM movgallery ";
	
	//Where case
	$query_rsview .= "WHERE ((`deleted` = 0) ";
	$query_rsview .= (!($id == -1))?" AND (id = $id)":"";
	$query_rsview .= ") ";
	
	$query_rsview .= "ORDER BY `id` ASC ";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	$count = 0;
	$data= null;
	if ($totalRows_rsview >0 ){
			do {
				$data['id'][$count] = $row_rsview['id'];
				$data['title'][$count] = $row_rsview['title'];
				$data['link'][$count] = $row_rsview['link'];
				$data['thumb'][$count] = $row_rsview['thumb'];
				$data['aspect_option'][$count] = $row_rsview['aspect_option'];
				$data['aspect_width'][$count] = $row_rsview['aspect_width'];
				$data['aspect_height'][$count] = $row_rsview['aspect_height'];
				$data['video_width'][$count] = $row_rsview['video_width'];
				$data['video_height'][$count] = $row_rsview['video_height'];
				$data['cr_time'][$count] = $row_rsview['cr_time'];
				$data['cr_time_long'][$count] = $row_rsview['cr_time_long'];
				$count = $count + 1;
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}

function Save_movie_gallery($id, $data) {
	if ($id<>0) {
		$sql = "UPDATE movgallery SET `title`=".GetSQLValueString($data['title'],"text").", `aspect_option`=".GetSQLValueString($data['aspect_option'],"int").", ";
		$sql .= "`aspect_width`=".GetSQLValueString($data['aspect_width'],"int").", `aspect_height`=".GetSQLValueString($data['aspect_height'],"int").", ";
		$sql .= "`am_time`=Now() ";
		$sql .= "WHERE ((`deleted` = 0) AND (id = ".GetSQLValueString($id,"int").")) ";
	}
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}

	return true;
}

function del_movie_gallery($data) {
	if (isset($data['deleted_video'])) {
	  for ($i = 0; $i <= (count($data['deleted_video']) - 1); $i++) {
		$sql = "UPDATE movgallery SET `deleted` = 1 WHERE ((`id` = ".$data['deleted_video'][$i]."))";
		$result = mysql_query($sql);
		if (!($result)) {
			return false;
		}
	  }
	}
	return true;
}

//----------Config Title (Company Title, subtitle, banner Type)----------
function Select_config_title() {
	//Select the Company Title
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'config' AND `name` = 'config_title')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['company_title'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	//Color
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'config' AND `name` = 'config_title_color')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['company_title_color'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	
	//Select the Company subtitle
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'config' AND `name` = 'config_subtitle')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['company_subtitle'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	
	//Color
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'config' AND `name` = 'config_subtitle_color')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['company_subtitle_color'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}

	//Current Time Color
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'config' AND `name` = 'config_curr_time_color')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['curr_time_color'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	
	//Weather Temp Color
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'config' AND `name` = 'config_weather_temp_color')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['weather_temp_color'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	
	//Select the Banner Type
	$query_rsview = "SELECT config_str FROM global_config ";
	$query_rsview .= "WHERE (`module` = 'config' AND `name` = 'config_banner_type')";
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	if ($totalRows_rsview >0 ){
			do {
				$data['banner_type'] = $row_rsview['config_str'];
		} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $data;
}

function Save_config_title($data) {

	//Save the Company Title
	$sql = "UPDATE global_config SET `config_str`=".GetSQLValueString($data['company_title'],"text")." ";
	$sql .= "WHERE (`module` = 'config' AND `name` = 'config_title') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	//Color
	$sql = "UPDATE global_config SET `config_str`=".GetSQLValueString($data['company_title_color'],"text")." ";
	$sql .= "WHERE (`module` = 'config' AND `name` = 'config_title_color') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	//Save the Company subtitle
	$sql = "UPDATE global_config SET `config_str`=".GetSQLValueString($data['company_subtitle'],"text")." ";
	$sql .= "WHERE (`module` = 'config' AND `name` = 'config_subtitle') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	//Color
	$sql = "UPDATE global_config SET `config_str`=".GetSQLValueString($data['company_subtitle_color'],"text")." ";
	$sql .= "WHERE (`module` = 'config' AND `name` = 'config_subtitle_color') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	//Current Time Color
	$sql = "UPDATE global_config SET `config_str`=".GetSQLValueString($data['curr_time_color'],"text")." ";
	$sql .= "WHERE (`module` = 'config' AND `name` = 'config_curr_time_color') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	//Weather temp Color
	$sql = "UPDATE global_config SET `config_str`=".GetSQLValueString($data['weather_temp_color'],"text")." ";
	$sql .= "WHERE (`module` = 'config' AND `name` = 'config_weather_temp_color') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	//Save the Banner Type
	$sql = "UPDATE global_config SET `config_str`=".GetSQLValueString($data['banner_type'],"text")." ";
	$sql .= "WHERE (`module` = 'config' AND `name` = 'config_banner_type') ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	return true;
}

function Save_menu_icon_data($id, $data) {
	$sql = "UPDATE config_menu SET `label`=".GetSQLValueString($data['label'],"text")." ";
	$sql .= "WHERE (`id` = ".$id.") ";
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	return true;
}
//------End of Config Title (Company Title, subtitle, banner Type)-------


//***Image Upload***
function Count_images($subject, $image_id, $id2) {
	$select_case = "";
	$where_case = "";

	//Select Case
	switch ($subject) {
		case "logo":
		case "bg":
		case "about_us":
				$select_case = "SELECT COUNT(`id`) AS `count_item` FROM global_config ";
			break;
		case "menu_icons":
				$select_case = "SELECT COUNT(`id`) AS `count_item` FROM `config_menu` ";
			break;
		case "news":
				$select_case = "SELECT COUNT(`id`) AS `count_item` FROM `news_pic` ";
			break;
		case "banner_image":
				$select_case = "SELECT COUNT(`id`) AS `count_item` FROM `banner_image` ";
			break;		
	}
	//Where Case
	$where_case .= "WHERE ((1=1) ";
	switch ($subject) {
		case "logo":
				$where_case .= "AND (module = 'config') AND (name = 'config_icon') ";
			break;
		case "bg":
				$where_case .= "AND (module = 'config') AND (name = 'config_background') ";
			break;
		case "about_us":
				$where_case .= "AND (module = 'about_us') AND (name = 'about_us_img') ";
			break;
		case "banner_image":
			$where_case .= "AND (deleted = 0) ";
				if (!($image_id == -1)) {
					$where_case .= "AND (id = '$image_id') ";
				}
			break;		
		case "menu_icons":
				if (!($image_id == -1)) {
					$where_case .= "AND (id = '$image_id') ";
				}
			break;
		case "news":
			$where_case .= "AND (deleted = 0) ";
				if (($id2 > 0)) {
					$where_case .= "AND (news_id = '$id2') ";
				}
				if (($image_id > 0)) {
					$where_case .= "AND (id = $image_id) ";
				}
			break;
	}
	$where_case .= ") ";
	$query_rsview = $select_case." ".$where_case;
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$item_count = $row_rsview['count_item'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $item_count;
}

function Select_images($subject, $image_id, $id2) {
	$select_case = "";
	$where_case = "";
	$order_case = "";
	//Select Case
	switch ($subject) {
		case "logo":
		case "bg":
		case "about_us":
				$select_case = "SELECT * FROM `global_config` ";
			break;
		case "menu_icons":
				$select_case = "SELECT * FROM `config_menu` ";
			break;
		case "news":
				$select_case = "SELECT * FROM `news_pic` ";
			break;
		case "banner_image":
				$select_case = "SELECT * FROM `banner_image` ";
			break;			
	}
	//Where Case
	$where_case .= "WHERE ((1=1) ";
	switch ($subject) {
		case "logo":
				$where_case .= "AND (module = 'config') AND (name = 'config_icon') ";
			break;
		case "bg":
				$where_case .= "AND (module = 'config') AND (name = 'config_background') ";
			break;
		case "about_us":
				$where_case .= "AND (module = 'about_us') AND (name = 'about_us_img') ";
			break;
		case "banner_image":
			$where_case .= "AND (deleted = 0) ";
				if (!($image_id == -1)) {
					$where_case .= "AND (id = '$image_id') ";
				}
			break;		
		case "menu_icons":
				if (!($image_id == -1)) {
					$where_case .= "AND (id = '$image_id') ";
				}
			break;
		case "news":
			$where_case .= "AND (deleted = 0) ";
				if (($id2 > 0)) {
					$where_case .= "AND (news_id = '$id2') ";
				}
				if (($image_id > 0)) {
					$where_case .= "AND (id = $image_id) ";
				}
			break;
	}
	$where_case .= ") ";
	
	//Order Case
	switch ($subject) {
		case "menu_icons":
				$order_case .= "ORDER BY `id` ASC ";
			break;
		case "about_us":
		case "news":
				$order_case .= "ORDER BY `id` ";
			break;
	}
	$query_rsview = $select_case." ".$where_case." ".$order_case;
    //echo $query_rsview;
	
	$count = 0;
	$data= null;	
	If (!($query_rsview == "")) {
		$rsview = mysql_query($query_rsview) or die(mysql_error());
		$row_rsview = mysql_fetch_assoc($rsview);
		$totalRows_rsview = mysql_num_rows($rsview);
		
		//Output "No Image" Pic if no record found or file name is empty
		$data['thumb_image'][$count] = "../images/preview.jpg";
		$data['image'][$count] = "../images/preview.jpg";
		$data['no_image'][$count] = true;
		
		if ($totalRows_rsview >0 ){
		
			$config_data = upload_file_config($subject,-1);
			do {
				$data['thumb_image'][$count] = "../images/preview.jpg";
				$data['image'][$count] = "../images/preview.jpg";
				$data['no_image'][$count] = true;
				
			switch ($subject) {
				case "logo":
					if (!($row_rsview['config_str'] == "")) {
						$data['no_image'][$count] = false;
						$data['thumb_image'][$count] = $config_data['folder']."/thumb/".$row_rsview['config_str'];
						$data['image'][$count] = $config_data['folder']."/".$row_rsview['config_str'];
					}
					break;
				case "bg":
					if (!($row_rsview['config_str'] == "")) {
						$data['no_image'][$count] = false;
						$data['thumb_image'][$count] = $config_data['folder']."/thumb/".$row_rsview['config_str'];
						$data['image'][$count] = $config_data['folder']."/".$row_rsview['config_str'];
					}
					break;
				case "about_us":
					$data['id'][$count] = $row_rsview['id'];
					if (!($row_rsview['config_str'] == "")) {
						$data['no_image'][$count] = false;
						$data['thumb_image'][$count] = $config_data['folder']."/thumb/".$row_rsview['config_str'];
						$data['image'][$count] = $config_data['folder']."/".$row_rsview['config_str'];
					}
					break;
				case "menu_icons":
					$data['id'][$count] = $row_rsview['id'];
					$data['fun'][$count] = $row_rsview['fun'];
					$data['label'][$count] = $row_rsview['label'];
					$data['module'][$count] = $row_rsview['module'];
					$data['xmlink'][$count] = $row_rsview['xmlink'];
					if (!($row_rsview['background'] == "")) {
						$data['no_image'][$count] = false;
						$data['image'][$count] = $config_data['folder']."/".$row_rsview['background'];
					}
					break;
				case "news":
					$data['id'][$count] = $row_rsview['id'];
					if (!($row_rsview['file'] == "")) {
						$data['no_image'][$count] = false;
						$data['id'][$count] = $row_rsview['id'];
						$data['image'][$count] = $row_rsview['file'];
					}
					break;
				case "banner_image":
					$data['id'][$count] = $row_rsview['id'];
					if (!($row_rsview['filename'] == "")) {
						$data['no_image'][$count] = false;
						$data['image'][$count] = $row_rsview['filename'];
					}
					break;
			}
			$count = $count + 1;
			} while($row_rsview = mysql_fetch_assoc($rsview));
		}
	  }
	return $data;
}

//$image_id = 0, Add image
function Update_images($subject, $image_id, $image_file_name, $org_file_name, $id2) {
	$cmd = "";
	$where_case = "";
	$org_file_name = str_replace("'", "`", $org_file_name);
	$org_file_name = mb_substr($org_file_name, 0, 12, 'UTF-8');	
	//Insert Cmd OR Update Cmd
	switch ($subject) {
		case "logo":
		case "bg":
		case "about_us":
				$cmd = "UPDATE global_config SET `config_str`=".GetSQLValueString($image_file_name,"text")." ";
			break;
		case "menu_icons":
				if (!($image_id == 0))
					$cmd = "UPDATE config_menu SET `background`=".GetSQLValueString($image_file_name,"text").", am_time=Now() ";
				else
					$cmd = "INSERT INTO config_menu (`background`, `cr_time`) Values(".GetSQLValueString($image_file_name,"text").", Now()) ";
			break;
		case "news":
				$cmd = "INSERT INTO news_pic (`news_id`, `file`, `cr_time`) Values($id2, ".GetSQLValueString($image_file_name,"text").", Now()) ";
			break;
		case "banner_image":
				$cmd = "INSERT INTO banner_image (`filename`, `transition_flow`, `transition_direction`, `cr_time`) Values(".GetSQLValueString($image_file_name,"text").", 'in', 'right', Now()) ";
			break;
		case "gallery":
				$cmd = "INSERT INTO gallery (`aid`, `big`, `title`, `cr_time`) Values($id2, ".GetSQLValueString($image_file_name,"text").", ".GetSQLValueString($org_file_name,"text").", Now()) ";
			break;
	}
	//Where Case
	switch ($subject) {
		case "logo":
				$where_case = "WHERE ((module = 'config') AND (name = 'config_icon')) ";
			break;
		case "bg":
				$where_case = "WHERE ((module = 'config') AND (name = 'config_background')) ";
			break;
		case "about_us":
				$where_case = "WHERE ((module = 'about_us') AND (name = 'about_us_img') ";
				if (($image_id > 0)) {
					$where_case .= " AND (id = $image_id) ";
				}
				$where_case .= ") ";
			break;
		case "menu_icons":
				if (($image_id > 0)) {
					$where_case = "WHERE ((id = $image_id)) ";
				}
			break;
	}
	
	$sql = $cmd." ".$where_case;
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	return true;
}



//**Delete Image**
//Clear the file name in the DB only

function del_image($subject, $image_id)  {
	$cmd = "";
	$where_case = "";
	//Insert Cmd OR Update Cmd
	switch ($subject) {
		case "logo":
		case "bg":
		case "about_us":
				$cmd = "UPDATE global_config SET `config_str`='' ";
			break;
		case "menu_icons":
				$cmd = "UPDATE config_menu SET `background`='', `label`='', `am_time`=null ";
			break;
		case "news":
				$cmd = "UPDATE news_pic SET `deleted` = 1 ";
			break;
		case "banner_image":
				$cmd = "UPDATE banner_image SET `deleted` = 1 ";
			break;
	}
	//Where Case
	switch ($subject) {
		case "logo":
				$where_case = "WHERE ((module = 'config') AND (name = 'config_icon')) ";
			break;
		case "bg":
				$where_case = "WHERE ((module = 'config') AND (name = 'config_background')) ";
			break;
		case "about_us":
				$where_case = "WHERE ((module = 'about_us') AND (name = 'about_us_img') ";
				if (!($image_id > 0)) {
					$where_case .= " AND (id = $image_id) ";
				}
				$where_case .= ") ";
			break;
		case "news":
		case "menu_icons":
		case "banner_image":
				if (($image_id > 0)) {
					$where_case = "WHERE ((id = $image_id)) ";
				}
			break;
	}
	
	$sql = $cmd." ".$where_case;
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	return true;
}
//***End of upload Images***




//***Upload Videos***
function Update_videos($subject, $video_id, $org_file_name, $video_file_name, $thumb_file_name, $id2, $video_width, $video_height) {
	$cmd = "";
	$where_case = "";
	//Insert Cmd OR Update Cmd
	$org_file_name = str_replace("'", "`", $org_file_name);
	$org_file_name = mb_substr($org_file_name, 0, 12, 'UTF-8');	
	
	switch ($subject) {
		case "banner_video":
				$cmd = "INSERT INTO playlist (`title`, `link`, `thumb`, `cr_time`, `video_width`,`video_height`) Values('$org_file_name', ".GetSQLValueString($video_file_name,"text").", ".GetSQLValueString($thumb_file_name,"text").", Now(), $video_width, $video_height) ";
			break;
		case "movie_gallery":
				$cmd = "INSERT INTO movgallery (`title`, `link`, `thumb`, `cr_time`) Values('$org_file_name', ".GetSQLValueString($video_file_name,"text").", ".GetSQLValueString($thumb_file_name,"text").", Now()) ";
			break;			
	}
	
	//Where Case
	/* switch ($subject) {
		case "":
				$where_case = "";
			break;
	}   */
	$sql = $cmd." ".$where_case;
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	return true;
}

//******Deleted medias********

function Count_deleted_medias($subject) {
	$select_case = "SELECT count(`id`) AS `count_item` FROM ";
	$where_case = "";

	//Select Case
	switch ($subject) {
		case "news":
				$select_case .= "`news_pic` ";
			break;
		case "banner_image":
				$select_case .= "`banner_image` ";
			break;			
		case "banner_video":
				$select_case .= "`playlist` ";
			break;		
		case "gallery":
				$select_case .= "`gallery` ";
			break;	
		case "movie_gallery":
				$select_case .= "`movgallery` ";
			break;				
	}
	//Where Case
	$where_case .= "WHERE ((`deleted`=1) ";
	$where_case .= ") ";
	
	$query_rsview = $select_case." ".$where_case;
    tolog($query_rsview);
	
	$item_count = 0;
	$rsview = mysql_query($query_rsview) or die(mysql_error());
	$row_rsview = mysql_fetch_assoc($rsview);
	$totalRows_rsview = mysql_num_rows($rsview);
	
	if ($totalRows_rsview >0 ){
			do {
				$item_count = $row_rsview['count_item'];
			} while($row_rsview = mysql_fetch_assoc($rsview));
	}
	return $item_count;
}


function Select_deleted_medias($subject) {
	$select_case = "";
	$where_case = "";
	$order_case = "";
	//Select Case
	switch ($subject) {
		case "news":
				$select_case = "SELECT * FROM `news_pic` ";
			break;
		case "banner_image":
				$select_case = "SELECT * FROM `banner_image` ";
			break;			
		case "banner_video":
				$select_case = "SELECT * FROM `playlist` ";
			break;		
		case "gallery":
				$select_case = "SELECT * FROM `gallery` ";
			break;	
		case "movie_gallery":
				$select_case = "SELECT * FROM `movgallery` ";
			break;				
	}
	//Where Case
	$where_case .= "WHERE ((`deleted`=1) ";
	$where_case .= ") ";
	
	//Order Case
	$order_case .= "ORDER BY `id` ASC";
	
	$query_rsview = $select_case." ".$where_case." ".$order_case;
    //echo $query_rsview;
	
	$count = 0;
	$data= null;	
	If (!($query_rsview == "")) {
		$rsview = mysql_query($query_rsview) or die(mysql_error());
		$row_rsview = mysql_fetch_assoc($rsview);
		$totalRows_rsview = mysql_num_rows($rsview);
		
		$data['image'][$count] = "";
		$data['video'][$count] = "";
		
		if ($totalRows_rsview >0 ){
		
			do {
				$data['image'][$count] = "";
				$data['video'][$count] = "";
				$data['id'][$count] = $row_rsview['id'];				
			switch ($subject) {
				case "news":
					if (!($row_rsview['file'] == "")) {
						$data['image'][$count] = $row_rsview['file'];
					}
					break;
				case "banner_image":
					if (!($row_rsview['filename'] == "")) {
						$data['image'][$count] = $row_rsview['filename'];
					}
					break;
				case "banner_video":
					if (!($row_rsview['link'] == "")) {
						$data['image'][$count] = $row_rsview['thumb'];
						$data['video'][$count] = $row_rsview['link'];
					}
					break;
				case "gallery":
					if (!($row_rsview['big'] == "")) {
						$data['image'][$count] = $row_rsview['big'];
					}
					break;	
				case "movie_gallery":
					if (!($row_rsview['link'] == "")) {
						$data['image'][$count] = $row_rsview['thumb'];
						$data['video'][$count] = $row_rsview['link'];
					}
					break;	
			}
			$count = $count + 1;
			} while($row_rsview = mysql_fetch_assoc($rsview));
		}
	  }
	return $data;
}

function Permanent_delete_medias($subject) {
	$cmd = "";
	$where_case = "";

	switch ($subject) {
		case "news":
				$cmd = "DELETE FROM `news_pic` ";
			break;
		case "banner_image":
				$cmd = "DELETE FROM `banner_image` ";
			break;			
		case "banner_video":
				$cmd = "DELETE FROM `playlist` ";
			break;		
		case "gallery":
				$cmd = "DELETE FROM `gallery` ";
			break;	
		case "movie_gallery":
				$cmd = "DELETE FROM `movgallery` ";
			break;				
	}
	
	//Where Case
	$where_case .= "WHERE ( (`deleted` = 1) ) ";
	/* switch ($subject) {
		case "":
				$where_case .= "";
			break;
	}  */
	$sql = $cmd." ".$where_case;
	//echo $sql;
	$result = mysql_query($sql);
	if (!($result)) {
		return false;
	}
	
	return true;
}

?>

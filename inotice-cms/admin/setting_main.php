<script type="text/javascript">
	function validation(form1) {
		company_title = document.form1.company_title.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		
		if (company_title.length == 0) {
			err_msg = err_msg + "\n- [ Company Title ]";
		}
	
		if (err_msg.length > 34) {
			alert(err_msg);
			return false;
		}
		return true;
	}
	
</script>
<div id="content">
<table border="0" width="780">
  <tr>
	<td class="cell_2color" colspan="2" valign="top"><strong><font size="+2">Setting</font></strong></td>
  </tr>
</table>

<table border="1" width="780">
  <tr>
<?php

	//Update Title
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	$data['company_title'] = substr($_POST['company_title'],0,45);
	$data['company_subtitle'] = substr($_POST['company_subtitle'],0,45);
	$data['banner_type'] = substr($_POST['banner_type'],0,2);

	if (Save_config_title($data)) {
	?>
		<td colspan="2"><font color="blue">Saved</font></td>
	<?php
	}  else  {
	?>
		<td colspan="2"><font color="red"><strong>Save failed!!!</strong></font></td>
	<?php  }
	}
	
	//Delete Image
	IF ((isset($_GET['action'])) && (($_GET['action']) == "del") && (isset($_GET['subject'])) && (!(isset($_POST['submit']))) )
	{
	  if (del_image(($_GET['subject']),(isset($_GET['id']))?($_GET['id']):-1) ) {
	  ?>
		<td colspan="2"><font color="blue">Deleted</font></td>
	  <?php
	  }  else  {
	  ?>
		<td colspan="2"><font color="red"><strong>Delete failed!!!</strong></font></td>
	  <?php  }
	}
	
	$config_title_data = Select_config_title();
	?>
	
  </tr>
<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top" height="40"><strong>Cover Heading</strong></td>
	<td bgcolor="#BAC7CE" width="624" valign="middle">
		<input type="text" name="company_title" maxlength="20" value="<?php echo $config_title_data['company_title'];?>" style="width:350px">
	</td>
  </tr>
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top" height="40"><strong>Cover Subtitle</strong></td>
	<td bgcolor="#BAC7CE" width="624" valign="middle">
		<input type="text" name="company_subtitle" maxlength="50" value="<?php echo $config_title_data['company_subtitle'];?>" style="width:350px">
	</td>
  </tr>
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top" height="40"><strong>Banner Type</strong></td>
	<td bgcolor="#BAC7CE" width="624" valign="middle">
		<label for="banner_type_i"><input type="radio" id="banner_type_i" name="banner_type" value="i" <?php echo ($config_title_data['banner_type'] == "i")?"checked":"";?>>Image</label><br>
		<label for="banner_type_v"><input type="radio" id="banner_type_v" name="banner_type" value="v" <?php echo ($config_title_data['banner_type'] == "v")?"checked":"";?>>Video</label><br>
	</td>
  </tr>
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top" height="40">&nbsp;</td>
	<td bgcolor="#BAC7CE" width="624" valign="middle" align="right">
		<input name="submit" type="submit" class="button" id="submit" value="Save" />	
	</td>
  </tr>
</form>
</table>
</br>
<table border="1" width="780">
<!--Logo-->
  <?php 
	$config_data = upload_file_config("logo",-1);
	$company_logo_image = Select_images("logo",-1,0);
  ?>
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top"><strong>Company Logo <br> (Best <?php echo $config_data['best_resolution_text'];?>)</strong></td>
	<td bgcolor="#BAC7CE" width="564" valign="top">
		<?php output_image($company_logo_image['image'][0],100,0,"","Img not found!!"); ?>
	</td>
	<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
		<a href="main.php?page=setting_image_edit&subject=logo"><img src="images/icons/edit.png" width="20"></a>
	</td>
	<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
		<?php if (!($company_logo_image['no_image'][0])) {?>
		 <a href="#" onclick="decision('Are you sure delete?','main.php?page=setting_main&subject=logo&action=del')">
			<img src="images/icons/remove.png" width="20">
		 </a>
		<?php } ?>
	</td>
  </tr>
 <!--Background-->
 <?php
	$config_data = upload_file_config("bg",-1);
	$background_image = Select_images("bg",-1,0); 
 ?>
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top"><strong>Background<br>(Best <?php echo $config_data['best_resolution_text'];?>)</strong></td>
	<td bgcolor="#BAC7CE" width="564" valign="top">
		<?php output_image($background_image['image'][0],450,0,"","Img Not found!!"); ?>
	</td>
	<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
		<a href="main.php?page=setting_image_edit&subject=bg"><img src="images/icons/edit.png" width="20"></a>
	</td>
	<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
		<?php if (!($background_image['no_image'][0])) {?>
		 <a href="#" onclick="decision('Are you sure delete?','main.php?page=setting_main&subject=bg&action=del')">
			<img src="images/icons/remove.png" width="20">
		 </a>
		<?php } ?>
	</td>
  </tr>
</table>
</br>


<!--Menu Icon-->
<?php
	$menu_icon_count = Count_images("menu_icons",-1,0);
	$menu_icon_data = Select_images("menu_icons",-1,0);
?>
<table border="1" width="780">
	  <tr>
		<td bgcolor="#BAC7CE" height="30" valign="middle" colspan="6"><strong><font size="+1">Menu Icons</font></strong></td>
	  </tr>
	  <tr>
		<td bgcolor="#BAC7CE" width="30" valign="middle"><strong>ID</strong></td>
		<td bgcolor="#BAC7CE" width="30" valign="middle"><strong>FUN</strong></td>
		<td bgcolor="#BAC7CE" width="246" valign="middle"><strong>Icons</strong></td>
		<td bgcolor="#BAC7CE" width="414" valign="middle"><strong>Title</strong></td>
		<td bgcolor="#BAC7CE" width="60" valign="middle" colspan="2" align="center">
			&nbsp;<!--<img src="images/icons/add_table.png" width="20">
			<a href="main.php?page=setting_image_edit&subject=menu_icons_add&id=-1"><img src="images/icons/add_table.png" width="20"></a>-->
		</td>
	  </tr>
	<?php if (($menu_icon_count) > 0) { ?>
	 <?php for ($i = 0; $i <= ($menu_icon_count - 1); $i++) {  ?>
	  <tr>
		<td bgcolor="#BAC7CE" width="30" valign="top"><?php echo $menu_icon_data['id'][$i]; ?></td>
		<td bgcolor="#BAC7CE" width="30" valign="top"><?php echo $menu_icon_data['fun'][$i]; ?></td>
		<td bgcolor="#BAC7CE" width="246" valign="top"><?php output_image($menu_icon_data['image'][$i],80,0,"","Img not found!!"); ?></td>
		<td bgcolor="#BAC7CE" width="414" valign="top"><?php echo $menu_icon_data['label'][$i]; ?>&nbsp;</td>
		<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
			<a href="main.php?page=setting_image_edit&subject=menu_icons&id=<?php echo $menu_icon_data['id'][$i]; ?>"><img src="images/icons/edit.png" width="20"></a>
		</td>
		<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
		<?php if (!($menu_icon_data['no_image'][$i])) {?>
		 <a href="#" onclick="decision('Are you sure delete?','main.php?page=setting_main&subject=menu_icons&action=del&id=<?php echo $menu_icon_data['id'][$i]; ?>')">
			<img src="images/icons/remove.png" width="20">
		 </a>
		<?php } ?>
		</td>
	  </tr>
	<?php }
	}
	?>
</table>
</br>
</div>
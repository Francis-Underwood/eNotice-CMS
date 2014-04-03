<table>
<?php
$config_data = upload_file_config("banner_video",-1);
	
 If (isset($_REQUEST['id'])) {
	$id = ($_REQUEST['id']);
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	$data['title'] = $_POST['title'];
	$data['aspect_option'] = $_POST['aspect_option'];
	$data['aspect_width'] = $_POST['aspect_width'];
	$data['aspect_height'] = $_POST['aspect_height'];
	
	if (Save_banner_video($id, $data)) {
	?>
		<td><font color="blue">Saved</font></td>
	<?php
	}  else  {
	?>
		<td><font color="red"><strong>Saved failed!!!</strong></font></td>
	<?php  }
	
	}
	
	$banner_video_count = Count_banner_video($id);
	$banner_video_data = Select_banner_video($id);
?>
</table>

<table id="table-4" width="100%">
<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<!--<thead>
		<th width="280">&nbsp;</th>
		<th width="280"><div align="right"></div></th>
	</thead>-->
	<?php 
	if (($banner_video_count) > 0) {  ?>
	<?php for ($i = 0; $i <= ($banner_video_count - 1); $i++) {?>
				<tr height="150">
					<td colspan="1">&nbsp;</td>
					<td colspan="1">
						<?php output_image($config_data['folder']."/thumb/".$banner_video_data['thumb'][$i],0,0,"","Thumb Error, Please check your image!"); ?>
					</td>
				</tr>
				<tr>
					<td width="40%" valign="center"><font color="#000000">Video Title: <br>(Maximum Length is 20) </font></td>
					<td width="60%"><input name="title" type="text" id="title" value="<?php echo $banner_video_data['title'][$i]; ?>" maxlength="20"/></td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Configation:</font></td>
					<td >
						<select name="aspect_option" id="aspect_width" style="width:300px">
							<option value='0' <?php echo ($banner_video_data['aspect_option'][$i] == 0?"selected":""); ?>> Fill Screen</option>
							<option value='1' <?php echo ($banner_video_data['aspect_option'][$i] == 1?"selected":""); ?>> Keep Aspect Ratio</option>
						</select>
					</td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Aspect Width</font></td>
					<td>
						<select name="aspect_width" id="aspect_width" style="width:300px">
						<?php
						for ($x = 95;$x >= 5;$x=$x-5) {   ?>
							<option value='<?php echo $x;?>' <?php echo ($banner_video_data['aspect_width'][$i] == $x?"selected":""); ?>>
							<?php echo $x;?>%</option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Aspect Height</font></td>
					<td>
						<select name="aspect_height" id="aspect_height" style="width:300px">
						<?php
						for ($x = 95;$x >= 5;$x=$x-5) {   ?>
							<option value='<?php echo $x;?>' <?php echo ($banner_video_data['aspect_height'][$i] == $x?"selected":""); ?>>
							<?php echo $x;?>%</option>
						<?php } ?>
						</select>
					</td>
				</tr>
	<?php }  ?>
	<?php
	}
	else
	{ ?>
	<tr>
		<td valign="center" colspan="2"><font color="RED">No Video!!!!</font></td>
	</tr>
	<?php }
	?>
	<tr>
		<td align="right" valign="middle" colspan="1" height="50">&nbsp;</td>
		<td align="right" valign="middle" colspan="1" height="50">
			<table width="100%">
				<tr>
					<td width="50%" align="center"><input name="submit" type="submit" class="button" id="submit" value="Save" /></td>
					<td width="50%" align="center">
						<input name="id" type="hidden" value="<?echo $id;?>" />		
						<input name="back" type="button" class="button" id="back" value="Cancel" onClick="location='main.php?page=control_main&cpage=control_banner_video_list'">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</form>
</table>
<?php  } ?>
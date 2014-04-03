<table>
<?php
$config_data = upload_file_config("banner_image",-1);
	$transition_flow_list = array("in", "out");
	$transition_direction_list = array("right", "left", "up", "down");
	
 If (isset($_REQUEST['id'])) {
	$id = ($_REQUEST['id']);
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	$data['transition_flow'] = $_POST['transition_flow'];
	$data['transition_direction'] = $_POST['transition_direction'];
	
	if (Save_banner_image($id, $data)) {
	?>
		<td><font color="blue">Saved</font></td>
	<?php
	}  else  {
	?>
		<td><font color="red"><strong>Saved failed!!!</strong></font></td>
	<?php  }
	
	}
	
	$banner_image_count = Count_banner_image($id);
	$banner_image_data = Select_banner_image($id);
?>
</table>

<table id="table-4" width="100%">
<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<!--<thead>
		<th width="280">&nbsp;</th>
		<th width="280"><div align="right"></div></th>
	</thead>-->
	<?php 
	if (($banner_image_count) > 0) {  ?>
	<tr>	
	<?php for ($i = 0; $i <= ($banner_image_count - 1); $i++) {?>
		<td valign="center">
			<table width="100%">
				<tr>
					<td colspan="2">
						<?php output_image($config_data['folder']."/best/".$banner_image_data['image'][$i],0,0,"","Thumb Error, Please check your image!"); ?>
					</td>
				</tr>
				<tr>
					<td width="33%" valign="center"><font color="#000000">Item</font></td>
					<td width="67%"><font color="#000000"><?php echo $banner_image_data['id'][$i]; ?></font></td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Flow</font></td>
					<td>
						<select name="transition_flow" id="transition_flow" style="width:360px">
						<?php
						for ($x = 0;$x < sizeof($transition_flow_list) ;$x++) {   ?>
							<option value='<?php echo $transition_flow_list[$x];?>' <?php echo ($banner_image_data['transition_flow'][$i] == $transition_flow_list[$x]?"selected":""); ?>>
							<?php echo properCase($transition_flow_list[$x]);?></option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Direction</font></td>
					<td>
						<select name="transition_direction" id="transition_direction" style="width:360px">
						<?php
						for ($x = 0;$x < sizeof($transition_direction_list);$x++) {   ?>
							<option value='<?php echo $transition_direction_list[$x];?>' <?php echo ($banner_image_data['transition_direction'][$i] == $transition_direction_list[$x]?"selected":""); ?>>
							<?php echo properCase($transition_direction_list[$x]);?></option>
						<?php } ?>
						</select>
					</td>
				</tr>
			</table>
		</td>
		<?php if (!($i % 2 == 0)) {?>
			</tr> <tr>
		<? }  ?>
	<?php }  ?>
	</tr>
	<?php
	}
	else
	{ ?>
	<tr>
		<td valign="center" colspan="2">
			<font color="RED">No Image!!!!</font>
		</td>
	</tr>
	<?php }
	?>
	<tr>
		<td align="right" valign="middle" colspan="2" height="50">
			<input name="submit" type="submit" class="button" id="submit" value="Save" />&nbsp;
			<input name="id" type="hidden" value="<?echo $id;?>" />
			<input name="back" type="button" class="button" id="back" value="Cancel" onClick="location='main.php?page=control_main&cpage=control_banner_img_list'">		
		</td>
	</tr>
</form>
</table>
<?php  } ?>
<table>
	<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?>  </tr>
</table>

<script type="text/javascript">
function show_sliderbar_value(newValue,to)
{ document.getElementById(to).innerHTML=newValue; }

function disableField(obj, field1, field2) {
   var Field1 = document.getElementById(field1);
   var Field2 = document.getElementById(field2);
   
   if (obj.value == "2") {
      Field1.disabled = false;
	  Field2.disabled = false;
   }
   else {
      Field1.disabled = true;
	  Field2.disabled = true;
   }
}
</script>

<table id="table-4" width="100%">
	<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
		<!--<thead>
			<th width="280">&nbsp;</th>
			<th width="280"><div align="right"></div></th>
		</thead>-->
		<?php 
		if (($banner_video_count) > 0) {  ?>
		<?php for ($i = 0; $i <= ($banner_video_count - 1); $i++) { 
				$disabled_aspect = ($banner_video_data['aspect_option'][$i] == 2)?(""):(" disabled "); ?>
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
							<select name="aspect_option" id="aspect_option" style="width:300px" onchange="disableField(this,'aspect_width','aspect_height')">
								<option value='0' <?php echo ($banner_video_data['aspect_option'][$i] == 0?"selected":""); ?>> Keep Aspect Ratio</option>						
								<option value='1' <?php echo ($banner_video_data['aspect_option'][$i] == 1?"selected":""); ?>> Fill Screen</option>
								<option value='2' <?php echo ($banner_video_data['aspect_option'][$i] == 2?"selected":""); ?>> Custom Size</option>
							</select>
						</td>
					</tr>
					<tr>
						<td valign="center"><font color="#000000">Aspect Width</font></td>
						<td>
							<input name="aspect_width" id="aspect_width" type="range" min="100" max="<?php echo $banner_video_data['video_width'][$i]; ?>" value="<?php echo $banner_video_data['aspect_width'][$i]; ?>" step="5" onchange="show_sliderbar_value(this.value,'aspect_width_range')" style="width:270px" <?php echo $disabled_aspect; ?>/><span id="aspect_width_range"><?php echo $banner_video_data['aspect_width'][$i]; ?></span>
						</td>
					</tr>
					<tr>
						<td valign="center"><font color="#000000">Aspect Height</font></td>
						<td>
							<input name="aspect_height" id="aspect_height" type="range" min="100" max="<?php echo $banner_video_data['video_height'][$i]; ?>" value="<?php echo $banner_video_data['aspect_height'][$i]; ?>" step="5" onchange="show_sliderbar_value(this.value,'aspect_height_range')" style="width:270px" <?php echo $disabled_aspect; ?>/><span id="aspect_height_range"><?php echo $banner_video_data['aspect_height'][$i]; ?></span>
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
<table>
	<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?>  </tr>
</table>

<table id="table-4" width="100%">
<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<!--<thead>
		<th width="280">&nbsp;</th>
		<th width="280"><div align="right"></div></th>
	</thead>-->

	<?php 
	if (($gallery_photo_count) > 0) {  ?>
	<tr>	
	<?php for ($i = 0; $i <= ($gallery_photo_count - 1); $i++) {?>
		<td valign="center">
			<table width="100%">
				<tr>
					<td colspan="2">
						<?php output_image($config_data['folder']."/best/".$gallery_photo_data['image'][$i],0,0,"","Thumb Error!!"); ?>
					</td>
				</tr>
				<tr>
					<td width="33%" valign="center"><font color="#000000">Title (Max 20 chars)</font></td>
					<td width="67%">
						<input name="title" type="text" id="title" value="<?php echo $gallery_photo_data['title'][$i];?>" maxlength="20" style="width:350px"/>
					</td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Description</font></td>
					<td>
						<textarea name="description" id="description" rows="5" cols="50"><?php echo $gallery_photo_data['description'][$i];?></textarea>
					</td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Set for Cover</font></td>
					<td>
						<input type="checkbox" name="as_cover" id="as_cover" value="<?php echo $gallery_photo_data['id'][$i]; ?>" <?php echo ($gallery_photo_data['as_cover'][$i] == 1)?"checked":"";?>>
					</td>
				</tr>
			</table>
		</td>
	<?php }  ?>
	</tr>
	<?php
	}
	else
	{ ?>
	<tr>
		<td valign="center" colspan="2"><font color="RED">No Image!!!!</font></td>
	</tr>
	<?php }
	?>
	<tr>
		<td align="right" valign="middle" colspan="2" height="50">
			<input name="submit" type="submit" class="button" id="submit" value="Save" />&nbsp;
			<input name="aid" type="hidden" value="<?echo $aid;?>" />
			<input name="id" type="hidden" value="<?echo $id;?>" />
			<input name="back" type="button" class="button" id="back" value="Cancel" onClick="location='main.php?page=control_main&cpage=control_gallery_edit&aid=<?php echo $aid;?>'">		
		</td>
	</tr>
</form>
</table>
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
		if (($movie_gallery_count) > 0) {  ?>
		<?php for ($i = 0; $i <= ($movie_gallery_count - 1); $i++) {?>
					<tr height="150">
						<td colspan="1">&nbsp;</td>
						<td colspan="1">
							<?php output_image($config_data['folder']."/thumb/".$movie_gallery_data['thumb'][$i],0,0,"","Thumb Error!!"); ?>
						</td>
					</tr>
					<tr>
						<td width="40%" valign="center"><font color="#000000">Video Title: <br>(Maximum Length is 20) </font></td>
						<td width="60%">
							<input name="title" type="text" id="title" value="<?php echo $movie_gallery_data['title'][$i]; ?>" maxlength="20"/>
						</td>
					</tr>
					<tr>
						<td valign="center"><font color="#000000">Configation:</font></td>
						<td >
							<select name="aspect_option" id="aspect_width" style="width:300px">
								<option value='0' <?php echo ($movie_gallery_data['aspect_option'][$i] == 0?"selected":""); ?>> Fill Screen</option>
								<option value='1' <?php echo ($movie_gallery_data['aspect_option'][$i] == 1?"selected":""); ?>> Keep Aspect Ratio</option>
							</select>
						</td>
					</tr>
					<!--<tr>
						<td valign="center"><font color="#000000">Aspect Width</font></td>
						<td>
							<select name="aspect_width" id="aspect_width" style="width:300px">
							<?php
							for ($x = 95;$x >= 5;$x=$x-5) {   ?>
								<option value='<?php echo $x;?>' <?php echo ($movie_gallery_data['aspect_width'][$i] == $x?"selected":""); ?>>
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
								<option value='<?php echo $x;?>' <?php echo ($movie_gallery_data['aspect_height'][$i] == $x?"selected":""); ?>>
								<?php echo $x;?>%</option>
							<?php } ?>
							</select>
						</td>
					</tr>-->
		<?php }  ?>
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
			<td align="right" valign="middle" colspan="1" height="50">&nbsp;</td>
			<td align="right" valign="middle" colspan="1" height="50">
				<table width="100%">
					<tr>
						<td width="50%" align="center"><input name="submit" type="submit" class="button" id="submit" value="Save" /></td>
						<td width="50%" align="center">
							<input name="id" type="hidden" value="<?echo $id;?>" />
							<input name="back" type="button" class="button" id="back" value="Cancel" onClick="location='main.php?page=control_main&cpage=control_movie_gallery_list'">		
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</form>
</table>
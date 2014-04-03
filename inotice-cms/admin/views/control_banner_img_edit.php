<script type="text/javascript">
	function show_img(val,picbox) {
		document.getElementById(picbox).src = 'images/'+val+'.png';
	}
</script>
<table>
	<tr>
		<?php show_msg($positive_msg, $error_msg, $tip_msg);?>
	</tr>
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
						<?php 
							$img = $config_data['folder']."/".$banner_image_data['image'][$i];
							output_image($img,500,0,"",""); 
							show_scissor($img,500,"banner_image",$banner_image_data['id'][$i],-1,"Error, Please check your image!");
						?>
					</td>
				</tr>
				<!--<tr>
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
				</tr>-->
				<tr height="50">
					<td valign="top"><font color="#000000">Transition</font></td>
					<td valign="top">
						<table border="0" width="100%">
						<tr>
							<td align="left" valign="top">
								<select name="transition" id="transition" style="width:200px" onchange="show_img(this.value,'picture');">
								<?php
								for ($x = 0;$x < sizeof($transition_flow_list);$x++) {  
									for ($y = 0;$y < sizeof($transition_direction_list) ;$y++) {
										$value = $transition_flow_list[$x]."_".$transition_direction_list[$y];  ?>
										<option value='<?php echo $value;?>' 
											<?php echo ($banner_image_data['transition_flow'][$i]."_".$banner_image_data['transition_direction'][$i] == $value?"selected":""); ?>>
										<?php echo properCase($transition_flow_list[$x])." (".properCase($transition_direction_list[$y]).") ";?></option>
									<?php } ?>
								<?php } ?>
								</select>							
							</td>
							<td width="40%" align="left" valign="top">
								<img id="picture" src="images/<?php echo $banner_image_data['transition_flow'][$i]."_".$banner_image_data['transition_direction'][$i].".png"; ?>" alt="" border="0" width="40"/>							
							</td>
						</tr>
						</table>
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
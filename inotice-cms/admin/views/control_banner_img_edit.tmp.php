<script type="text/javascript">
	function change_img(val,picbox,picbox2) {
		var val_array=val.split("_");
		document.getElementById(picbox).src = 'mws-admin/css/icons/16/arrow_'+val_array[0]+'.png';
		document.getElementById(picbox2).src = 'mws-admin/css/icons/16/arrow_'+val_array[1]+'.png';
	}
</script>
		<div class="mws-panel grid_6">
			<div class="mws-panel-header">
				<span class="mws-i-24 i-monitor">Cover Banner Image Config Edit</span>
			</div>
			<?php
				show_system_msg($positive_msg, $error_msg, $tip_msg);
				if (($banner_image_count) == 0) show_system_msg("", "No Image!!!!", "");
			?>
			<div class="mws-panel-body">
			<?php 
			if (($banner_image_count) > 0) {  ?>
				<?php for ($i = 0; $i <= ($banner_image_count - 1); $i++) { ?>
				<form class="mws-form" name="form1" method="post" action="" onSubmit="">
					<div class="mws-form-block">
						<div class="mws-form-row">
							<label>Image</label>
							<div id="mws-crop-parent" class="mws-form-item">
								<?php 
									$img = $config_data['folder']."/".$banner_image_data['image'][$i];
									output_image($img,500,0,"",""); 
								?>
							</div>
						</div>
						<div class="mws-form-row">
							<div class="mws-form-item">
								<ul class="mws-form-list inline">
									 <div class="mws-form-item large">
										Transition
										<table width="100%">
											<tr>
												<td width="70%">
													<select name="transition" id="transition" style="width:250px" onchange="change_img(this.value,'picture','picture2');">
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
												<td>
													<img id="picture2" src="mws-admin/css/icons/16/arrow_<?php echo $banner_image_data['transition_direction'][$i].".png"; ?>" border="0"/>&nbsp;&nbsp;
													<img id="picture" src="mws-admin/css/icons/16/arrow_<?php echo $banner_image_data['transition_flow'][$i].".png"; ?>" border="0"/>
												</td>
											</tr>
										</table>
									</div>
								</ul>
							</div>
						</div>
					</div>
					<div class="mws-button-row">
						<input name="submit" type="submit" class="mws-button green" id="submit" value="Save" />&nbsp;
						<input name="id" type="hidden" value="<?echo $id;?>" />
						<input name="back" type="button" class="mws-button gray" id="back" value="Cancel" onClick="location='main.php?page=control_banner_img_list'">
						<?php show_scissor($img,"banner_image",$banner_image_data['id'][$i],-1,"Error, Please check your image!","btn"); ?>						
					</div>
				</form>
			<?php } 
			}
			?>
			</div>
		</div>
<h3><a href="#" class="mws-i-24 i-month-calendar"><div style="margin-left : 2.5em;">Menu Icons (Min <?php echo $config_data['menu_icons']['best_resolution_text'];?>)</div></a></h3>
   <div>
	<?php if (($menu_icon_count) > 0) { ?>
		<div class="mws-form-inline">
			<div class="mws-form-row">
				<table width="100%">
					<tr>
					<?php for ($i = 0; $i <= ($menu_icon_count - 1); $i++) {  ?>												
						<td width="33%">
							<table width="100%">
								<tr>
									<td width="30%">
										<a href="main.php?page=setting_image_edit&subject=menu_icons&id=<?php echo $menu_icon_data['id'][$i]; ?>"><img src="mws-admin/css/icons/16/edit.png" width="20"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?php if (!($menu_icon_data['no_image'][$i])) {?>
											<a href="#" onclick="decision('Are you sure delete the Menu Icon No. <?php echo $menu_icon_data['id'][$i];?> ?','main.php?page=setting_main&subject=menu_icons&action=del&id=<?php echo $menu_icon_data['id'][$i]; ?>')">
												<img src="mws-admin/css/icons/32/cross.png" width="20">
											</a>
										<?php } ?>
									</td>
									<td>
										<?php 
										$img = $menu_icon_data['image'][$i];
										output_image($img,$config_data['menu_icons']['display_width'],0,"",""); 
										show_scissor($img,"menu_icons",$menu_icon_data['id'][$i],-1,"Error img!","img");
										?>
									</td>
								</tr>
								<tr>
									<td width="30%">&nbsp;</td>
									<td><?php echo $menu_icon_data['label'][$i]; ?>&nbsp;</td>
								</tr>
							</table>
						</td>
					  <?php
						if ((($i+1) % 3) == 0) echo "</tr> <tr>";
						} ?>
					</tr>
				</table>
			</div>
		</div>
		<?php
		}
		?>
	</div>
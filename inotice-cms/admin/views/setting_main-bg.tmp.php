	<h3><a href="#" class="mws-i-24 i-flatscreen"><div style="margin-left : 2.5em;">Logo & Background</div></a></h3>
	<div>
			<form class="mws-form" action="">
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<table width="100%" border="0" class="mws-datatable-fn mws-table">
							<tr>
								<td colspan="2">Company Logo &nbsp;&nbsp; (Min <?php echo $config_data['logo']['best_resolution_text'];?>)</td>
							</tr>
							<tr>
								<td width="30%">
									<a href="main.php?page=setting_image_edit&subject=logo"><img src="mws-admin/css/icons/16/edit.png" width="20"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<?php if (!($company_logo_image['no_image'][0])) {?>
									 <a href="#" onclick="decision('Are you sure delete the Company Logo?','main.php?page=setting_main&subject=logo&action=del')">
										<img src="mws-admin/css/icons/32/cross.png" width="20">
									 </a>
									<?php } ?>
								</td>
								<td>
									<?php 
										$img = $company_logo_image['image'][0];
										output_image($img,$config_data['logo']['display_width'],0,"","");  
									?>
								</td>
							</tr>
							<tr>
								<td colspan="2">Background &nbsp;&nbsp; (Min <?php echo $config_data['bg']['best_resolution_text'];?>)</td>
							</tr>
							<tr>
								<td width="30%">
									<a href="main.php?page=setting_image_edit&subject=bg"><img src="mws-admin/css/icons/16/edit.png" width="20"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<?php if (!($background_image['no_image'][0])) {?>
										 <a href="#" onclick="decision('Are you sure delete the Background?','main.php?page=setting_main&subject=bg&action=del')">
											<img src="mws-admin/css/icons/32/cross.png" width="20">
										 </a>
									<?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<?php
										$img = $background_image['image'][0];
										show_scissor($img,"bg",-1,-1,"Error img!","img"); 
									?>									
								</td>
								<td>
									<?php output_image($img,$config_data['bg']['display_width'],240,"",""); ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</form>
	</div>
<!--

<table width="100%">
	<tr align="center">
		<td>&nbsp;</td>
		<td width="120" style="background-color:#DDDDDD;color:white;">
			<font size="+1"><a href="main.php?page=control_main&cpage=control_gallery_edit">Add Album</a></font>
		</td>
	</tr>
</table>
</br>
-->

<!-- Panel -->
<div class="mws-panel grid_8">
	<!-- Panel Header -->
	<div class="mws-panel-header">
		<span class="ids-vince-non-block mws-i-24 i-image">Gallery Album Listing</span>
		<span class="ids-vince-right-header-span">Total Gallery Albums: <?php echo $gallery_album_count; ?></span>
	</div>
	<!-- End Panel Header -->
	
	<!-- Panel Body -->
	<div class="mws-panel-body">
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg); ?>
		
		<div class="mws-panel-toolbar top clearfix">
			<ul>
				<li><a href="main.php?page=control_gallery_edit" class="mws-ic-16 ic-add">Add Album</a></li>
			</ul>
		</div>	
		<form class="mws-form" method="post" action="" onSubmit="">
			<table class="mws-table">
				<?php 
				$disable_re_order_btn = ($gallery_album_count > 1)?(""):("disabled");
				if (($gallery_album_count) > 0)  {	 ?>
				<thead>
					<tr>
						<th width="15%">Cover</th>
						<th width="15%">Date</th>
						<th width="30%">Album</th>
						<th width="10%">No of Images</th>
						<th width="10%">&nbsp;</th>
						<th width="10%">&nbsp;</th>
					</tr>
				</thead>
				<tbody>			
						<?	for ($i = 0; $i <= ($gallery_album_count - 1); $i++) 
							{
								$gallery_album_photos_count = Count_gallery_photo($gallery_album_data['id'][$i], -1);  ?>
							<tr class="gradeC">
								<td>
									<a title="Edit" href="main.php?page=control_gallery_edit&aid=<?php echo $gallery_album_data['id'][$i]; ?>" >
										<?php output_image($config_data['folder']."/cover/".$gallery_album_data['cover'][$i],60,0,"","Cover Err!"); ?>
									</a>
								</td>
								<td style="vertical-align: middle"><?php echo $gallery_album_data['xdate_str'][$i]; ?></td>
								<td><?php echo $gallery_album_data['title'][$i]; ?></td>
								<td><?php echo $gallery_album_photos_count; ?></td>
								<td>
									<a title="Edit" href="main.php?page=control_gallery_edit&aid=<?php echo $gallery_album_data['id'][$i]; ?>" >
										<img src="mws-admin/css/icons/16/edit.png" width="20">
									</a>
								</td>
								<td class="center">
									<a href="#" onclick="decision('Are you sure delete [ <?php echo $gallery_album_data['title'][$i]; ?> ]? \n <?php echo ($gallery_album_photos_count >0 )?$gallery_album_photos_count." photo(s) in this album will be deleted!!!!":""; ?>','main.php?page=control_gallery_list&action=del&id=<?php echo $gallery_album_data['id'][$i]; ?>')">
										<img src="mws-admin/css/icons/32/cross.png" width="20" border="0" alt="Delete Album" />
									</a>
								</td>
							</tr>
						
						<?php 
							}
						}
						else 	
							{
								show_system_msg("", "", "No Gallery Album Found!!");
							}
						?>													
				</tbody>
			</table>
			<div class="mws-button-row">	
				<input class="mws-button green" onclick="location='main.php?page=control_gallery_sort'" type="button" value="Re-order Albums" <?php echo $disable_re_order_btn;?>/>
				<!-- Hidden field -->		
				<input name="subject" type="hidden" id="subject" value="gallery" />
				<!-- End hidden field -->
			</div>	
		</form>
	</div>  
	<!-- End Panel Body -->  
</div>
<!-- End Panel Container -->
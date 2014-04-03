	<div class="mws-panel grid_8">
		<div class="mws-panel-header">
			<span class="ids-vince-non-block mws-i-24 i-info-about">Album Photo Info</span>
			<span class="ids-vince-right-header-span">Album Name: <?php echo (($gallery_album_data['title'][0] != "")?($gallery_album_data['title'][0]):""); ?></span>
		</div>
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg); ?>
		<?php if (($gallery_photo_count) > 0) {  ?>
			<?php for ($i = 0; $i <= ($gallery_photo_count - 1); $i++) {  ?>
			<div class="mws-panel-body">
				<form class="mws-form" id="form1" method="post" action="" onSubmit="return validation(this)">
				 <div class="mws-form-inline">
					<div class="mws-form-row">
						<label>&nbsp;</label>
						<div class="mws-form-item" align="left">
							<?php output_image($config_data['folder']."/best/".$gallery_photo_data['image'][$i],0,0,"","Thumb Error!!"); ?>
						</div>
					</div>
					<div class="mws-form-row">
						<label>Set for Cover:</label>
						<div class="mws-form-item">
							<input type="checkbox" name="as_cover" id="as_cover" value="<?php echo $gallery_photo_data['id'][$i]; ?>" <?php echo ($gallery_photo_data['as_cover'][$i] == 1)?"checked":"";?>>
						</div>
					</div>						
					<div class="mws-form-row">
						<label>Title (Max 20 chars):</label>
						<div class="mws-form-item">
							<input name="title" type="text" id="title" value="<?php echo $gallery_photo_data['title'][$i];?>" maxlength="20" style="width:200px"/>
						</div>
					</div>							
					<div class="mws-form-row">
						<label>Description:</label>
						<div class="mws-form-item">
							<textarea name="description" id="description"><?php echo $gallery_photo_data['description'][$i];?></textarea>
						</div>
					</div>
					<div class="mws-button-row">
						<input name="submit" type="submit" class="mws-button green" id="submit" value="Save" style="width:100px"/>&nbsp;
						<input name="aid" type="hidden" value="<?echo $aid;?>" />
						<input name="id" type="hidden" value="<?echo $id;?>" />
						<input name="back" type="button" class="mws-button gray" id="back" value="Cancel" onClick="location='main.php?page=control_gallery_edit&aid=<?php echo $aid;?>'">	
					</div>
				  </div>
				</form>
			</div>
			<?php  }
			}
				else 
					{
						show_system_msg("", "", "No Image found!!!");
					}
			?>
	</div>
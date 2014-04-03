
<div class="mws-panel grid_5">
	<div class="mws-panel-header">
		<span class="mws-i-24 i-film-2">Movie Gallery Config Edit</span>
	</div>
	<div class="mws-panel-body">
		<?php
		require_once('1msg.tmp.php');
		if (($movie_gallery_count) == 0)  { 
			show_system_msg("", "", "No Video!!");
		} ?>
		<?php 
		if (($movie_gallery_count) > 0) {  ?>
		<?php for ($i = 0; $i <= ($movie_gallery_count - 1); $i++) {   ?>
		<form class="mws-form" name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
			<?php show_system_msg($positive_msg, $error_msg, $tip_msg);   ?>
			<!--<div class="mws-form-inline">-->
			<div class="mws-form-block">
				<div class="mws-form-row">
					<label>&nbsp;</label>
					<div id="mws-crop-parent" class="mws-form-item">
						<?php output_image($config_data['folder']."/thumb/".$movie_gallery_data['thumb'][$i],0,0,"","Thumb Error!!"); ?>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Video Title: (Maximum Length is 20)</label>
					<div id="mws-crop-parent" class="mws-form-item">
						<input class="mws-textinput" style="width:250px" name="title" type="text" id="title" value="<?php echo $movie_gallery_data['title'][$i]; ?>" maxlength="20"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Configation:</label>
					<div id="mws-crop-parent" class="mws-form-item">
						<select name="aspect_option" id="aspect_width" style="width:250px">
							<option value='0' <?php echo ($movie_gallery_data['aspect_option'][$i] == 0?"selected":""); ?>> Fill Screen</option>
							<option value='1' <?php echo ($movie_gallery_data['aspect_option'][$i] == 1?"selected":""); ?>> Keep Aspect Ratio</option>
						</select>
					</div>
				</div>							
			</div>
			<div class="mws-button-row">
				<!--Hidden field-->
				<input name="id" type="hidden" value="<?echo $id;?>" />
				<!--Hidden field ends-->
				<input name="submit" type="submit" class="mws-button green" id="submit" value="Save" />
				<input name="back" type="button" class="mws-button gray" id="back" value="Cancel" onClick="location='main.php?page=control_movie_gallery_list'">
			</div>
		</form>
	<?php }
		}
	?>
	</div>
</div>
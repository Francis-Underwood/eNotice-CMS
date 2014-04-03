<script language='javascript' type="text/javascript">
$(document).ready(
	function(){		
		//Sortable
		$( "#mws-gallery" ).sortable( {opacity: 0.65} );
		$( "#mws-gallery" ).disableSelection();
		
		//Send value to db
		$( "#ids-vince-save-order-btn" ).click(
		  function() {
			var $order = $( "#mws-gallery" ).sortable('toArray').toString();
			$( "#ids-vince-album-order-field" ).val($order);
			$( "#ids-vince-album-order-form" ).submit();
		  }
		);
	}
);
</script>

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span class="ids-vince-non-block mws-i-24 i-image">Image Gallery --> <?php echo $gallery_album_data['title'][0]; ?></span>
		<span class="ids-vince-right-header-span">Total Images: <?php echo $gallery_photo_count."&nbsp;"; ?></span>
	</div>
	<div class="mws-panel-body">
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg);?>
		<div class="mws-form-message status">
			<img src="mws-admin/css/icons/32/text_align_justity.png" width="20">&nbsp;Sorting Mode
		</div>
		<form class="mws-form" id="ids-vince-album-order-form" method="POST" action="scripts/order_handler.php">
			<?php if (($gallery_photo_count) > 0) {  ?>
				<ul id="mws-gallery" class="clearfix">
					<?php for ($i = 0; $i <= ($gallery_photo_count - 1); $i++) {  ?>
						<li id="<?php echo $gallery_photo_data['id'][$i]; ?>" style="width:100px; cursor:move;">
							<?php output_image($config_data['folder']."/thumb/".$gallery_photo_data['image'][$i],0,0,"","Thumb Error!"); ?>
						</li>
					<?php }	?>	
				</ul>
			<?php  }   
				//else  show_msg("", "No Image found!!!", "");
			?>
			<div class="mws-button-row">
				<input class="mws-button green" type="button" id="ids-vince-save-order-btn" value="Save" />	
				<input class="mws-button gray" onclick="location='main.php?page=control_gallery_edit&aid=<?php echo $aid; ?>'" type="button" value="Back" />
				<!-- Hidden field -->		
				<input name="subject" type="hidden" id="subject" value="gallery" />
				<input name="aid" type="hidden" id="aid" value=<?php echo $aid; ?> />
				<input name="custom-order" id="ids-vince-album-order-field" type="hidden" value=""/>
				<!-- End hidden field -->
			</div>	
		</form>		
	</div>
</div>
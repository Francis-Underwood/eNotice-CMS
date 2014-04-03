<script language='javascript' type="text/javascript">
$(document).ready(
	function(){		
		//Sortable
		$( "#ids-vince-album-order-form" ).disableSelection();		
		
		$( "#mws-gallery" ).sortable( {opacity: 0.65} );
		$( "#mws-gallery" ).disableSelection();
		
		//Send value to db
		$( "#ids-vince-save-order-btn" ).click(
		  function() {
			var $order = $( "#mws-gallery" ).sortable('toArray').toString();
			$( "#ids-vince-custom-order-field" ).val($order);
			$( "#ids-vince-custom-order-form" ).submit();
		  }
		);
	}
);
</script>

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span class="ids-vince-non-block mws-i-24 i-monitor">Banner Images</span>
		<span class="ids-vince-right-header-span">Total Banner Images: <?php echo $banner_image_count."&nbsp;"; ?></span>
	</div>
	<div class="mws-panel-body">
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg);?>
		<div class="mws-form-message status">
			<img src="mws-admin/css/icons/32/text_align_justity.png" width="20">&nbsp;Sorting Mode
		</div>
		<form class="mws-form" id="ids-vince-custom-order-form" method="POST" action="scripts/order_handler.php">
			<?php if (($banner_image_count) > 0) {  ?>
				<ul id="mws-gallery" class="clearfix">
					
					<?php for ($i = 0; $i <= ($banner_image_count - 1); $i++) {  ?>
						<li id="<?php echo $banner_image_data['id'][$i]; ?>" style="height:120px; cursor:move;">
							<div class="ids-wilson-width160">
								<?php output_image($config_data['folder']."/".$banner_image_data['image'][$i],120,0,"","Pls Crop Image Firstly!"); ?></br>
								<img src="mws-admin/css/icons/16/arrow_<?php echo $banner_image_data['transition_direction'][$i]; ?>.png">
								<img src="mws-admin/css/icons/16/arrow_<?php echo $banner_image_data['transition_flow'][$i]; ?>.png">
							</div>
						</li>
					<?php }	?>
					
				</ul>
			<?php  }   
				//else  show_msg("", "No Image found!!!", "");
			?>
			<div class="mws-button-row">
				<input class="mws-button green" type="button" id="ids-vince-save-order-btn" value="Save" />	
				<input class="mws-button gray" onclick="location='main.php?page=control_banner_img_list'" type="button" value="Back" />
				<!-- Hidden field -->		
				<input name="subject" type="hidden" id="subject" value="banner_image" />
				<input name="custom-order" id="ids-vince-custom-order-field" type="hidden" value=""/>
				<!-- End hidden field -->
			</div>	
		</form>		
	</div>
</div>
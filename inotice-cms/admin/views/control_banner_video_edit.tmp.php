<script type="text/javascript">
	function show_sliderbar_value(newValue,to)
	{ document.getElementById(to).innerHTML=newValue; }

	function disableField(obj, field1, field2) {
	   var Field1 = document.getElementById(field1);
	   var Field2 = document.getElementById(field2);
	   
	   if (obj.value == "2") {
		  //Field1.disabled = false;
		  //Field2.disabled = false;
		  Field1.style.display = 'block';
		  Field2.style.display = 'block';	
	   }
	   else {
		  //Field1.disabled = true;
		  //Field2.disabled = true;
		  Field1.style.display = 'none';
		  Field2.style.display = 'none';	  
	   }
	}
</script>

<div class="mws-panel grid_5">
	<div class="mws-panel-header">
		<span class="mws-i-24 i-monitor">Cover Banner Video Config Edit</span>
	</div>
	<div class="mws-panel-body">
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg); ?>
		<?php if (($banner_video_count) > 0) {  
				for ($i = 0; $i <= ($banner_video_count - 1); $i++) { 
				$disabled_aspect = ($banner_video_data['aspect_option'][$i] == 2)?(""):(" disabled "); ?>
				
				<form class="mws-form" name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
					<!--<div class="mws-form-inline">-->
					<div class="mws-form-block">
						<div class="mws-form-row">
							<label>&nbsp;</label>
							<div id="mws-crop-parent" class="mws-form-item">
								<?php output_image($config_data['folder']."/thumb/".$banner_video_data['thumb'][$i],0,0,"","Thumb Error, Please check your image!"); ?>
							</div>
						</div>
						<div class="mws-form-row">
							<label>Video Title: (Maximum Length is 20)</label>
							<div id="mws-crop-parent" class="mws-form-item">
								<input name="title" class="mws-textinput" type="text" value="<?php echo $banner_video_data['title'][$i]; ?>" maxlength="20" style="width:250px"/>
							</div>
						</div>
						<div class="mws-form-row">
							<label>Configation:</label>
							<div id="mws-crop-parent" class="mws-form-item">
								<select name="aspect_option" id="aspect_option" style="width:250px" onchange="disableField(this,'aspect_width','aspect_height')">
									<option value='0' <?php echo ($banner_video_data['aspect_option'][$i] == 0?"selected":""); ?>> Keep Aspect Ratio</option>						
									<option value='1' <?php echo ($banner_video_data['aspect_option'][$i] == 1?"selected":""); ?>> Fill Screen</option>
									<option value='2' <?php echo ($banner_video_data['aspect_option'][$i] == 2?"selected":""); ?>> Custom Size</option>
								</select>
							</div>
						</div>
						<script type="text/javascript">
							$(function() {
								 $(".mws-slider-aspect_width").slider(
									{	range: "min",
										step: 10,
										min: 50,
										max: <?php echo $banner_video_data['video_width'][$i]; ?>,
										value: <?php echo $banner_video_data['aspect_width'][$i]; ?>,
										slide: function($e, $ui)
										{	// console.log($ui.value);
											 $("input#ids-wilson-video-width").val($ui.value);	}		
									}
								);
								 $(".mws-slider-aspect_height").slider(
									{	range: "min",
										step: 10,
										min: 50,
										max: <?php echo $banner_video_data['video_height'][$i]; ?>,
										value: <?php echo $banner_video_data['aspect_height'][$i]; ?>,
										slide: function($e, $ui)
										{	// console.log($ui.value);
											 $("input#ids-wilson-video-height").val($ui.value);	}		
									}
								);
							 }	);
						</script>
						<?php if ($banner_video_data['aspect_option'][$i] == 2) {
								 $aspect_display = "block";
							  }
							  else {
								 $aspect_display = "none";
							  }
						?>						
							<div class="mws-form-row" id="aspect_width" style="display: <?php echo $aspect_display; ?>">
								 <label id="ids-wilson-video-width-label">Aspect Width</label>
								 <div class="mws-form-item large">
									<div class="mws-slider mws-slider-aspect_width" style="margin-bottom: 10px;"></div></br>
									<input class="mws-textinput" type="text" id="ids-wilson-video-width" name="aspect_width" value="<?php echo $banner_video_data['aspect_width'][$i]; ?>" readonly="1" style="width:80px"/>
								 </div>
							</div>		
							<div class="mws-form-row" id="aspect_height" style="display: <?php echo $aspect_display; ?>">
								 <label id="ids-wilson-video-height-label">Aspect Height</label>
								 <div class="mws-form-item large">
									<div class="mws-slider mws-slider-aspect_height" style="margin-bottom: 10px;"></div></br>
									<input class="mws-textinput" type="text" id="ids-wilson-video-height" name="aspect_height" value="<?php echo $banner_video_data['aspect_height'][$i]; ?>" readonly="1" style="width:80px"/>
								 </div>
							</div>
					</div>
					<div class="mws-button-row">
						<input name="submit" type="submit" class="mws-button green" id="submit" value="Save" />

						<input name="id" type="hidden" value="<?echo $id;?>" />		
						<input name="back" type="button" class="mws-button gray" id="back" value="Cancel" onClick="location='main.php?page=control_banner_video_list'">		
					</div>
				</form>
		<?php }  ?>
		<?php
		}
		else
			show_system_msg("", "", "No Video!!");
		?>
	</div>
</div>
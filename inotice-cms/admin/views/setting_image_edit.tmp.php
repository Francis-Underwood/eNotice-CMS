<!--Uploadify-->
<script type="text/javascript" src="uploadify3.2/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="uploadify3.2/uploadify.css">
<script type="text/javascript">
	$(function() {
		// Single 
		$('#file_upload').uploadify({
			'formData'     : {
				'token'     : '<?php echo md5('unique_salt' . time());?>',
				'folder'   : '<?php echo $config_data['folder'];?>',
				'subject'	: $("#subject").val(), 
				'image_id'	: $("#image_id").val()
			},
			'swf'      : 'uploadify3.2/uploadify.swf',
			'uploader' : 'scripts/upload_images.php?id=999',
			
			'queueSizeLimit' : <?php echo $config_data['queueSizeLimit'];?>,
			'fileTypeDesc' : '<?php echo $config_data['fileDesc'];?>',
			'fileTypeExts' : '<?php echo $config_data['fileExt'];?>',
			'fileSizeLimit' : '50MB',
			'buttonText' : 'Select Image', 
			'height' : 25,
			'multi'    : false,
			'auto'      : false,
			'removeCompleted' : false, 
			'removeTimeout'   : 20, 
			'onQueueComplete' : function(file) {
				//alert('The file ' + file.name + ' was successfully uploaded!!!!!');
				location.reload();
			}
		})
	});
</script>
<!--End of Uploadify-->

	<div class="mws-panel grid_6">
		<div class="mws-panel-header">
			<span class="mws-i-24 i-settings-1"><?php echo $config_data['page_title'];?></span>
		</div>
		<div class="mws-panel-body">
			<?php show_system_msg($positive_msg, $error_msg, $tip_msg);?>
			<?php show_system_msg("", $error_msg2, "");	?>
			<div class="mws-wizard clearfix">
				<ul>
					<li class="current">
						<a class="mws-ic-16 ic-picture">Image</a>
					</li>
					<li>
						<a class="mws-ic-16 ic-page-white-text">Configuration</a>
					</li>
				</ul>
			</div>
			
			<form class="mws-form" name="form_img" id="form_img" method="post" action="" enctype="multipart/form-data" onSubmit="">
			 <div class="mws-form-inline">
				<?php if (!($subject == "menu_icons_add")) {  ?>
					<div class="mws-form-row">
						<label>Original</label>
						<div class="mws-form-item" align="left">
							<?php 
								$img = $image_data['image'][0];
								output_image($img,$config_data['display_width'],0,"",""); 
							?>
						</div>
					</div>
				<?php } ?>
					<div class="mws-form-row">
						<label>Image...<br>(Min <?php echo $config_data['best_resolution_text'];?>)</label>
						<div class="mws-form-item" align="left">
							<input type="file" name="file_upload" id="file_upload"/>
						</div>
					</div>
				<div class="mws-button-row">
					<!-- Hidden field -->		
					<input name="subject" type="hidden" id="subject" value="<?php echo $subject; ?>" />
					<input name="image_id" type="hidden" id="image_id" value="<?php echo $id; ?>" />
					<!-- End hidden field -->
					<input class="mws-button green" onclick="$('#file_upload').uploadify('upload','*');" type="button" value="Upload" />
					<input type="button" value="Back" class="mws-button gray" onClick="location='<?php echo $up_page; ?>'"/>
					<?php show_scissor($img,$subject,$id,-1,"Upload Error!!","btn"); ?>
				</div>
			  </div>
			</form>
		</div>
	<?php if (($subject == "menu_icons") || ($subject == "menu_icons_add")) { ?>
			<div class="mws-wizard clearfix">
				<ul>
					<li>
						<a class="mws-ic-16 ic-picture">Image</a>
					</li>
					<li class="current">
						<a class="mws-ic-16 ic-page-white-text">Configuration</a>
					</li>
				</ul>
			</div>
			<form class="mws-form" name="form1" id="form1" method="post" action="" enctype="multipart/form-data" onSubmit="">
			 <div class="mws-form-inline">
					<div class="mws-form-row">
						<label>Label (Max 12 Chars)</label>
						<div class="mws-form-item">
							<input type="text" name="label" value="<?php echo $image_data['label'][0];?>" maxlength="12" style="width:200px"/>
						</div>
					</div>	
				<div class="mws-button-row">
					<input name="submit" type="submit" class="mws-button green" value="Save" />			
					<input name="subject" type="hidden" id="subject" value="<?php echo $subject; ?>" />
				</div>
			  </div>
			</form>
		</div>
	<?php } ?>	
	</div>
<script language='javascript' type="text/javascript">
	function validation(form1) {
		del_img_count = 0;
		
		//Check deleted_img checked
		//if (form1.elements["deleted_img[]"].checked !='undefined') {             <-- Some Error
			if (form1.elements["deleted_img"].checked == true) {
				del_img_count++;
			}			
		//} else  {
			for (x=0; x < form1.elements["deleted_img[]"].length; x++) {
				if (form1.elements["deleted_img[]"][x].checked==true) {
					del_img_count++;
				}
			}
		//}
		if (del_img_count>0) {
			if (!(confirm("Are you sure delete ticked imgae(s)?"))) {
				return false;
			}
		}
		
		return true;
	}
</script>

<!--Uploadify-->
<script type="text/javascript" src="uploadify3.2/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="uploadify3.2/uploadify.css">
<script type="text/javascript">
	$(function() {
		//Multi
		$('#file_upload').uploadify({
			'formData'     : {
				'token'     : '<?php echo md5('unique_salt' . time());?>',
				'folder'   	: '<?php echo $config_data['folder'];?>',
				'subject'	: $("#subject").val(), 
			},
			'swf'      : 'uploadify3.2/uploadify.swf',
			'uploader' : 'scripts/upload_images.php?id=999',
			'method'   : 'post',
			'queueSizeLimit' : <?php echo $config_data['queueSizeLimit'];?>,
			'fileTypeDesc' : '<?php echo $config_data['fileDesc'];?>',
			'fileTypeExts' : '<?php echo $config_data['fileExt'];?>',
			'fileSizeLimit' : '50MB',
			'buttonText' : 'Select Images', 
			'removeCompleted' : true, 
			'height' : 25,
			'multi'    : true,
			'auto'      : false,
			'onQueueComplete' : function(queueData,file) {
				alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
				location.reload();
			}
		})
	});
</script>
<!--End of Uploadify-->


<!-- Start Panel -->
<div class="mws-panel grid_8">
	<!-- Start Panel Header -->
	<div class="mws-panel-header">
		<span class="ids-vince-non-block mws-i-24 i-monitor">Cover Banner</span>
		<span class="ids-vince-right-header-span">Total Images: <?php echo $banner_image_count; ?></span>
	</div>
	<!-- End Panel Header -->

	<!-- Start Panel Body -->
	<div class="mws-panel-body">
		<form class="mws-form" name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
			<!-- Start Message -->
			<?php 
				show_system_msg($positive_msg, $error_msg, $tip_msg);
				show_system_msg("", $error_msg2, "");
			?>
			<!-- End Message -->
			
			<!-- Start Gallery Container -->
			<div class="clearfix">
				<?php 
					$disable_re_order_btn = ($banner_image_count <= 1)?("disabled"):("");
					if (($banner_image_count) > 0) 	{ 
						for ($i = 0; $i <= ($banner_image_count - 1); $i++) 	{
				?>
						<div class="ids-vince-gallery-item">
							<div class="ids-vince-img-wrapper">
								<a href="main.php?page=control_banner_img_edit&id=<?php echo $banner_image_data['id'][$i]; ?>">
									<?php 
										$img = $config_data['folder']."/".$banner_image_data['image'][$i];
										output_image($img,250,0,"",""); 
									?>
								</a>	
							</div>
							<div class="ids-vince-gallery-item-control">
								<a href="main.php?page=control_banner_img_edit&id=<?php echo $banner_image_data['id'][$i]; ?>">
									<img src="mws-admin/css/icons/16/arrow_<?php echo $banner_image_data['transition_direction'][$i]; ?>.png">
								</a>&nbsp;&nbsp;
								<a href="main.php?page=control_banner_img_edit&id=<?php echo $banner_image_data['id'][$i]; ?>">
									<img src="mws-admin/css/icons/16/arrow_<?php echo $banner_image_data['transition_flow'][$i]; ?>.png">
								</a>&nbsp;&nbsp;
								<?php show_scissor($img,"banner_image",$banner_image_data['id'][$i],-1,"Error, Please check your image!","img"); ?>							
								<span class="ids-vince-input-right">
									<!--Delete this image-->
									<input type="checkbox" name="deleted_img[]" id="deleted_img" value="<?php echo $banner_image_data['id'][$i]; ?>">
								</span>
							</div>
						</div>
				<?php
						}
					}
					else
						{
							show_system_msg("", "", "No Image for Banner!!"); 
						}
				?>
			</div>
			<!-- End Gallery Container  -->
			
			<div style="margin-left: 10px; margin-top:30px; margin-bottom: 20px;">
				<input type='file' name='file_upload' id='file_upload'/><label>Min <?php echo $config_data['best_resolution_text'];?></label>
			</div>
			
			<!-- Start Button Bar  -->
			<div class="mws-button-row">
				<input class="mws-button left green mws-i-24 i-cross large" type="submit" name="submit" value="Del Selected Images"/>
				<input class="mws-button green" onclick="$('#file_upload').uploadify('upload','*');" type="button" value="Upload" />
				<input class="mws-button green" onclick="location='main.php?page=control_banner_img_sort'" type="button" value="Re-order Images" <?php echo $disable_re_order_btn;?>/>
				<!-- Start Hidden Fields  -->
				<input name="subject" type="hidden" id="subject" value="banner_image" />
				<input name="image_id" type="hidden" id="image_id" value="0" />
				<!-- End Hidden Fields  -->				
			</div>
			<!-- End Button Bar  -->
		</form>
	</div>
	<!-- End Panel Body -->
	
</div>	<!-- End Panel -->
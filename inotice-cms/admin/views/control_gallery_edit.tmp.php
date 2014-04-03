<script language='javascript' type="text/javascript">
	function validation(form1) {
		title = document.form1.title.value;
		xdate = document.form1.xdate.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		del_img_count = 0;

		if (title.length == 0) {
			//err_msg = err_msg + "\n- [ Album Title ]";
		}		
		
		if (xdate == "") {
			//err_msg = err_msg + "\n- [ Album Date ]";
		}
		
		if (err_msg.length > 34) {
			alert(err_msg);
			return false;
		}
		
		//check deleted_img checked
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
<!-- fancyBox -->
<script type="text/javascript" src="mws-admin/plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="mws-admin/plugins/fancybox/jquery.easing-1.4.pack.js"></script>
<link rel="stylesheet" href="mws-admin/plugins/fancybox/jquery.fancybox-1.3.4.css" type="text/css" />
<script>
	$(document).ready(
		function(){	$("a.fancy").fancybox();}
	);
</script>
<!-- End of fancy Box -->


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
				'aid'		: $("#aid").val(), 
				'image_id'	: $("#image_id").val()
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


<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span class="ids-vince-non-block mws-i-24 i-image">Image Gallery --> <?php echo (($mode) == "edit")?$gallery_album_data['title'][0]:"{untitled}"; ?></span>
		<span class="ids-vince-right-header-span"><?php echo (($mode) == "edit")?"Total Images: ".$gallery_photo_count:"&nbsp;"; ?></span>
	</div>

	<div class="mws-panel-body">
		<div class="mws-form-message status">
			<img src="mws-admin/css/icons/16/edit.png" width="20">&nbsp;<?php echo $subtitle; ?>
		</div>
		<!-- Album Form Block -->
			<!--Album Information-->
			<div class="mws-wizard clearfix">
				<ul>
					<li class="current">
						<a class="mws-ic-16 ic-page-white-text">Album Info.</a>
					</li>
					<li>
						<a class="mws-ic-16 ic-picture">Images</a>
					</li>
				</ul>
			</div>
			<?php show_system_msg($positive_msg, $error_msg, $tip_msg); ?>
			<form id="mws-validate" class="mws-form" name="form1" method="post" action="" onSubmit="return validation(this)">
				<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
				<div class="mws-form-inline" style="margin-bottom: 0px;">
					<div class="mws-form-row">
						<label>Album Title </br>(Max: 20 Chars)</label>
						<div class="mws-form-item small">
							<input type="text" name="title" class="mws-textinput required" value="<?php echo $gallery_album_data['title'][0];?>" maxlength="20" style="width:200px"/>
						</div>
					</div>
					<div class="mws-form-row">
						<label>Album Date</label>
						<div class="mws-form-item">
							<input type="text" name="xdate" class="mws-textinput mws-datepicker-wk required" value="<?php echo ($mode == "edit")?$gallery_album_data['xdate_str'][0]:(date("Y-m-d"));?>" style="width:200px" readonly="1"/>
						</div>
					</div>
				</div>
				<div class="mws-button-row">				
					<!--Hiddle field-->
					<input name="subject" type="hidden" id="subject" value="gallery" />
					<input name="aid" type="hidden" id="aid" value=<?php echo $aid; ?> />		
					<!--Hiddle field ends-->
					<input name="submit" id="submit" type="submit" class="mws-button green" value="Save" />	
					<input name="back" type="button" class="mws-tooltip-s mws-button gray" value="Back" onClick="location='<?php echo $up_page;?>'">
				</div>						
			</form>
			<?php 	
			//Edit album mode
			if (($mode) == "edit") {  ?>			
				<!--Upload Images-->
				<div class="mws-wizard clearfix">
					<ul>
						<li>
							<a class="mws-ic-16 ic-page-white-text">Album Info.</a>
						</li>
						<li class="current">
							<a class="mws-ic-16 ic-picture">Images</a>
						</li>
					</ul>
				</div>
				<?php 
					show_system_msg("", $error_msg2, "");
				?>
				<form class="mws-form" name="form_img" id="form_img" method="post" action="" onSubmit="return validation(this)">
					<?php 
						$disable_re_order_btn = ($gallery_photo_count > 1)?(""):("disabled");
						 if (($gallery_photo_count) > 0)  {  	 ?>
						<ul id="mws-gallery" class="clearfix">
							<?php 		
							  for ($i = 0; $i <= ($gallery_photo_count - 1); $i++) {    ?>
								<li style="width:100px;">
									<?php output_image($config_data['folder']."/thumb/".$gallery_photo_data['image'][$i],0,0,"","Thumb Error!"); ?>
									<div class="mws-gallery-overlay">
										<div class="ids-vince-action-bar">
											<!--Zoom the Image-->
											<a href="<?php echo $config_data['folder']."/".$gallery_photo_data['image'][$i]; ?>" class="fancy">
												<span class="ids-vince-action-bar-button">
													<img src="mws-admin/css/icons/24/magnifying-glass.png"/>
												</span>
											</a>
											<!--End of Zoom the Image-->
											<!--Edit the Image-->
											<a href="main.php?page=control_gallery_img_edit&aid=<?php echo $aid; ?>&id=<?php echo $gallery_photo_data['id'][$i]; ?>" class="">
												<span class="ids-vince-action-bar-button">
													<img src="mws-admin/css/icons/24/pencil-edit.png"/>
												</span>
											</a>
											<!--End of Edit the Image-->
											<!--Del the Image-->
											<a href="#" class="" onclick="decision('Are you sure delete this image??','main.php?page=control_gallery_edit&action=del&aid=<?php echo $aid; ?>&id=<?php echo $gallery_photo_data['id'][$i]; ?>')" >
												<span class="ids-vince-action-bar-button">
													<img src="mws-admin/css/icons/24/minus.png"/>
												</span>
											</a>
											<!--End of Del the Image-->
										</div>
									</div>
								</li>
							<?php }	?>	
						</ul>
					<?php  }   
						//else  show_msg("", "No Image found!!!", "");
					?>
					<div style="margin-left: 5px;margin-top: 15px;margin-bottom: 15px;">
						<input type='file' name='file_upload' id='file_upload'/><span><?php echo $config_data['best_resolution_text'];?></span>
					</div>
					<div class="mws-button-row">
						<input class="mws-button green" onclick="$('#file_upload').uploadify('upload','*');" type="button" value="Upload" />	
						<input class="mws-button green" onclick="location='main.php?page=control_gallery_img_sort&aid=<?php echo $aid; ?>'" type="button" value="Re-order Images" <?php echo $disable_re_order_btn;?>/>
						<!-- Hidden field -->		
						<input name="subject" type="hidden" id="subject" value="gallery" />
						<input name="image_id" type="hidden" id="image_id" value="<?php echo $id; ?>" />
						<input name="aid" type="hidden" id="aid" value=<?php echo $aid; ?> />	
						<!-- End hidden field -->
					</div>	
				</form>							
			<?php } ?>
			<!-- End Album Form Block -->
	</div>
</div>
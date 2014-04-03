<script language='javascript' type="text/javascript">
	function validation(form1) {
		title = document.form1.title.value;
		xdate = document.form1.xdate.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		del_img_count = 0;

		if (title.length == 0) {
			err_msg = err_msg + "\n- [ Album Title ]";
		}		
		
		if (xdate == "") {
			err_msg = err_msg + "\n- [ Album Date ]";
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

<!--include uploadify files-->
<script type="text/javascript" src="upload-files-jbp/uploadify/jquery-1.4.2.min.js"></script>
<link href="upload-files-jbp/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="upload-files-jbp/jquery.validate.js"></script> 
<script type="text/javascript" src="upload-files-jbp/uploadify/swfobject.js"></script>
<script type="text/javascript" src="upload-files-jbp/uploadify/jquery.uploadify.v2.1.4.js"></script>
<!--End of include uploadify files-->

<script type="text/javascript">
	$(document).ready(function() {
		//uploadify
		  $('#file_upload').uploadify({
			'scriptData': {'subject': $("#subject").val(), 'aid': $("#aid").val()},
			'uploader'  : 'upload-files-jbp/uploadify/uploadify.swf',
			'script'    : 'scripts/upload_images.php?id=' + $("#eid").val(), //script to upload our images
			'cancelImg' : 'upload-files-jbp/uploadify/cancel.png',
			'buttonImg' : 'upload-files-jbp/uploadify/upload.png',
			'folder'    : '<?php echo $config_data['folder'];?>',
  			'queueSizeLimit' : <?php echo $config_data['queueSizeLimit'];?>,
			'fileExt'     : '<?php echo $config_data['fileExt'];?>', //only upload these file types
			'fileDesc'    : '<?php echo $config_data['fileDesc'];?>',
			'multi'    : true,
			'auto'      : false,
			'sizeLimit'   : 51024000,  //50 MB
	
			//update hidden field to indicate a file has been selected
			'onSelect': function(event,ID,fileObj) {
				$("#selected").val('Yes');
			},
			//

			//submit form ONLY after all files have been uploaded.
			'onAllComplete' : function(event,data) {
				$(".submit").focus().click();
			}
			//

		  });
		/////

		//function to use when submitting the form
		function validate_form() {
			$("#form1").validate({
				submitHandler: function() {
		
					//if a file has been selected
						if ($("#selected").val() == 'Yes') {
							$("#file_upload").uploadifyUpload();
						}
				
					//if a file hasn't been selected
						if ($("#selected").val() == 'No') {
							$(form).submit();
						}
					//
				}
		
			});    
		}
		//

		/*in case user tries submitting the form by hitting enter
		$('input').keypress(function(e) {
			if(e.which == 13) {
				$(this).blur();
				validate_form();
			}
		});
		//     */

		//validate, then submit the form
		$(".submit").click(function() {
			validate_form();
		});  

	});  
</script>

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span class="ids-vince-non-block mws-i-24 i-monitor">Image Gallery --> Hong Kong Album</span>
		<span class="ids-vince-right-header-span"><?php echo (($mode) == "edit")?"Total Images: ".$gallery_photo_count:"&nbsp;"; ?></span>
	</div>

	<div class="mws-panel-body">
	
		<div class="mws-form-message status">
			<img src="mws-admin/css/icons/16/edit.png" width="20">&nbsp;Editing Mode
		</div>
		
		<div class="mws-panel-content">
			<!-- Album Form Block -->
			<form class="mws-form" name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
				<?php show_msg($positive_msg, $error_msg, $tip_msg);?>
				
				<div class="mws-form-block" style="margin-bottom: 80px;">
					<div class="mws-form-row">
						<label>Album Title (Max: 20 Chars)</label>
						<div class="mws-form-item small">
							<input type="text" class="mws-textinput" maxlength="20" style="width:200px" value="<?php echo $gallery_album_data['title'][0];?>"/>
						</div>
					</div>
					<div class="mws-form-row">
						<label>Album Date</label>
						<div class="mws-form-item">
							<input type="text" class="mws-textinput mws-datepicker-wk" value="<?php echo ($mode == "edit")?$gallery_album_data['xdate_str'][0]:(date("Y-m-d"));?>" style="width:200px" readonly="1"/>
						</div>
					</div>
				</div>
				
				
				<?php 
					//Edit album mode
					if (($mode) == "edit") 
					{ 
						if (($gallery_photo_count) > 0) 
						{
				?>	

				<ul id="mws-gallery" class="clearfix">
				<?php 		
					for ($i = 0; $i <= ($gallery_photo_count - 1); $i++) 
					{
				?>
					<li>
						<?php output_image($config_data['folder']."/thumb/".$gallery_photo_data['image'][$i],0,0,"","Thumb Error!"); ?>
						<div class="mws-gallery-overlay">
							<div class="ids-vince-action-bar">
								<a href="../../images/gallery/thumb/20120905_0cedb9992204ff5.jpg" class="fancy">
									<span class="ids-vince-action-bar-button">
										<img src="mws-admin/css/icons/24/magnifying-glass.png"/>
									</span>
								</a>
								<a href="control_gallery_img_edit.tmp.php" class="">
									<span class="ids-vince-action-bar-button">
										<img src="mws-admin/css/icons/24/pencil-edit.png"/>
									</span>
								</a>
								<a href="control_gallery_img_efgtert.tmp.php" class="">
									<span class="ids-vince-action-bar-button">
										<img src="mws-admin/css/icons/24/minus.png"/>
									</span>
								</a>											
							</div>
						</div>
					</li>
				
				<?php 
							}

				?>	
				</ul>
				<?php  }   ?>
				<div style="margin-bottom: 20px;">
					<input type='file' name='file_upload' id='file_upload'/>
					<span><?php echo $config_data['best_resolution_text'];?></span>
				</div>
		
				<?php   }   ?>
				<div class="mws-button-row">
					<input name="submit" type="submit" value="Save" class="mws-button green submit_button submit" style="width:100px"/>
					<input type="button" class="mws-tooltip-s mws-button gray" value="Back" title="Back to List"  style="width:100px"/>
				</div>					
			</form>		
			<!-- End Album Form Block -->
		</div>
		
	</div>
</div>
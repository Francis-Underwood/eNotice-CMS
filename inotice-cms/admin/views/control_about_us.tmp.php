<script language='javascript' type="text/javascript">
	function validation(form1) {
		//about_us_desc = document.form1.about_us_desc.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		del_img_count = 0;
		
		//if (about_us_desc == "") {
			//err_msg = err_msg + "\n- [ Description Text ]";
		//}
		
		//Check deleted_img checked
		if (form1.elements["deleted_img"].checked == true) {
			del_img_count++;
		}
		if (del_img_count>0) {
			if (!(confirm("Are you sure delete ticked imgae(s)?"))) {
				return false;
			}
		}
		
		if (err_msg.length > 34) {
			alert(err_msg);
			return false;
		}
		return true;
	}
</script>

<!--FCKeditor-->
<script type="text/javascript">

window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = 'fckeditor/';

	var oFCKeditor = new FCKeditor( 'about_us_desc' ) ;
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ToolbarSet	= 'Basic' ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '200' ;
	oFCKeditor.ReplaceTextarea() ;

	oFCKeditor.FCKConfig.StartupFocus = true ;
	//Return the focus to the first textbox
	//document.forms[0].about_us_desc.focus();
	//idsquare.wilson.setFocus();		
}

</script>
<!-- / FCKeditor-->

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

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span class="mws-i-24 i-info-about">About Us</span>
	</div>
	<div class="mws-panel-body">
		<div class="mws-wizard clearfix">
			<ul>
				<li class="current"><a class="mws-ic-16 ic-picture">Image</a></li>
				<li><a class="mws-ic-16 ic-page-white-text">Content</a></li>
			</ul>
		</div>
		<?php show_system_msg("", $error_msg2, ""); ?>
		<form class="mws-form" name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
			<?php
			$about_us_img_count = Count_images("about_us",-1,0);
			$about_us_img_data = Select_images("about_us",-1,0);
			
			if (($about_us_img_count) > 0) { ?>
				<?php for ($i = 0; $i <= ($about_us_img_count - 1); $i++) { ?>
					<div class="mws-form-row">
						<label>&nbsp;</label>
						<div class="mws-form-item">
							<table width="100%">
								<tr>
									<td width="60%">
									<?php 
										$img = $about_us_img_data['image'][$i];
										output_image($img,400,0,"",""); 
									?>
									</td>
									<td> 
										<?php if (!($about_us_img_data['no_image'][$i])) {  ?>
												 <a href="#" onclick="decision('Are you sure delete the About Us Image?','main.php?page=control_about_us&action=del&id=<?php echo $about_us_img_data['id'][$i]; ?>')">
													<img src="mws-admin/css/icons/32/cross.png" width="20">
												 </a>
										<?php } else { ?>
											&nbsp;
										<?php } ?>									
									</td>
								</tr>
							</table>
						</div>
					</div>
				<?php }
			}
			?>	
			<div class="mws-form-row">
				<label>Change Image (Min: <?php echo $config_data['best_resolution_text'];?>): </label>
				<div class="mws-form-item" align="left">
					<input type='file' name='file_upload' id='file_upload'/>
				</div>
			</div>

			<div class="mws-button-row">				
				<!-- Hidden field -->		
				<input name="subject" type="hidden" id="subject" value="about_us" />
				<input name="image_id" type="hidden" id="image_id" value="0" />
				<!-- End hidden field -->
				<input class="mws-button green" onclick="$('#file_upload').uploadify('upload','*');" type="button" value="Upload" />
				<?php show_scissor($img,"about_us",$about_us_img_data['id'][$i],-1,"Error for read the image!","btn");  ?>
			</div>
		</form>
	</div>
	<div class="mws-panel-body">
		<div class="mws-wizard clearfix">
			<ul>
				<li>
					<a class="mws-ic-16 ic-picture">Image</a>
				</li>
				<li class="current">
					<a class="mws-ic-16 ic-page-white-text">Content</a>
				</li>
			</ul>
		</div>
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg); ?>
		<form class="mws-form" name="form2" id="form2" method="post" action="" onSubmit="return validation(this)">
			<div class="mws-form-row">
				<label>Description Text:</label>
				<div class="mws-form-item">
					<textarea id="about_us_desc" name="about_us_desc" rows="18" cols="45" style="width:400px"><?php echo $about_us_data['about_us_desc'];?></textarea>
				</div>
			</div>
			<div class="mws-button-row">
				<input name="submit" type="submit" class="mws-button green submit_button submit" id="submit" value="Save" />	
			</div>
		</form>
	</div>
</div>
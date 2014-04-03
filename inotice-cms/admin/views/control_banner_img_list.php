<table>
	<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?>  </tr>
	<tr><?php show_msg("", $error_msg2, "");?>  </tr>
</table>
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
<script type="text/javascript">
	$(document).ready(function() {
		//uploadify
		  $('#file_upload').uploadify({
			'scriptData': {'subject': $("#subject").val()},
			'uploader'  : 'upload-files-jbp/uploadify/uploadify.swf',
			'script'    : 'upload_images.php?id=' + $("#eid").val(), //script to upload our images
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


<table id="table-4" width="100%">
	<div align="right"><strong>Total Images: <?php echo $banner_image_count; ?>&nbsp;</strong></div>
	<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
		<!--<thead>
			<th width="280">&nbsp;</th>
			<th width="280"><div align="right"></div></th>
		</thead>-->
		<?php 
		if (($banner_image_count) > 0) {  ?>
		<tr>	
		<?php for ($i = 0; $i <= ($banner_image_count - 1); $i++) { ?>
			<td valign="center">
				<table width="100%">
					<tr>
						<td colspan="2">
							<a href="main.php?page=control_main&cpage=control_banner_img_edit&id=<?php echo $banner_image_data['id'][$i]; ?>">
								<?php 
									$img = $config_data['folder']."/".$banner_image_data['image'][$i];
									output_image($img,250,0,"",""); 
									show_scissor($img,250,"banner_image",$banner_image_data['id'][$i],-1,"Error, Please check your image!"); 
								?>
							</a>
						</td>
					</tr>
					<tr>
						<td width="33%" valign="top">
							<a href="main.php?page=control_main&cpage=control_banner_img_edit&id=<?php echo $banner_image_data['id'][$i]; ?>">
								<img src="images/<?php echo $banner_image_data['transition_flow'][$i]."_".$banner_image_data['transition_direction'][$i].".png"; ?>" alt="" border="0" width="40">
							</a>
						</td>
						<td width="67%" align="right">
							<label for=""><input type="checkbox" name="deleted_img[]" id="deleted_img" value="<?php echo $banner_image_data['id'][$i]; ?>">Del this image</label>
						</td>
					</tr>
				</table>
			</td>
			<?php if (($i+1) % 2 == 0) {?>
				</tr> <tr>
			<? }  ?>
		<?php }  ?>
		</tr>
		<?php
		}
		else
		{ ?>
		<tr>
			<td valign="center" colspan="2"><font color="RED">No Image for Banner!!!!</font></td>
		</tr>
		<?php }
		?>
		<tr>
			<td align="left" valign="middle" colspan="2" height="60">
				<input type='file' name='file_upload' id='file_upload'/>Min <?php echo $config_data['best_resolution_text'];?>
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle" colspan="2" height="50">
				<input name="submit" type="submit" class="button submit_button submit" id="submit" value="Save" />	
						
				<input name="subject" type="hidden" id="subject" value="banner_image" />
				<input name="selected" type="hidden" id="selected" value="No" />
				<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
				<input name="image_id" type="hidden" id="image_id" value="0" />
			</td>
		</tr>
	</form>
</table>
<br><br><br>
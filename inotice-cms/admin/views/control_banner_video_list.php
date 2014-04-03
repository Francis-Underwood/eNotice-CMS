<table>
	<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?>  </tr>
	<tr><?php show_msg("", $error_msg2, "");?>  </tr>
</table>
<script language='javascript' type="text/javascript">
	function validation(form1) {
		del_video_count = 0;
		
		//Check deleted_video checked
		//if (form1.elements["deleted_video[]"].checked !='undefined') {             <-- Some Error
			if (form1.elements["deleted_video"].checked == true) {
				del_video_count++;
			}			
		//} else  {
			for (x=0; x < form1.elements["deleted_video[]"].length; x++) {
				if (form1.elements["deleted_video[]"][x].checked==true) {
					del_video_count++;
				}
			}
		//}
		
		//alert(del_video_count);
		if (del_video_count>0) {
			if (!(confirm("Are you sure delete ticked video(s)?"))) {
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
			'script'    : 'upload_videos.php?id=' + $("#eid").val(), //script to upload our images
			'cancelImg' : 'upload-files-jbp/uploadify/cancel.png',
			'buttonImg' : 'upload-files-jbp/uploadify/button.jpg',
			'folder'    : '<?php echo $config_data['folder'];?>',
  			'queueSizeLimit' : <?php echo $config_data['queueSizeLimit'];?>,
			'fileExt'     : '<?php echo $config_data['fileExt'];?>', //only upload these file types
			'fileDesc'    : '<?php echo $config_data['fileDesc'];?>',
			'multi'    : true,
			'auto'      : false,
			'sizeLimit'   : <?php echo $sizeLimit_mb;?>,
	
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
<div align="right"><strong>Total Videos: <?php echo $banner_video_count; ?>&nbsp;</strong></div>
<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<thead>
		<th width="30">Item</th>
		<th width="380">Video File</th>
		<th width="80">Preview</th>
		<th width="50">Delete</th>
		<th width="50">Edit</th>
	</thead>
	<?php 
	if (($banner_video_count) > 0) {  ?>	
	<?php for ($i = 0; $i <= ($banner_video_count - 1); $i++) {?>
	<tr height="50">
		<td><font color="#000000"><?php echo $i+1; ?></font></td>
		<td>
			<?php file_download_link($config_data['folder']."/".$banner_video_data['link'][$i],$banner_video_data['title'][$i],"Download Video","Video Broken"); ?>
		</td>
		<td>
			<a title="Edit" href="main.php?page=control_main&cpage=control_banner_video_edit&id=<?php echo $banner_video_data['id'][$i]; ?>">
				<?php output_image($config_data['folder']."/thumb/".$banner_video_data['thumb'][$i],60,0,"","No Image"); ?>
			</a>
		</td>
		<td align="center">
			<label for=""><input type="checkbox" name="deleted_video[]" id="deleted_video" value="<?php echo $banner_video_data['id'][$i]; ?>"></label>
		</td>
		<td align="center">
			<a href="main.php?page=control_main&cpage=control_banner_video_edit&id=<?php echo $banner_video_data['id'][$i]; ?>"><img src="images/icons/edit.png"></a>
		</td>
	</tr>
	<?php }  ?>
	<?php
	}
	else
	{ ?>
	<tr>
		<td valign="center" colspan="5"><font color="RED">No Video for Banner!!!!</font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="left" valign="middle" colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="middle" colspan="5">Add more videos...</td>
	</tr>
	<tr>
		<td align="left" valign="middle" colspan="5"><input type='file' name='file_upload' id='file_upload'/></td>
	</tr>
	<tr>
		<td align="right" valign="middle" colspan="5" height="50">
			<input name="submit" type="submit" class="button submit_button submit" id="submit" value="Save" />	
					
			<input name="subject" type="hidden" id="subject" value="banner_video" />
			<input name="selected" type="hidden" id="selected" value="No" />
			<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
			<input name="image_id" type="hidden" id="image_id" value="0" />
		</td>
	</tr>
</form>
</table>
<br><br><br>
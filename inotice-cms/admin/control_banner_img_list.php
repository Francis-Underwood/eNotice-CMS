<table>
<?php
	$config_data = upload_file_config("banner_image",-1);
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	$data['deleted_img'] = $_POST['deleted_img'];
	  if (del_banner_images($data)) {
	  ?>
		<!--<td><font color="blue">Saved</font></td>-->
	  <?php
	  }  else  {
	  ?>
		<!--<td><font color="red"><strong>Saved failed!!!</strong></font></td>-->
	  <?php  }
	} 
	else Save_err_msg("");
	
	echo "<td><font color=\"red\"><strong>".Select_err_msg()."</strong></font></td>";
	
	$banner_image_count = Count_banner_image(-1);
	$banner_image_data = Select_banner_image(-1);
?>
</table>

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
	<?php for ($i = 0; $i <= ($banner_image_count - 1); $i++) {?>
		<td valign="center">
			<table width="100%">
				<tr>
					<td colspan="2">
						<a href="main.php?page=control_main&cpage=control_banner_img_edit&id=<?php echo $banner_image_data['id'][$i]; ?>">
							<?php output_image($config_data['folder']."/".$banner_image_data['image'][$i],$config_data['thumb_max_width'],0,"","Upload Error, Please check your image!"); ?>
						</a>
					</td>
				</tr>
				<tr>
					<td width="33%" valign="center"><font color="#000000">Item</font></td>
					<td width="67%"><font color="#000000"><?php echo $banner_image_data['id'][$i]; ?></font></td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Flow</font></td>
					<td><font color="#000000"><?php echo properCase($banner_image_data['transition_flow'][$i]); ?></font></td>
				</tr>
				<tr>
					<td valign="center"><font color="#000000">Direction</font></td>
					<td><font color="#000000"><?php echo properCase($banner_image_data['transition_direction'][$i]); ?></font></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td align="right">
						<label for=""><input type="checkbox" name="deleted_img[]" id="deleted_img" value="<?php echo $banner_image_data['id'][$i]; ?>">Delete this image</label>
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
			<input type='file' name='file_upload' id='file_upload'/>Best <?php echo $config_data['best_resolution_text'];?>
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
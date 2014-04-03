<?php
	$config_data = upload_file_config("movie_gallery",-1);
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	$data['deleted_video'] = $_POST['deleted_video'];
	
	if (del_movie_gallery($data)) {
	?>
		<!--<td><font color="blue">Saved</font></td>-->
	<?php
	}  else  {
	?>
		<!--<td><font color="red"><strong>Saved failed!!!</strong></font></td>-->
	<?php  }
	
	}
	
	$movie_gallery_count = Count_movie_gallery(-1);
	$movie_gallery_data = Select_movie_gallery(-1);
?>

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
<table width="100%">
	<tr align="center">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
</br>
<div align="right"><strong>Total Gallery Videos: <?php echo $movie_gallery_count; ?>&nbsp;</strong></div>
<table id="table-4" width="100%">
<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<thead>
		<th width="30">Item</th>
		<th width="380">Video File</th>
		<th width="80">Preview</th>
		<th width="50">Delete</th>
		<th width="50">Edit</th>
	</thead>
	<?php 
	if (($movie_gallery_count) > 0) {  ?>
	<?php for ($i = 0; $i <= ($movie_gallery_count - 1); $i++) {?>
	<tr>
		<td><font color="#000000"><?php echo $movie_gallery_count-$i; ?></font></td>
		<td>
			<a title="Download Video" href="<?php echo $config_data['folder']."/".$movie_gallery_data['link'][$i]; ?>"><?php echo $movie_gallery_data['title'][$i]; ?></a>
		</td>
		<td><?php output_image($config_data['folder']."/thumb/".$movie_gallery_data['thumb'][$i],60,0,"","Thumb Error!!"); ?></td>
		<td align="center">
			<label for=""><input type="checkbox" name="deleted_video[]" id="deleted_video" value="<?php echo $movie_gallery_data['id'][$i]; ?>"></label>
		</td>
		<td align="center">
			<a href="main.php?page=control_main&cpage=control_movie_gallery_edit&id=<?php echo $movie_gallery_data['id'][$i]; ?>"><img src="images/icons/edit.png"></a>
		</td>
	</tr>
	<?php }  ?>
	<?php
	}
	else
	{ ?>
	<tr>
		<td valign="center" colspan="5"><font color="RED">No Gallery Video found!!!!</font></td>
	</tr>
	<?php }
	?>
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
					
			<input name="subject" type="hidden" id="subject" value="movie_gallery" />
			<input name="selected" type="hidden" id="selected" value="No" />
			<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
			<input name="image_id" type="hidden" id="image_id" value="0" />
		</td>
	</tr>
</form>
</table>
<br><br><br>
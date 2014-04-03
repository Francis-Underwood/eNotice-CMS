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
	oFCKeditor.Height = '300' ;
	oFCKeditor.ReplaceTextarea() ;

	oFCKeditor.FCKConfig.StartupFocus	= false ;
	//Return the focus to the first textbox
	//document.forms[0].about_us_desc.focus();
	setFocus();		
}

</script>
<!-- / FCKeditor-->

<script type="text/javascript">
	$(document).ready(function() {
		//uploadify
		  $('#file_upload').uploadify({
			'scriptData': {'subject': $("#subject").val(), 'image_id': $("#image_id").val()},
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

<table width="500">
	<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?>  </tr>
	<tr><?php show_msg("", $error_msg2, "");?>  </tr>
</table>
<table width="550">
  <form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<?php
		$about_us_img_count = Count_images("about_us",-1,0);
		$about_us_img_data = Select_images("about_us",-1,0);
		
	if (($about_us_img_count) > 0) { ?>
	 <?php for ($i = 0; $i <= ($about_us_img_count - 1); $i++) { ?>
	 <tr align="left" valign="top">
	  <td>&nbsp;</td>	 
	  <td>
		<table width="100%">
			<tr>
				<td>
				<?php 
					$img = $about_us_img_data['image'][$i];
					output_image($img,400,0,"",""); 
					show_scissor($img,400,"about_us",$about_us_img_data['id'][$i],-1,"Error for read the image!"); 
				?>
				</td>
			</tr>
			<tr>
				<td align="right">
					<?php if (!($about_us_img_data['no_image'][$i])) {  ?>
						<label for=""><input type="checkbox" name="deleted_img[]" id="deleted_img" value="<?php echo $about_us_img_data['id'][$i]; ?>">Del this image</label>
					<?php } else { ?>
						&nbsp;
					<?php } ?>
				</td>
			</tr>
		</table>
	  </td>
	</tr>
	<?php }
	}
	?>	
	<tr align="left" valign="top">
	  <td width="150">Change Image<br>(<?php echo $config_data['best_resolution_text'];?>): </td>
	  <td><input type='file' name='file_upload' id='file_upload'/></td>
	</tr>
	<tr>
	  <td valign="center">Description Text:</td>
	  <td>
		<textarea id="about_us_desc" name="about_us_desc" rows="18" cols="45" style="width:400px"><?php echo $about_us_data['about_us_desc'];?></textarea>
	  </td>
	</tr>
	<tr height="40">
	  <td colspan="2" align="right">
		<input name="submit" type="submit" class="button submit_button submit" id="submit" value="Save" />	
					
		<input name="subject" type="hidden" id="subject" value="about_us" />
		<input name="selected" type="hidden" id="selected" value="No" />
		<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
		<input name="image_id" type="hidden" id="image_id" value="0" />
	  </td>
	</tr>					
  </form>
</table>
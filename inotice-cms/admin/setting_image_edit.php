<?php
if (isset($_GET['subject']))   {

$subject = ($_GET['subject']);
$id = ((isset($_REQUEST['id']))?($_REQUEST['id']):(-1));

IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
{
	$show_msg = false;
	
	switch ($subject) {
		case "menu_icons":
			$show_msg = true;
			$data['label'] = $_POST['label'];
			$save_result = Save_menu_icon_data($id, $data);
	   break;
	}
	
   if ($show_msg) {
	if ($save_result) {
	?>
		<td><font color="blue">Messgae Saved</font></td>
	<?php
	}  else  {
	?>
		<td><font color="red"><strong>Message Save failed!!!</strong></font></td>
	<?php  }
  }
}
else Save_err_msg("");
	
echo "<td><font color=\"red\"><strong>".Select_err_msg()."</strong></font></td>";

$config_data = upload_file_config($subject,$id);
$image_data = Select_images($subject,$id,0);
?>
<script language='javascript' type="text/javascript">
	function validation(form1) {
		//title = document.form1.title.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		/*
		if (title.length == 0) {
			err_msg = err_msg + "\n- [ News Title ]";
		}		
		
		*/
		if (err_msg.length > 34) {
			alert(err_msg);
			return false;
		}
		return true;
	}
</script>

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


<div id="content">
<table border="2" width="780">
  <tr>
	<td bgcolor="#C0C4D3" colspan="2" valign="top"><strong><font size="+2"><?php echo $config_data['page_title'];?></font></strong></td>
  </tr>
</table>
</br>
<table border="2" width="780">

<form name="form1" id="form1" method="post" action="" enctype="multipart/form-data" onSubmit="return validation(this)">

<?php 
if (!($subject == "menu_icons_add")) {  ?>
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top" height="40"><strong>Original</strong></td>
	<td bgcolor="#C0C4D3" width="624" valign="middle">
		<?php output_image($image_data['image'][0],$config_data['thumb_max_width'],0,"","Upload Error!!"); ?>
	</td>
  </tr>
<?php } ?>

  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top" height="40"><strong>Image...<br>(Best <?php echo $config_data['best_resolution_text'];?>)</strong></td>
	<td bgcolor="#C0C4D3" width="624" valign="middle"><input type="file" name="file_upload" id="file_upload"/></td>
  </tr>
 
<?php 
if (($subject == "menu_icons") || ($subject == "menu_icons_add")) { ?>
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top" height="40"><strong>Label</strong></td>
	<td bgcolor="#C0C4D3" width="624" valign="middle">
		<input type="text" name="label" id="label" value="<?php echo $image_data['label'][0];?>" maxlength="10" style="width:350px"/>
	</td>
  </tr>
<?php 
}
?>
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top" height="40">&nbsp;</td>
	<td bgcolor="#C0C4D3" width="624" valign="middle" align="right">
		<table width="100%">
			<tr>
				<td width="50%" align="right">
					<input name="submit" type="submit" class="button submit_button submit" id="submit" value="Save" />
					
					<input name="subject" type="hidden" id="subject" value="<?php echo $subject; ?>" />
					<input name="selected" type="hidden" id="selected" value="No" />
					<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
					<input name="image_id" type="hidden" id="image_id" value="<?php echo $id; ?>" />
				</td>
				<td width="50%" align="right">
					<input name="back" type="button" class="button" id="back" value="Back" onClick="location='main.php?page=setting_main'"/>
				</td>
			</tr>
		</table>
	</td>
  </tr>
</form>
</table>
</div>
<?php 
}
?>

<table>
	<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?></tr>
</table>
<!--<table width="100%">
	<tr align="center">
		<td align="right">
			<strong><font size="+2"><?php echo $gallery_album_data['title'][0];?></font></strong>
		</td>
	</tr>
</table>-->
</br>
<table>

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

<script type="text/javascript">
	$(document).ready(function() {
		//uploadify
		  $('#file_upload').uploadify({
			'scriptData': {'subject': $("#subject").val(), 'aid': $("#aid").val()},
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


<table id="table-4b" width="100%">
<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<tr valign="top">
		<td colspan="3" align="right" > <Strong><font size="+1" color="Blue">***<?php echo $subtitle; ?>***</font></Strong> </td>
	</tr>
	<tr>
		<td align="right"><strong>Album Title (Max:20)</strong></td>
		<td colspan="2"><input name="title" type="text" id="title" value="<?php echo $gallery_album_data['title'][0];?>" maxlength="20" style="width:350px"/></td>
	</tr>
	<tr>
		<td align="right">Date</td>
		<td colspan="2">
			<!--<input name="xdate" type="text" id="xdate" value="<?php echo ($mode == "edit")?$gallery_album_data['xdate_str'][0]:(date("Y-m-d"));?>" maxlength="10"/>-->
			<script>DateInput('xdate', true, 'YYYY-MM-DD', '<?php echo ($mode == "edit")?$gallery_album_data['xdate_str'][0]:(date("Y-m-d"));?>')</script>
		</td>
	</tr>
	<tr>
		<td width="186">&nbsp;</td>
		<td width="186">&nbsp;</td>
		<td width="186" align="right"><?php echo (($mode) == "edit")?"Total Images: ".$gallery_photo_count:"&nbsp;"; ?></td>
	</tr>
	<?php 
	
	//Edit album mode
	if (($mode) == "edit") {  ?>
	<?php if (($gallery_photo_count) > 0) {  ?>
	<tr>	
	<?php for ($i = 0; $i <= ($gallery_photo_count - 1); $i++) {?>
		<td valign="top">
			<table width="100%">
				<tr align="center" height="115">
					<td colspan="2">
						<a href="main.php?page=control_main&cpage=control_gallery_img_edit&aid=<?php echo $aid; ?>&id=<?php echo $gallery_photo_data['id'][$i]; ?>">
							<?php output_image($config_data['folder']."/thumb/".$gallery_photo_data['image'][$i],0,0,"","Thumb Error!"); ?>
						</a>
					</td>
				</tr>
				<tr align="center">
					<td colspan="2"><font color="#000000"><strong><?php echo $gallery_photo_data['title'][$i]; ?></strong></font></td>
				</tr>
				<tr align="center">
					<td colspan="2">
						<font color="#000000"><?php echo ($gallery_photo_data['description'][$i] != "")?$gallery_photo_data['description'][$i]."...":""; ?></font>
					</td>
				</tr>
				<tr align="center">
					<td>
						<label for=""><input type="radio" name="as_cover" id="as_cover" value="<?php echo $gallery_photo_data['id'][$i]; ?>" <?php echo ($gallery_photo_data['as_cover'][$i] == 1)?"checked":""; ?>><br>Cover</label>
					</td>
					<td>
						<label for=""><input type="checkbox" name="deleted_img[]" id="deleted_img" value="<?php echo $gallery_photo_data['id'][$i]; ?>"><br>Delete</label>
					</td>
				</tr>
			</table>
		</td>
		<?php if (($i+1) % 3 == 0) {?>
			</tr> <tr>
		<? }  ?>
	<?php }  ?>
	</tr>
	<?php
	}
	else
	{ ?>
	<tr>
		<td valign="center" colspan="3"><font color="RED"><!--No Image in this Album!!!!-->&nbsp;</font></td>
	</tr>
	
	<?php 
	}
	?>
	<tr>
		<td align="left" valign="middle" colspan="3" height="60">
			<input type='file' name='file_upload' id='file_upload'/><?php echo $config_data['best_resolution_text'];?>
		</td>
	</tr>
	
	<?php
	}
	?>
	<tr>
		<td align="right" valign="middle" colspan="2" height="50">
			<input name="submit" type="submit" class="button submit_button submit" id="submit" value="Save" />	
					
			<input name="subject" type="hidden" id="subject" value="gallery" />
			<input name="selected" type="hidden" id="selected" value="No" />
			<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
			<input name="aid" type="hidden" id="aid" value=<?php echo $aid; ?> />
		</td>
		<td align="right" valign="middle" colspan="1" height="50">
			<input name="back" type="button" class="button" id="back" value="Cancel" onClick="location='<?php echo $up_page;?>'">
		</td>
	</tr>
</form>
</table>
<br>
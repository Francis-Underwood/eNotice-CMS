<table width="500">

<?php
	$config_data = upload_file_config("about_us",-1);
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	$data['about_us_desc'] = $_POST['about_us_desc'];
	$data['deleted_img'] = $_POST['deleted_img'];

	if (Save_about_us($data)) {
	?>
		<tr><td><font color="blue">Message Saved</font></td></tr>
	<?php
	}  else  {
	?>
		<tr><td><font color="red"><strong>Message Saved failed!!!</strong></font></td></tr>
	<?php  }
	}

	else Save_err_msg("");
	
	echo "<tr><td><font color=\"red\"><strong>".Select_err_msg()."</strong></font></td></tr>";

	$about_us_data = Select_about_us();
?>
</table>

<script language='javascript' type="text/javascript">
	function validation(form1) {
		//about_us_img = document.form1.about_us_img.value;
		//about_us_desc = document.form1.about_us_desc.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		
		//if (about_us_img.length == 0) {
			//err_msg = err_msg + "\n- [ Image ]";
		//}		
		
		//if (about_us_desc == "") {
			//err_msg = err_msg + "\n- [ Description Text ]";
		//}
		
		if (err_msg.length > 34) {
			alert(err_msg);
			return false;
		}
		return true;
	}
</script>

<!-- TinyMCE 
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		//plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
/*		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,emotions,iespell,inlinepopups,insertdatetime,preview,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",     */
		
		// Theme options
		//theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		//theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,fontsizeselect",
		theme_advanced_buttons2 : "forecolor,backcolor",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : false,
		theme_advanced_resizing : true,
/*
		// Example content CSS (should be your site CSS)
		content_css : "tinymce/examples/css/content.css",
		
		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		formats : {
			alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
			aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
			alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
			alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
			bold : {inline : 'span', 'classes' : 'bold'},
			italic : {inline : 'span', 'classes' : 'italic'},
			underline : {inline : 'span', 'classes' : 'underline', exact : true},
			strikethrough : {inline : 'del'}
		},

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}   
*/
	});
</script>
<!-- /TinyMCE -->

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

<table width="550">
	<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<!--<tr align="left" valign="top">
	  <td width="250">&nbsp;</td>
	  <td width="250">
		 <input name="about_us_img" type="text" id="about_us_img" value="<?php echo $about_us_data['about_us_img'];?>" />
	  </td>
	</tr>-->
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
				<td><?php output_image($about_us_img_data['image'][$i],400,0,"","Error for read the image!"); ?></td>
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
		<textarea id="elm2" name="about_us_desc" rows="18" cols="45" style="width:400px"><?php echo $about_us_data['about_us_desc'];?></textarea>
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
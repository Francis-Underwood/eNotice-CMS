<table width="580">
  <tr>
<?php
	$news_id = (isset($_REQUEST["news_id"]))?($_REQUEST["news_id"]):0;
	$config_data = upload_file_config("news",-1);

	//$mode = (($_GET["action"]="edit") && (isset($_GET["id"])))?"edit":"add";
	$mode = ($news_id > 0)?"edit":"add";
	
	//echo $mode;
	
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	
	//$news_id = $_POST['news_id'];
	$data['title'] = substr($_POST['title'],0,80);
	$data['xdate'] = substr($_POST['xdate'],0,10);
	$data['deleted_news_img'] = $_POST['deleted_news_img'];
	$data['summary'] = substr($_POST['summary'],0,10000);
	$data['content'] = $_POST['content'];
	
	if (Save_news($news_id, $data)) {
	?>
		<td><font color="blue">Saved</font></td>
	<?php
	switch ($mode) {
		case "add":
			//Change to EDIT mode after saved
			$news_id = mysql_insert_id();
			$mode = "edit";			
			break;
		default:
			break;
	}
	
	}  else  {
	?>
		<td><font color="red"><strong>Saved failed!!!</strong></font></td>
	<?php  }
	
	}
	else Save_err_msg("");
	
	echo "<td><font color=\"red\"><strong>".Select_err_msg()."</strong></font></td>";
	switch ($mode) {
		case "edit":
			$news_data = Select_news($news_id);
			$subtitle = "Editing Mode";
			break;
		default:
			$news_data = null;
			$subtitle = "Adding Mode";
			break;
	}
	?>
  </tr>
</table>

<script language='javascript' type="text/javascript">
	function validation(form1) {
		title = document.form1.title.value;
		xdate = document.form1.xdate.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		
		if (title.length == 0) {
			err_msg = err_msg + "\n- [ News Title ]";
		}		
		
		if (xdate == "") {
			err_msg = err_msg + "\n- [ News Date ]";
		}
		
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
			'scriptData': {'subject': $("#subject").val(), 'news_id': $("#news_id").val()},
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

<table width="580">
  <form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	<tr align="right" valign="top">
	  <td>&nbsp;</td>
	  <td> <Strong><font size="+1" color="Blue">***<?php echo $subtitle; ?>***</font></Strong> </td>
	</tr>
	<tr align="left" valign="top">
	  <td width="200">Title <br>(Max 50 Chars): </td>
	  <td width="380">
		 <input name="title" type="text" id="title" value="<?php echo $news_data['title'][0];?>" maxlength="50" style="width:400px"/>
	  </td>
	</tr>
	<tr align="left" valign="top">
	  <td>Date: </td>
	  <td>
		 <input name="xdate" type="text" id="xdate" value="<?php echo ($mode == "edit")?$news_data['xdate_str'][0]:(date("Y-m-d"));?>" maxlength="10"/>
	  </td>
	</tr>
	<?php
	  if ($mode == "edit") {
		$news_img_count = Count_images("news",-1,$news_id);
		$news_img_data = Select_images("news",-1,$news_id);
	  }
	
	if (($news_img_count) > 0) { ?>
	 <?php for ($i = 0; $i <= ($news_img_count - 1); $i++) { ?>
	 <tr align="left" valign="top">
	  <td>&nbsp;</td>	 
	  <td>
		<table width="100%">
			<tr>
				<td><?php output_image($config_data['folder']."/thumb/".$news_img_data['image'][$i],0,0,"","Thumb Error!!"); ?></td>
				<td><label for=""><input type="checkbox" name="deleted_news_img[]" id="deleted_news_img" value="<?php echo $news_img_data['id'][$i]; ?>">Delete this image</label></td>
			</tr>
		</table>
	  </td>
	</tr>	  
	<?php }
	}
	?>
	<tr>
		<td>
			<strong>Add Image...<br>(Best <?php echo $config_data['best_resolution_text'];?>)</strong>
		</td>
		<td>
		<?php
		switch ($mode) {
			case "edit":
				echo "<input type='file' name='file_upload' id='file_upload'/>";
				break;
			default:
				echo "<strong>Please save the news before upload the images!!!</strong>";
				break;
		}
		?>
		</td>
	</tr>
	<tr>
	  <td valign="top">Summary <br>(Max 150 Chars):</td>
	  <td><textarea id="elm1" name="summary" rows="10" cols="50"><?php echo $news_data['summary'][0];?></textarea></td>
	</tr>
	<tr>
	  <td valign="top">Content:</td>
	  <td><textarea id="elm2" name="content" rows="20" cols="50"><?php echo $news_data['content'][0];?></textarea></td>
	</tr>
	<tr>
	  <td colspan="2">&nbsp;</td>
	</tr>
	<tr>
	  <td colspan="2" height="50">
		<table border="0" width="100%">
			<tr>
				<td width="65%" align="right">
					<input name="submit" type="submit" class="button submit_button submit" id="submit" value="Save" />	
					
					<input name="subject" type="hidden" id="subject" value="news" />
					<input name="selected" type="hidden" id="selected" value="No" />
					<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
					<input name="news_id" type="hidden" id="news_id" value="<?php echo $news_id; ?>" />
				</td>
				<td width="35%" align="right">
					<input name="back" type="button" class="button" id="back" value="Back" onClick="location='main.php?page=control_main&cpage=control_news_list'">				
				</td>
			</tr>
		</table>
	  </td>
	</tr>					
	</form>
</table>
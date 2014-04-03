<script language='javascript' type="text/javascript">
	function validation(form1) {
		title = form1.title.value;
		xdate = form1.xdate.value;
		content = form1.content.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		del_img_count = 0;
		
		if (title.length == 0) {
			//err_msg = err_msg + "\n- [ News Title ]";
		}		
		if (xdate == "") {
			//err_msg = err_msg + "\n- [ News Date ]";
		}
		/*
		if (content == "") {
			//err_msg = err_msg + "\n- [ Content ]";          <--some little error for editor
		//}	 */
		
		//Check deleted_news_img checked

		/*
		
		//if (form1.elements["deleted_news_img[]"].checked !='undefined') {             <-- Some Error
			if (form1.elements["deleted_news_img"].checked == true) {
				del_img_count++;
			}			
		//} else  {
			for (x=0; x < form1.elements["deleted_news_img[]"].length; x++) {
				if (form1.elements["deleted_news_img[]"][x].checked==true) {
					del_img_count++;
				}
			}
		//}

		*/
		
		if (del_img_count>0) {
			if (!(confirm("Are you sure delete ticked image(s)?"))) {
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

	var oFCKeditor = new FCKeditor( 'content' ) ;
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ToolbarSet	= 'Basic_nofont' ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '300' ;
	oFCKeditor.ReplaceTextarea() ;
	
	//Return the focus to the first textbox
	//document.forms[0].title.focus();
	idsquare.wilson.setFocus();	
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
				'news_id'	: $("#news_id").val()
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
		<span class="mws-i-24 i-list">News Editor</span>
	</div>
	<div class="mws-panel-body">
		<div class="mws-form-message status">
			<img src="mws-admin/css/icons/16/edit.png" width="20">&nbsp;<?php echo $subtitle; ?>
		</div>
		<!-- News Content-->
		<div class="mws-wizard clearfix">
			<ul>
				<li class="current"><a class="mws-ic-16 ic-page-white-text">News Content</a></li>			
				<li><a class="mws-ic-16 ic-picture">Image</a></li>
			</ul>
		</div>
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg); ?>
		<form id="mws-validate" class="mws-form" name="form1" method="post" action="" onSubmit="return validation(this)">
			<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label>Title (Max 50):</label>
					<div class="mws-form-item">
						<input class="mws-textinput required" name="title" type="text" value="<?php echo $news_data['title'][0];?>" maxlength="50" style="width:400px"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Date</label>
					<div class="mws-form-item">
						<input class="mws-textinput mws-datepicker-wk required" type="text" name="xdate" style="width:200px" value="<?php echo ($mode == "edit")?$news_data['xdate_str'][0]:(date("Y-m-d"));?>" readonly="1">
					</div>
				</div>
				<div class="mws-form-row">
					<label>Summary<br>(Max 150 Chars):</label>
					<div class="mws-form-item large">
						<textarea id="summary" name="summary" onkeydown="parseCharCounts();" onKeyUp="parseCharCounts();" onChange="parseCharCounts();" maxlength="150" lengthcut="true" wrap="virtual"><?php echo $news_data['summary'][0];?></textarea>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Content:</label>
					<div class="mws-form-item large">
						<textarea id="content" name="content"><?php echo $news_data['content'][0];?></textarea>
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<input name="submit" type="submit" class="mws-button green" id="submit" value="Save" />	
				
				<input name="subject" type="hidden" id="subject" value="news" />
				<input name="news_id" type="hidden" id="news_id" value="<?php echo $news_id; ?>" />
				<input name="back" type="button" class="mws-button gray" id="back" value="Back" onClick="location='main.php?page=control_news_list'">		
			</div>
		</form>
		<!-- End of News Content-->
		<!-- News Image(s) -->
		<?php if ($mode == "edit") {		?>
		<div class="mws-wizard clearfix">
			<ul>
				<li><a class="mws-ic-16 ic-page-white-text">News Content</a></li>			
				<li class="current"><a class="mws-ic-16 ic-picture">Image</a></li>
			</ul>
		</div>
		<?php
			show_system_msg("", $error_msg2, "");
		?>
		<form class="mws-form" name="form_img" id="form_img" method="post" action="" onSubmit="">
			<div class="mws-form-inline">
				<?php
				if ($mode == "edit") {	
					$news_img_count = Count_images("news",-1,$news_id);
					$news_img_data = Select_images("news",-1,$news_id);
				}
				if (($news_img_count) > 0) { ?>
				 <?php for ($i = 0; $i <= ($news_img_count - 1); $i++) { ?>	

				<div class="mws-form-row">
					<label>&nbsp;</label>
					<div class="mws-form-item">
						<table width="100%">
							<tr>
								<td width="33%">
									<?php 
										$img = $config_data['folder']."/".$news_img_data['image'][$i];
										output_image($img,$config_data['thumb_max_width'],0,"",""); 
									?>
								</td>
								<td width="33%"><?php show_scissor($img,"news",$news_img_data['id'][$i],$news_id,"Upload Error!!","img"); ?></td>								
								<td valign="middle">
									<!--<label for=""><input type="checkbox" name="deleted_news_img[]" id="deleted_news_img" value="<?php echo $news_img_data['id'][$i]; ?>">Delete this image</label>-->
									 <a href="#" onclick="decision('Are you sure delete the news Image?','<?php echo "main.php?page=control_news_edit&action=del&news_id=$news_id&img_id=".$news_img_data['id'][$i]; ?>')">
										<img src="mws-admin/css/icons/32/cross.png" width="20">
									 </a>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<?php }
				}
				?>
				<div class="mws-form-row">
					<label>Add Image<br>(Min <?php echo $config_data['best_resolution_text'];?>)</label>
					<div class="mws-form-item">
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
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<input class="mws-button green" onclick="$('#file_upload').uploadify('upload','*');" type="button" value="Upload" />
				<input name="subject" type="hidden" id="subject" value="news" />
				<input name="news_id" type="hidden" id="news_id" value="<?php echo $news_id; ?>" />	
			</div>
		</form>
		<?php  } ?>
		<!-- End of News Image(s) -->
	</div>    	
</div>
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
		
		if (del_video_count>0) {
			if (!(confirm("Are you sure delete ticked video(s)?"))) {
				return false;
			}
		}
		
		return true;
	}
</script>


<!--Uploadify-->
<script type="text/javascript" src="uploadify3.2/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="uploadify3.2/uploadify.css">
<script type="text/javascript">
	$(function() {
		//Multi
		$('#file_upload').uploadify({
			'formData'     : {
				'token'     : '<?php echo md5('unique_salt' . time());?>',
				'folder'   	: '<?php echo $config_data['folder'];?>',
				'subject'	: $("#subject").val(), 
			},
			'swf'      : 'uploadify3.2/uploadify.swf',
			'uploader' : 'scripts/upload_videos.php?id=' + $("#eid").val(),
			'method'   : 'post',
			'queueSizeLimit' : <?php echo $config_data['queueSizeLimit'];?>,
			'fileTypeDesc' : '<?php echo $config_data['fileDesc'];?>',
			'fileTypeExts' : '<?php echo $config_data['fileExt'];?>',
			'fileSizeLimit' : '<?php echo $sizeLimit_mb;?>',
			'buttonText' : 'Select Videos', 
			'removeCompleted' : true, 
			'height' : 25,
			'multi'    : true,
			'auto'      : false,
			'onQueueComplete' : function(queueData,file) {
				alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
				location.reload();
			}
		})
	});
</script>
<!--End of Uploadify-->

<!-- Panel Container -->
<div class="mws-panel grid_8">
	<!-- Panel Header -->
	<div class="mws-panel-header">
		<span class="ids-vince-non-block mws-i-24 i-film-2">Movie Gallery Listing</span>
		<span class="ids-vince-right-header-span">Total Video: <?php echo $movie_gallery_count; ?></span>
	</div>
	<!-- End Panel Header -->
	
	<!-- Panel Body -->
	<div class="mws-panel-body">
		<form class="mws-form" name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
			<?php show_system_msg($positive_msg, $error_msg, $tip_msg);?>
			<?php show_system_msg("", $error_msg2, "");	?>
			<!-- Video Record Table -->
			<table class="mws-table">
				<?php 
					$disable_re_order_btn = (($movie_gallery_count) <= 1)?("disabled"):(""); 
					if (($movie_gallery_count) > 0) 	{ 		?>
					<thead>
						<tr>
							<th width="30%">Preview</th>
							<th width="50%">Video File</th>
							<th width="10%">Tick to Delete</th>
							<th width="10%">&nbsp;</th>
						</tr>
					</thead>
					<tbody>					
				<?php  for ($i = 0; $i <= ($movie_gallery_count - 1); $i++) 
						{
				?>
					<tr class="gradeC">
						<td>
							<a title="Edit" href="main.php?page=control_movie_gallery_edit&id=<?php echo $movie_gallery_data['id'][$i]; ?>">
								<?php output_image($config_data['folder']."/thumb/".$movie_gallery_data['thumb'][$i],60,0,"","Thumb Error!!"); ?>
							</a>
						</td>
						<td><?php echo $movie_gallery_data['title'][$i]; ?></td>
						<td class="center">
							<input type="checkbox" name="deleted_video[]" id="deleted_video" value="<?php echo $movie_gallery_data['id'][$i]; ?>">
						</td>
						<td>
							<a href="main.php?page=control_movie_gallery_edit&id=<?php echo $movie_gallery_data['id'][$i]; ?>">
								<img src="mws-admin/css/icons/16/edit.png" width="20">
							</a>
						</td>
					</tr>
				<?php 
						}
					}
					else  
						{
							show_system_msg("", "", "No Gallery Video found!!");
						}
				 ?>	
				</tbody>
			</table>
			<!-- End Video Record Table -->
			
			<!-- Uploadify -->
			<div style="margin-left: 10px; margin-bottom-20px; margin-top:10px;">
				<span><label style="cursor: auto;">Add more videos</label></span><br>
				<input type='file' name='file_upload' id='file_upload'/>
				<div style="height:20px;"></div>
			</div>
			<!-- End Uploadify -->		
			
			<!-- Botton Bar -->	
			<div class="mws-button-row">
				<input class="mws-button left green mws-i-24 i-cross large" type="submit" name="submit" value="Del Selected Movies"/>
				<input class="mws-button green" onclick="$('#file_upload').uploadify('upload','*');" type="button" value="Upload" />
				<input class="mws-button green" onclick="location='main.php?page=control_movie_gallery_sort'" type="button" value="Re-order Videos" <?php echo $disable_re_order_btn;?>/>
			</div>
			<!-- End Botton Bar -->	
			
			<!-- Hidden Fields -->	
			<input name="subject" type="hidden" id="subject" value="movie_gallery" />
			<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
			<input name="image_id" type="hidden" id="image_id" value="0" />
			<!-- End Hidden Fields -->
		</form>
	</div>    	
</div>
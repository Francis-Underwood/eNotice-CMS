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
			'uploader' : 'scripts/upload_videos.php?id=999',
			'method'   : 'post',
			'queueSizeLimit' : <?php echo $config_data['queueSizeLimit'];?>,
			'fileTypeDesc' : '<?php echo $config_data['fileDesc'];?>',
			'fileTypeExts' : '<?php echo $config_data['fileExt'];?>',
			'fileSizeLimit' : '80MB',
			'buttonText' : 'Select Videos', 
			'removeCompleted' : true, 
			'height' : 25,
			'multi'    : true,
			'auto'      : false,
			'onQueueComplete' : function(queueData,file) {
				//alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
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
		<span class="ids-vince-non-block mws-i-24 i-monitor">Cover Video</span>
		<span class="ids-vince-right-header-span">Total Videos: <?php echo $banner_video_count;?></span>
	</div>
	<!-- End Panel Header -->
	<!-- Panel Body -->
	<div class="mws-panel-body">
		<form class="mws-form" name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
			<?php show_msg($positive_msg, $error_msg, $tip_msg);?>
			<?php show_msg("", $error_msg2, "");?>
			<?php 
				if (($banner_video_count) > 0) {	?>
			<!-- Video Record Table -->
			<table class="mws-table">
				<thead>
					<tr>
						<th width="15%">Preview</th>
						<th width="45%">Video File</th>
						<th width="20%">Configation</th>
						<th width="10%">Tick to Delete</th>
						<th width="10%">Edit</th>
					</tr>
				</thead>
				<tbody>	
				<?php
					for ($i = 0; $i <= ($banner_video_count - 1); $i++)   {
				?>
					<tr class="gradeC">
						<td>
							<a title="Edit" href="main.php?page=control_banner_video_edit&id=<?php echo $banner_video_data['id'][$i]; ?>">
								<?php output_image($config_data['folder']."/thumb/".$banner_video_data['thumb'][$i],60,0,"","No Image"); ?>
							</a>
						</td>					
						<td>
							<?php echo $banner_video_data['title'][$i]; ?>
						</td>
						<td>
							<?php echo video_aspect_name($banner_video_data['aspect_option'][$i]); ?>
						</td>						
						<td class="center">
							<input type="checkbox" name="deleted_video[]" id="deleted_video" value="<?php echo $banner_video_data['id'][$i]; ?>">
						</td>
						<td>
							<a href="main.php?page=control_banner_video_edit&id=<?php echo $banner_video_data['id'][$i]; ?>"><img src="images/icons/edit.png"></a>
						</td>
					</tr>
				<?php 
						} 
					}
					else show_msg("", "", "No Video for Banner!!!!");
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
				<input class="mws-button green" name="submit" type="submit" id="submit" value="Save"/>
				<input class="mws-button green" onclick="$('#file_upload').uploadify('upload','*');" type="button" value="Upload" />
			</div>
			<!-- End Botton Bar -->	
			
			<!-- Hidden Fields -->				
			<input name="subject" type="hidden" id="subject" value="banner_video" />
			<input name="video_id" type="hidden" id="video_id" value="0" />
			<!-- End Hidden Fields -->	
		</form>
	</div>
	<!-- End Panel Body -->
</div>
<!-- End Panel Container -->
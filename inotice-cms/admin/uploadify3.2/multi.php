<!DOCTYPE HTML>
<html>
<head>
<!--Source from: http://www.uploadify.com/download/-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
<script src="jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadifive.css">
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>

<script type="text/javascript">
	<?php $timestamp = time();?>
	$(function() {	
		//Multi
		$('#file_upload').uploadify({
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			},
			'folder'   : 'uploads',
			'method'   : 'post',
			'swf'      : 'uploadify.swf',
			'uploader' : 'uploadify.php',
			'height' : 30,
			'progressData' : 'speed',
			'multi'    : true,
			'auto'      : false,
			'buttonText' : 'Select Images', 
			'queueSizeLimit' : 20,
			'fileSizeLimit' : '100MB',
			'fileTypeDesc' : 'Image Files',
			'fileTypeExts' : '*.jpg;*.png;',
			'onQueueComplete' : function(queueData,file) {
				alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
				//$(form).submit();
				location.reload();
			}
		})
	});
</script>

</head>

<body>
	<h1>Uploadify Multi Files upload Demo at <br><?php echo date('l jS \of F Y h:i:s A');?></h1>
	<h1>
		<a href="single.php">Single</a> </br>
		<a href="multi.php">Multi</a>
	</h1>
	<form id="form1" name="form1">
		<table width="100%">
			<tr>
				<td width="100%"><input id="file_upload" name="file_upload" type="file" multiple="true"></td>
			</tr>
			<tr>
				<td width="100%"><input onclick="$('#file_upload').uploadify('upload','*');" type="button" value="Upload" /></td>
			</tr>			
		</table>
	</form>


	<?php
	$target_directory = "uploads";
	if ($handle = opendir($target_directory)) {
		echo "Directory handle: $handle\n";
		echo "Entries:\n";

		/* This is the correct way to loop over the directory. */
		while (false !== ($entry = readdir($handle))) {
			echo "$entry <br>";
			echo "<img src=$target_directory/$entry width='200'> </br>";
		}

		closedir($handle);
	}
	?>
</body>
</html>
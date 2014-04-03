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
	
		// Single 
		$('#file_upload').uploadify({
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			},
			'swf'      : 'uploadify.swf',
			'uploader' : 'uploadify.php',
			'height' : 25,
			'multi'    : false,
			'auto'      : true,
			'removeCompleted' : false, 
			'removeTimeout'   : 20, 
			'buttonText' : 'Select Image', 
			//'cancelImg' : 'uploadify-cancel.png',
			'onQueueComplete' : function(file) {
				alert('The file ' + file.name + ' was successfully uploaded!!!!!');
				location.reload();
			}
		})
	});
</script>
	
</head>
<body>
	<h1>Uploadify Single File upload Demo at <br><?php echo date('l jS \of F Y h:i:s A');?></h1>
	<h1>
		<a href="single.php">Single</a> </br>
		<a href="multi.php">Multi</a>
	</h1>

		<table width="100%">
			<tr>
				<td width="100%"><input id="file_upload" name="file_upload" type="file" multiple="true"></td>
			</tr>
		</table>
		<input id="submit" name="submit" type="submit" class="" value="Save">		


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
<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */
$src = 'demo_files/t8Z8Penguins.jpg';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = 120;
	$targ_h = 90;
	$jpeg_quality = 100;

	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	header('Content-type: image/jpeg');
	imagejpeg($dst_r,null,$jpeg_quality);

	exit;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" /> 
		<title>My Demo Here</title>
		
		<script src="../js/jquery.min.js"></script>
		<script src="../js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
		<link rel="stylesheet" href="demo_files/dem22os.css" type="text/css" />

		<script language="Javascript">
		function checkCoords() 	{
				//if (parseInt($('#w').val())) return true;
				if (!($('#w').val() == 0)) return true;
				alert('Please select a crop region then press submit.');
				return false;
		};
		
			$(function(){
				// Create variables (in this scope) to hold the API and image size
				var jcrop_api, boundx, boundy;
				
				$('#cropbox').Jcrop({
				    onChange: updatePreview,
					onSelect: updatePreview,
					onSelect: updateCoords,
					onRelease:  clearCoords,
					maxSize: [ 500, 0 ],
					minSize: [ 80, 0 ],
					aspectRatio: 80/60,
					bgOpacity: .7
				},function(){
				// Use the API to get the real image size
				var bounds = this.getBounds();
				boundx = bounds[0];
				boundy = bounds[1];
				// Store the API in the jcrop_api variable
				jcrop_api = this;
				});

			function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function updatePreview(c)	{
				if (parseInt(c.w) > 0)
				{
				var rx = 120 / c.w;
				var ry = 90 / c.h;

				$('#preview').css({
					width: Math.round(rx * boundx) + 'px',
					height: Math.round(ry * boundy) + 'px',
					marginLeft: '-' + Math.round(rx * c.x) + 'px',
					marginTop: '-' + Math.round(ry * c.y) + 'px'
				});
				}
			};
			
			function clearCoords()	{
				$('#x').val(0);
				$('#y').val(0);
				$('#w').val(0);
				$('#h').val(0);
			};				
				
		});
		</script>
	</head>

	<body>

	<div id="ou222ter">
	  <div class="jcExa222mple">
	   <div class="artic22le">
		<h1>My Demo Try Here</h1>
		
		<table border="1">
			<tr>
				<td>
					<!-- This is the image we're attaching Jcrop to -->
					<img src="<?php echo $src; ?>" id="cropbox" />				
				</td>
				<td>
					Preview:<br>
					<div style="width:120px;height:90px;overflow:hidden;">
						<img src="<?php echo $src; ?>" id="preview" alt="Preview" class="jcrop-preview" />
					</div>				
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<!-- This is the form that our event handler fills -->
					<form id="coords" class="coords" action="" method="post" onsubmit="return checkCoords();">
						X:<input type="text" id="x" name="x" value="0"/>
						Y:<input type="text" id="y" name="y" value="0"/>
						W:<input type="text" id="w" name="w" value="0"/>
						H:<input type="text" id="h" name="h" value="0"/>
						<input type="submit" value="Crop" style="width:200px" />
					</form>			
				</td>
			</tr>
		</table>

	   </div>
	  </div>
	</div>
	</body>
</html>

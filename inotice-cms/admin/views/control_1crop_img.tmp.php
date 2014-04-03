<!--<script src="tapmodo-Jcrop-25f2e18/js/jquery-1.7.2.min.js"></script>           **already called at head.php**-->
<script src="tapmodo-Jcrop-25f2e18/js/jquery.Jcrop.js"></script>
<script src="tapmodo-Jcrop-25f2e18/js/jquery.color.js" type="text/javascript"></script>

<link rel="stylesheet" href="tapmodo-Jcrop-25f2e18/css/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href="tapmodo-Jcrop-25f2e18/css/jquery.Jcrop.extras.css" type="text/css" />

<script language="Javascript">
	function checkCoords() 	{
			//if (parseInt($('#w').val())) return true;
			if (!($('#w').val() == 0)) return true;
			alert('Please select a crop region before press Crop.');
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
				maxSize: [ <?php echo $img_width; ?>, 0 ],
				minSize: [ <?php echo $matched_width; ?>, 0 ],
				aspectRatio: <?php echo $matched_width."/".$matched_height; ?>,
				//bgColor: '#4BB6F0',
				bgColor: '#FFFFFF',
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
			$('#x2').val(c.x2);
			$('#y2').val(c.y2);
			$('#w').val(c.w);
			$('#h').val(c.h);
		};

		function updatePreview(c)	{
			if (parseInt(c.w) > 0)
			{
			var rx = <?php echo $matched_width; ?> / c.w;
			var ry = <?php echo $matched_height; ?> / c.h;

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
			$('#x2').val(0);
			$('#y2').val(0);
			$('#w').val(0);
			$('#h').val(0);
		};				
			
	});
</script>
		<div class="mws-panel grid_8">
			<div class="mws-panel-header">
				<span class="ids-vince-non-block mws-ic ic-cut-red">Image Croping...</span>
				<span class="ids-vince-right-header-span">Zoom: <?php echo $zoom * 100;?>%</span>
			</div>
			<div class="mws-panel-body">
				<form id="coords" class="mws-form coords" action="" method="post" onsubmit="return checkCoords();">	
					<div class="mws-form-block">
						<div class="mws-form-row">
							<label>Original</label>
							<!--<div id="mws-crop-parent" class="">-->
							<div id="mws-crop-parent" class="">
								<img src="<?php echo $src; ?>" id="cropbox" width="<?php echo $img_width; ?>"/>	
							</div>
						</div>
						<div class="mws-form-row">
							<label>Crop To:</label>
							<div id="mws-crop-parent" class="" style="width:<?php echo $matched_width; ?>px;height:<?php echo $matched_height; ?>px;overflow:hidden;">
								<?php if (file_exists($src)) {  
									echo "<img src=$src id=\"preview\" alt=\"Preview\" class=\"jcrop-preview\" />";
								} ?>
							</div>
						</div>
						<div class="mws-form-row">
							<label>&nbsp;</label>
							<div id="mws-crop-parent" class="mws-form-item">
								X:<input type="text" id="x" name="x" value="0" style="width:50px" readonly="1"/>
								Y:<input type="text" id="y" name="y" value="0" style="width:50px" readonly="1"/>
								X2:<input type="text" id="x2" name="x2" value="0" style="width:50px" readonly="1"/>
								Y2:<input type="text" id="y2" name="y2" value="0" style="width:50px" readonly="1"/>
								W:<input type="text" id="w" name="w" value="0" style="width:50px" readonly="1"/>
								H:<input type="text" id="h" name="h" value="0" style="width:50px" readonly="1"/>
							</div>
						</div>								
					</div>
					<div class="mws-button-row">
						<!--<input type="hidden" name="src" value="<?php echo $src; ?>"/>-->
						<input type="submit" name="submit" value="Crop" class="mws-button green" <?php echo $btn_disabled ?>/>					
						<input name="back" type="button" class="mws-button gray" value="Cancel" onClick="location='<?php echo $Redirect;?>'" <?php echo $btn_disabled ?>>	
					</div>
				</form>
			</div>
		</div>
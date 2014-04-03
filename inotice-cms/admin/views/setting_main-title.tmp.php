	<h3><a href="#" class="mws-i-24 i-off"><div style="margin-left : 2.5em;">Title</div></a></h3>
	<div>
		<form class="mws-form" name="form1" id="form1" method="post" action="" onSubmit="">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label>Heading (Max 20)</label>
					<div class="mws-form-item small">
						<input type="text" class="mws-textinput" name="company_title" maxlength="20" value="<?php echo $config_title_data['company_title'];?>">
						<input type="text" name="company_title_color" class="mws-textinput mws-colorpicker" value="<?php echo $config_title_data['company_title_color'];?>" readonly="1"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Subtitle (Max 50)</label>
					<div class="mws-form-item small">
						<input type="text" class="mws-textinput" name="company_subtitle" maxlength="50" value="<?php echo $config_title_data['company_subtitle'];?>">
						<input type="text" name="company_subtitle_color" class="mws-textinput mws-colorpicker" value="<?php echo $config_title_data['company_subtitle_color'];?>" readonly="1"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Current Time Color</label>
					<div class="mws-form-item small">
						<input type="text" name="curr_time_color" class="mws-textinput mws-colorpicker" value="<?php echo $config_title_data['curr_time_color']; ?>" readonly="1"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Temperature Color</label>
					<div class="mws-form-item small">
						<input type="text" name="weather_temp_color" class="mws-textinput mws-colorpicker" value="<?php echo $config_title_data['weather_temp_color']; ?>" readonly="1"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Banner Type</label>
					<div class="mws-form-item clearfix">
						<ul class="mws-form-list inline">										
							<li><label for="banner_type_i"><input type="radio" id="banner_type_i" name="banner_type" value="i" <?php echo ($config_title_data['banner_type'] == "i")?"checked":"";?>>Image</label></li>
							<li><label for="banner_type_v"><input type="radio" id="banner_type_v" name="banner_type" value="v" <?php echo ($config_title_data['banner_type'] == "v")?"checked":"";?>>Video</label></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<input name="top" type="hidden" value="title"/>
				<input name="submit" type="submit" value="Save" class="mws-button green" />
			</div>
		</form>
	</div>

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span class="mws-i-24 i-megaphone">Narrow Casting</span>
	</div>
	<div class="mws-panel-body">
	<?php show_system_msg($positive_msg, $error_msg, $tip_msg); ?>
		<form id="mws-validate" class="mws-form" method="post" action="" onSubmit="return validation(this)">
			<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label>Text Color</label>
					<div class="mws-form-item small">
						<input type="text" name="casting_color" class="mws-textinput mws-colorpicker" value="<?php echo $casting_data['casting_color']; ?>" readonly="1"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Casting Text</label>
					<div class="mws-form-item large">
						<textarea type="text" name="casting_text" class="mws-textinput" cols="55" rows="8"><?php echo $casting_data['casting_text'];?></textarea>
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<input name="submit" type="submit" class="mws-button green" id="submit" value="Save" />
			</div>
		</form>
	</div>    	
</div>
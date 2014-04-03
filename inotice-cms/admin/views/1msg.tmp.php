<?php function show_system_msg($green_msg, $red_msg, $yellow_msg) { ?>
	<?php if ($green_msg != "") { ?>
		<div class="mws-form-message success"><?php echo $green_msg; ?></div>
	<?php } ?>
	<?php if ($red_msg != "") { ?>
		<div class="mws-form-message error"><?php echo $red_msg; ?></div>
	<?php } ?>
	<?php if ($yellow_msg != "") { ?>
		<div class="mws-form-message warning"><?php echo $yellow_msg; ?></div>
	<?php } ?>
<?php } ?>
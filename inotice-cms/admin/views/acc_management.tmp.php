<script language='javascript' type="text/javascript">
	function validation(form1) {
		curr_pw = form1.curr_pw.value;
		new_pw1 = form1.new_pw1.value;
		new_pw2 = form1.new_pw2.value;
		
		err_msg = "";
		
		if (curr_pw.length == 0) {
			err_msg = err_msg + "\n- Current Password cannot be blanked";
		}
		if ((new_pw1.length == 0) || (new_pw2.length == 0)) {
			err_msg = err_msg + "\n- New Password cannot be blanked";
		}
		
		if ((new_pw1.length > 0) && (new_pw2.length > 0) && (!(new_pw1.length == new_pw2.length))) {
			err_msg = err_msg + "\n- Two new passwords not match";
		}
		else
		{
			if (!(idsquare.wilson.pw_check_a(new_pw1,6)) && (new_pw1.length > 0)) {
				err_msg = err_msg + "\n- Invaild Password!!!";
				err_msg = err_msg + "\n  -It should be: ";
				err_msg = err_msg + "\n  	1. At least 6 chars. ";
				err_msg = err_msg + "\n  	2. At least 1 upper & 1 lower chars. ";
			}
		}
		
		if (err_msg.length > 0) {
			alert(err_msg);
			return false;
		}
		return true;
	}
</script>

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span class="mws-i-24 i-list">Account Information</span>
	</div>
	<div class="mws-panel-body">
		<?php 
			show_system_msg($positive_msg, $error_msg, $tip_msg);
		?>
		<form id="mws-validate" class="mws-form" name="form1" method="post" action="">
			<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label>User Name</label>
					<div class="mws-form-item large">
						<input type="text" name="display_name" class="mws-textinput required" maxlength="50" value="<?php echo $acc_data['display_name'];?>"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>Email</label>
					<div class="mws-form-item large">
						<input type="text" name="email" class="mws-textinput required email" maxlength="50" value="<?php echo $acc_data['email'];?>"/>
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<input name="submit" type="submit" class="mws-button green" value="Save" />
			</div>
		</form>
	</div>    	
</div>


<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span class="mws-i-24 i-lock-locked">Change Password</span>
	</div>
	<div class="mws-panel-body">
		<?php 
			show_system_msg($positive_msg_change_pw, $error_msg_change_pw, $tip_msg_change_pw); 
		?>
		<form class="mws-form" name="form1" method="post" action="" onSubmit="return validation(this)">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label>Current Password</label>
					<div class="mws-form-item large">
						<input type="password" name="curr_pw" class="mws-textinput" value="" maxlength="50"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>New Password<br>(*at least 6 characters)</label>
					<div class="mws-form-item large">
						<input type="password" name="new_pw1" class="mws-textinput" value="" maxlength="50"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label>New Password Again</label>
					<div class="mws-form-item large">
						<input type="password" name="new_pw2" class="mws-textinput" value="" maxlength="50"/>
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<input name="submit" type="submit" class="mws-button green" value="Change Password" />
			</div>
		</form>
	</div>    	
</div>
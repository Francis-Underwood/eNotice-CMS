<script language='javascript' type="text/javascript">
	function validation(form1) {
		curr_pw = document.form1.curr_pw.value;
		new_pw1 = document.form1.new_pw1.value;
		new_pw2 = document.form1.new_pw2.value;
		
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
			if (!(pw_check_a(new_pw1,6)) && (new_pw1.length > 0)) {
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

<table>
<?php
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )
	{
	$data['curr_pw'] = substr($_POST['curr_pw'],0,50);
	$data['new_pw1'] = substr($_POST['new_pw1'],0,50);
	
	$save_pw_result = Save_acc_pw($data);
	
	switch ($save_pw_result) {
		case "not match":
		?>
		<td><font color="red"><strong>Old Password Not Match, cannot change!!!</strong></font></td>
		<?php 
			break;
		case "succ":
		?>
		<td><font color="blue"><strong>Password saved successfully!!!</strong></font></td>
		<?php 
			break;
		default
		?>
		<td><font color="red"><strong>Saved failed!!!</strong></font></td>
		<?php 
		}
	}
?>
  <form name="form1" method="post" action="" onSubmit="return validation(this)">
	<tr align="left" valign="top">
		<td>Current Password:</td>
	</tr>
	<tr>
		<td><input name="curr_pw" type="password" id="curr_pw" value="" maxlength="50" style="width:360px" /></td>
	</tr>
	<tr>
		<td>New Password (*at least 6 characters) :</td>
	</tr>
	<tr>
		<td><input name="new_pw1" type="password" id="new_pw1" value="" maxlength="50" style="width:360px" /></td>
	</tr>
	<tr>
		<td>New Password Again :</td>
	</tr>
	<tr>
		<td><input name="new_pw2" type="password" id="new_pw2" value="" maxlength="50" style="width:360px" /></td>
	</tr>
	<tr>
		<td align="right" height="50"><input name="submit" type="submit" class="button" id="submit" value="Save" /></td>
	</tr>					
  </form>
</table>
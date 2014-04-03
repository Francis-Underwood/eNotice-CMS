<script language='javascript' type="text/javascript">
	function validation(form1) {
		display_name = document.form1.display_name.value;
		email = document.form1.email.value;
		err_msg = "";
		
		if (display_name.length == 0) {
			err_msg = err_msg + "\n- Your User Name cannot be blanked";
		}

		if (email.length == 0) {
			err_msg = err_msg + "\n- Your Email cannot be blanked";
		}
		
		if ((email.length > 0) && !(echeck(email))) {
			err_msg = err_msg + "\n- Please enter vaild Email";
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
	IF ((isset($_POST['submit'])) && (($_POST['submit']) == "Save") )	{
		$data['display_name'] = substr($_POST['display_name'],0,50);
		$data['email'] = substr($_POST['email'],0,5000);
	
		if (Save_acc_info($data)) { ?>
			<td><font color="blue">Saved</font></td>
			<?php
			}  else  {
			?>
			<td><font color="red"><strong>Saved failed!!!</strong></font></td>
		<?php 
		}
	}
	$acc_data = Select_acc_info();	?>
	<form name="form1" method="post" action="" onSubmit="return validation(this)">
		<tr align="left" valign="top">
			<td>User Name: </td>
		</tr>
		<tr>
			<td><input name="display_name" type="text" id="display_name" value="<?php echo $acc_data['display_name'];?>" maxlength="50" style="width:360px" /></td>
		</tr>
		<tr>
			<td>Email:</td>
		</tr>
		<tr>
			<td><input name="email" type="text" id="email" value="<?php echo $acc_data['email'];?>" maxlength="50" style="width:360px" /></td>
		</tr>
		<tr>
			<td align="right" height="50"><input name="submit" type="submit" class="button" id="submit" value="Save" /></td>
		</tr>					
	</form>
</table>
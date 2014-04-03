<script language='javascript' type="text/javascript">
	function validation(form1) {
		casting_color = document.form1.casting_color.value;
		casting_text = document.form1.casting_text.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		
		if (casting_color.length == 0) {
			err_msg = err_msg + "\n- [ Color of casting ]";
		}
		//if (casting_text.length == 0) {
			//err_msg = err_msg + "\n- [ Text of casting ]";
		//}
		if (err_msg.length > 34) {
			alert(err_msg);
			return false;
		}
		return true;
	}
</script>

<!--<script type="text/javascript">
var myPicker = new jscolor.color(document.getElementById('casting_color'), {})
myPicker.fromString('99FF33')  // now you can access API via 'myPicker' variable
</script>-->

<table width="580">
	<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?>  </tr>
	<form name="form1" method="post" action="" onSubmit="return validation(this)">
		<tr align="left" valign="top">
			<td width="100">Text Color: </td>
			<td>
				<select name="casting_color" id="casting_color" style="width:160px">
					<option value=''></option>
					<?php echo get_casting_color_to_cbo($casting_data['casting_color']); ?>
				</select>
				<!--Text Color: 
				<input name="casting_color" id="casting_color" />-->
			</td>
		</tr>
		<tr>
			<td valign="center">Casting Text</td>
			<!--<td><textarea cols="55" rows="8" name="casting_text" onkeypress="if(event.keyCode==13){return false;}"><?php echo ($casting_data['casting_text']);?></textarea></td>-->
			<td><textarea cols="55" rows="8" name="casting_text"><?php echo ($casting_data['casting_text']);?></textarea></td>
		</tr>
		<tr align="right" height="50">
			<td colspan="2"><input name="submit" type="submit" class="button" id="submit" value="Save" /></td>
		</tr>					
	</form>
</table>
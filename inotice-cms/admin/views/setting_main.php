<script type="text/javascript">
	function validation(form1) {
		company_title = document.form1.company_title.value;
		err_msg = "Below item(s) cannot be blanked :\n";
		
		//if (company_title.length == 0) {
			//err_msg = err_msg + "\n- [ Company Title ]";
		//}
	
		if (err_msg.length > 34) {
			alert(err_msg);
			return false;
		}
		return true;
	}
	
</script>
<div id="content">
	<table border="0" width="780">
	  <tr>
		<td class="cell_2color" colspan="2" valign="top"><strong><font size="+2">Setting</font></strong></td>
	  </tr>
	</table>

	<table>
		<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?></tr>
	</table>
	<table border="1" width="780">

	<form name="form1" id="form1" method="post" action="" onSubmit="return validation(this)">
	  <tr>
		<td bgcolor="#DEDEDE" width="156" valign="top" height="25"><strong>Heading (Max 20)</strong></td>
		<td bgcolor="#BAC7CE" width="234" valign="middle">
			<input type="text" name="company_title" maxlength="20" value="<?php echo $config_title_data['company_title'];?>" style="width:170px">
		</td>
		<td bgcolor="#DEDEDE" width="156" valign="top"><strong>Heading Colour</strong></td>
		<td bgcolor="#BAC7CE" width="234" valign="middle">
			<select name="company_title_color" id="company_title_color" style="width:80px">
				<?php echo get_basic_color_to_cbo($config_title_data['company_title_color']); ?>
			</select>
		</td>
	  </tr>
	  <tr>
		<td bgcolor="#DEDEDE" width="156" valign="top" height="25"><strong>Subtitle (Max 50)</strong></td>
		<td bgcolor="#BAC7CE" width="234" valign="middle">
			<input type="text" name="company_subtitle" maxlength="50" value="<?php echo $config_title_data['company_subtitle'];?>" style="width:200px">
		</td>
		<td bgcolor="#DEDEDE" width="156" valign="top"><strong>Subtitle Colour</strong></td>
		<td bgcolor="#BAC7CE" width="234" valign="middle">
			<select name="company_subtitle_color" id="company_subtitle_color" style="width:80px">
				<?php echo get_basic_color_to_cbo($config_title_data['company_subtitle_color']); ?>
			</select>
		</td>
	  </tr>
	  <tr>
		<td bgcolor="#DEDEDE" width="156" valign="top" height="25"><strong>Current Time Colour</strong></td>
		<td bgcolor="#BAC7CE" width="234" valign="middle">
			<select name="curr_time_color" id="curr_time_color" style="width:80px">
				<?php echo get_basic_color_to_cbo($config_title_data['curr_time_color']); ?>
			</select>
		</td>
		<td bgcolor="#DEDEDE" width="156" valign="top" height="25"><strong>Temperature Colour</strong></td>
		<td bgcolor="#BAC7CE" width="234" valign="middle">
			<select name="weather_temp_color" id="weather_temp_color" style="width:80px">
				<?php echo get_basic_color_to_cbo($config_title_data['weather_temp_color']); ?>
			</select>
		</td>
	  </tr>
	  <tr>
		<td bgcolor="#DEDEDE" width="156" valign="top" height="30"><strong>Banner Type</strong></td>
		<td bgcolor="#BAC7CE" width="234" valign="middle">
			<label for="banner_type_i"><input type="radio" id="banner_type_i" name="banner_type" value="i" <?php echo ($config_title_data['banner_type'] == "i")?"checked":"";?>>Image</label>
			<label for="banner_type_v"><input type="radio" id="banner_type_v" name="banner_type" value="v" <?php echo ($config_title_data['banner_type'] == "v")?"checked":"";?>>Video</label>
		</td>
		<td bgcolor="#DEDEDE" width="156" valign="top" height="30">&nbsp;</td>
		<td bgcolor="#BAC7CE" width="234" valign="middle">&nbsp;</td>
	  </tr>
	  <tr>
		<td bgcolor="#DEDEDE" valign="middle" align="right" height="40" colspan="4">
			<input name="submit" type="submit" class="button" id="submit" value="Save" />	
		</td>
	  </tr>
	</form>
	</table>
	</br>
	<table border="1" width="780">
	<!--Logo-->
	  <tr>
		<td bgcolor="#DEDEDE" width="156" valign="top"><strong>Company Logo<br>(Min <?php echo $config_data['logo']['best_resolution_text'];?>)</strong></td>
		<td bgcolor="#BAC7CE" width="564" valign="top">
			<?php 
				$img = $company_logo_image['image'][0];
				output_image($img,$config_data['logo']['display_width'],0,"",""); 
				show_scissor($img,$config_data['logo']['display_width'],"logo",-1,-1,"Error img!"); 
			?>
		</td>
		<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
			<a href="main.php?page=setting_image_edit&subject=logo"><img src="images/icons/edit.png" width="20"></a>
		</td>
		<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
			<?php if (!($company_logo_image['no_image'][0])) {?>
			 <a href="#" onclick="decision('Are you sure delete?','main.php?page=setting_main&subject=logo&action=del')">
				<img src="images/icons/remove.png" width="20">
			 </a>
			<?php } ?>
		</td>
	  </tr>
	 <!--Background-->
	  <tr>
		<td bgcolor="#DEDEDE" width="156" valign="top"><strong>Background<br>(Min <?php echo $config_data['bg']['best_resolution_text'];?>)</strong></td>
		<td bgcolor="#BAC7CE" width="564" valign="top">
			<?php 
				$img = $background_image['image'][0];
				output_image($img,$config_data['bg']['display_width'],0,"",""); 
				show_scissor($img,$config_data['bg']['display_width'],"bg",-1,-1,"Error img!"); 
			?>
		</td>
		<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
			<a href="main.php?page=setting_image_edit&subject=bg"><img src="images/icons/edit.png" width="20"></a>
		</td>
		<td bgcolor="#BAC7CE" width="30" valign="top" align="center">
			<?php if (!($background_image['no_image'][0])) {?>
			 <a href="#" onclick="decision('Are you sure delete?','main.php?page=setting_main&subject=bg&action=del')">
				<img src="images/icons/remove.png" width="20">
			 </a>
			<?php } ?>
		</td>
	  </tr>
	</table>
	</br>

	<!--Menu Icon-->
	<table border="1" width="780">
		  <tr>
			<td bgcolor="#DEDEDE" height="30" valign="middle" colspan="15"><strong><font size="+0">Menu Icons (Min <?php echo $config_data['menu_icons']['best_resolution_text'];?>)</font></strong>
			<!--<img src="images/icons/add_table.png" width="20">
				<a href="main.php?page=setting_image_edit&subject=menu_icons_add&id=-1"><img src="images/icons/add_table.png" width="20"></a>-->
			</td>
		  </tr>

		<?php if (($menu_icon_count) > 0) { ?>
		  <tr>	
		 <?php for ($i = 0; $i <= ($menu_icon_count - 1); $i++) {  ?>
		   <td width="260">
			<table width="100%" border="1">
			  <tr height="82">
				<td bgcolor="#BAC7CE" valign="top" width="47">
				<?php 
					echo $menu_icon_data['id'][$i]."<br>";
					if ($menu_icon_data['fun'][$i] == 1) {
						echo "<img src=\"images/icons/icon_arm.png\" width=\"25\">";
					}
				?>
				</td>
				<td bgcolor="#BAC7CE" valign="top" width="171">
				<?php 
					$img = $menu_icon_data['image'][$i];
					output_image($img,$config_data['menu_icons']['display_width'],0,"",""); 
					show_scissor($img,$config_data['menu_icons']['display_width'],"menu_icons",$menu_icon_data['id'][$i],-1,"Error img!"); 
				?>
				</td>
				<td bgcolor="#BAC7CE" valign="top" width="21" align="center">
					<a href="main.php?page=setting_image_edit&subject=menu_icons&id=<?php echo $menu_icon_data['id'][$i]; ?>"><img src="images/icons/edit.png" width="20"></a>
				</td>
				<td bgcolor="#BAC7CE" valign="top" width="21" align="center">
				<?php if (!($menu_icon_data['no_image'][$i])) {?>
				<a href="#" onclick="decision('Are you sure delete?','main.php?page=setting_main&subject=menu_icons&action=del&id=<?php echo $menu_icon_data['id'][$i]; ?>')">
					<img src="images/icons/remove.png" width="20">
				</a>
				<?php } ?>
				</td>
			  </tr>
			  <tr>
				<td bgcolor="#BAC7CE" colspan="4" align="center"><?php echo $menu_icon_data['label'][$i]; ?>&nbsp;</td>
			  </tr>
			</table>
		  </td>
		  <?php
			if ((($i+1) % 3) == 0) echo "</tr> <tr>";
			} ?>
		  </tr>	
		<?php
		}
		?>
	</table>
	</br></br>
</div>
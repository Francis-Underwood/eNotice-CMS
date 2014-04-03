<div id="content">
	<table width="0" border="0" cellspacing="5" cellpadding="0" width="780">
	  <tr>
		<td bgcolor="#DEDEDE" width="176" valign="top">
		<?php 
		   require_once('acc_menu.php');
		?>
		</td>
		<td bgcolor="#BAC7CE" width="604" valign="top">
			<table>
				<tr height="50">
					<td valign="top" class="cell_2color">
						<Strong><font size="+2"><?php echo $control_page_title;?></font></Strong>
					</td>
				</tr>
				<tr>
				<?php 
				  if (isset($_REQUEST["cpage"])) {
						Template($_REQUEST["cpage"]);
					}
					else
					{ 
						?>
						  <!--<td valign="top">
								Account Management. Please choose from the left side menu.
						  </td>-->
						<?
					}
				?>
				</tr>
			</table>
		</td>
	  </tr>
	</table>
</div>
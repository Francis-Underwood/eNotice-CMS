<script language='javascript' type="text/javascript">

</script>
<table>
	<tr><?php show_msg($positive_msg, $error_msg, $tip_msg);?>  </tr>
</table>
<table width="100%">
	<tr align="center">
		<td>&nbsp;</td>
		<td width="120" style="background-color:#DDDDDD;color:white;">
			<font size="+1"><a href="main.php?page=control_main&cpage=control_gallery_edit">Add Album</a></font>
		</td>
	</tr>
</table>
</br>
<div align="right"><strong>Total Gallery Albums: <?php echo $gallery_album_count; ?>&nbsp;</strong></div>
<table id="table-4">
	<thead>
		<th width="15">Item </th>
		<th width="180">Date</th>
		<th width="255">Album</th>
		<th width="40">Cover</th>
		<th width="50">Delete</th>
	</thead>
	
	<?php 
	if (($gallery_album_count) > 0) {
	  for ($i = 0; $i <= ($gallery_album_count - 1); $i++) {
	
		$gallery_album_photos_count = Count_gallery_photo($gallery_album_data['id'][$i], -1); ?>
	   <tr height="50">
		<td valign="center"><font color="#000000"><?php echo $i+1; ?></font></td>
		<td><font color="#000000"><?php echo $gallery_album_data['xdate_str'][$i]; ?></font></td>
		<td>
			<font color="#000000">
				<a title="<?php echo $gallery_album_photos_count; ?> photo(s)" href="main.php?page=control_main&cpage=control_gallery_edit&aid=<?php echo $gallery_album_data['id'][$i]; ?>" >
					<?php echo $gallery_album_data['title'][$i]; ?>
				</a>
			</font>
		</td>
		<td>
			<a title="Edit" href="main.php?page=control_main&cpage=control_gallery_edit&aid=<?php echo $gallery_album_data['id'][$i]; ?>" >
				<?php output_image($config_data['folder']."/cover/".$gallery_album_data['cover'][$i],60,0,"","Cover Err!"); ?>
			</a>
		</td>
		<td align="center">
			<a href="#" onclick="decision('Are you sure delete? \n <?php echo ($gallery_album_photos_count >0 )?$gallery_album_photos_count." photo(s) in this album will be deleted!!!!":""; ?>','main.php?page=control_main&cpage=control_gallery_list&action=del&id=<?php echo $gallery_album_data['id'][$i]; ?>')">
				<img src="images/icons/remove.png" border="0" alt="Delete Album" />
			</a>
		</td>

		</tr>
	<?php 
	  }
	}
	else
	{ ?>
	<tr>
		<td valign="center" colspan="4"><font color="RED">No Gallery Album Found!!!!</font></td>
	</tr>
	<?php }
	?>
</table>
<br><br><br>
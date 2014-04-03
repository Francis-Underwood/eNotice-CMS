<?php 
$config_data = upload_file_config("gallery",-1);
?>
<script language='javascript' type="text/javascript">

</script>

<?php
	IF ((isset($_GET['action'])) && (($_GET['action']) == "del") && (isset($_GET['id'])) )
	{
	if (del_gallery_album($_GET['id'])) {
	 ?>
		<font color="blue">Album Deleted</font>
	 <?php
	 }  else  {
	 ?>
		<font color="red"><strong>Album delete failed!!!</strong></font>
	 <?php 
	 }
	}
	$gallery_album_count = Count_gallery_album(-1);
	$gallery_album_data = Select_gallery_album(-1);

?>
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
		<th width="205">Album</th>
		<th width="40">Cover</th>
		<th width="50">Delete</th>
		<th width="50">Edit</th>
	</thead>
	
	<?php 
	if (($gallery_album_count) > 0) {
	for ($i = 0; $i <= ($gallery_album_count - 1); $i++) {
	
	$gallery_album_photos_count = Count_gallery_photo($gallery_album_data['id'][$i], -1);
	?>
   <tr height="50">
	<td valign="center"><font color="#000000"><?php echo $gallery_album_data['id'][$i]; ?></font></td>
	<td><font color="#000000"><?php echo $gallery_album_data['xdate_str'][$i]; ?></font></td>
	<td>
		<font color="#000000">
			<a title="<?php echo $gallery_album_photos_count; ?> photo(s)" href="main.php?page=control_main&cpage=control_gallery_edit&aid=<?php echo $gallery_album_data['id'][$i]; ?>" >
				<?php echo $gallery_album_data['title'][$i]; ?>
			</a>
		</font>
	</td>
	<td>
		<?php output_image($config_data['folder']."/cover/".$gallery_album_data['cover'][$i],60,0,"","Cover!"); ?>
	</td>
	<td align="center">
		<a href="#" onclick="decision('Are you sure delete? \n <?php echo ($gallery_album_photos_count >0 )?$gallery_album_photos_count." photo(s) in this album will be deleted!!!!":""; ?>','main.php?page=control_main&cpage=control_gallery_list&action=del&id=<?php echo $gallery_album_data['id'][$i]; ?>')">
			<img src="images/icons/remove.png" border="0" alt="Delete Album" />
		</a>
	</td>
	<td align="center">
		<a href="main.php?page=control_main&cpage=control_gallery_edit&aid=<?php echo $gallery_album_data['id'][$i]; ?>" >
			<img src="images/icons/edit.png" border="0" alt="Edit" />
		</a>
	</td>

	</tr>
	<?php }
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
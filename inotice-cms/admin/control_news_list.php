<script language='javascript' type="text/javascript">

</script>

<table width="100%">
	<tr align="center">
		<td>&nbsp;</td>
		<td width="120" style="background-color:#DDDDDD;color:white;">
			<font size="+1"><a href="main.php?page=control_main&cpage=control_news_edit">Add News</a></font>
		</td>
	</tr>
</table>
</br>
<?php
	IF ((isset($_REQUEST['action'])) && (($_REQUEST['action']) == "del") && (isset($_REQUEST['id'])) )
	{
	if (del_news($_REQUEST['id'])) {
	 ?>
		<font color="blue">News Deleted</font>
	 <?php
	 }  else  {
	 ?>
		<font color="red"><strong>News delete failed!!!</strong></font>
	 <?php 
	 }
	}
	$news_count = Count_news(-1);
	$news_data = Select_news(-1);
?>

<table id="table-4">
	<thead>
		<th width="19">Item </th>
		<th width="101">Date </th>
		<th width="400">News Title</th>
		<th width="40">Delete</th>
	</thead>
	
	<?php 
	if (($news_count) > 0) {
	for ($i = 0; $i <= ($news_count - 1); $i++) {?>
	<tr>
		<td valign="center"><font color="#000000"><?php echo $news_data['id'][$i]; ?></font></td>
		<td><font color="#000000"><?php echo $news_data['xdate_str'][$i]; ?></font></td>
		<td>
			<?php echo "<a href='main.php?page=control_main&cpage=control_news_edit&action=edit&news_id=".$news_data['id'][$i]."'>".mb_substr($news_data['title'][$i], 0, 20, 'UTF-8')."</a>"; ?>
		</td>
		<td align="center">
			<a href="#" onclick="decision('Are you sure delete?','main.php?page=control_main&cpage=control_news_list&action=del&id=<?php echo $news_data['id'][$i]; ?>')">
				<img src="images/icons/remove.png" border="0" alt="Delete this news" />
			</a>
		</td>
	</tr>
	<?php }
	}
	else
	{ ?>
	<tr>
		<td valign="center" colspan="4"><font color="RED">No News Found!!!!</font></td>
	</tr>
	<?php }
	?>
</table>
<br><br><br>
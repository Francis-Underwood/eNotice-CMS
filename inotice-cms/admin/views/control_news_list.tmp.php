<!-- Panel Container -->
<div class="mws-panel grid_8">
	<!-- Panel Header -->
	<div class="mws-panel-header">
		<span class="mws-i-24 i-list-images">News Listing</span>
	</div>
	<!-- End Panel Header -->
	
	<!-- Panel Body -->
	<div class="mws-panel-body">
		
		<div class="mws-panel-toolbar top clearfix">
			<ul>
				<li><a href="main.php?page=control_news_edit" class="mws-ic-16 ic-add">Add News</a></li>
			</ul>
		</div>
		
		<!-- Message -->
		<?php show_system_msg($positive_msg, $error_msg, $tip_msg); ?>
		<?php //if (($news_count) == 0)  show_system_msg("", "", "No News Found!!!!");?>
		<!-- End Message -->
		
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th width="5%">&nbsp;</th>
					<th width="20%">Date</th>
					<th width="45%">News Title</th>
					<th width="15%">&nbsp;</th>
					<th width="15%">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				if (($news_count) > 0) 
				{
					for ($i = 0; $i <= ($news_count - 1); $i++) 
					{ 
						$news_headline = mb_substr($news_data['title'][$i], 0, 20, 'UTF-8');
			?>
				<tr class="gradeC">
					<td><?php echo $i + 1; ?></td>
					<td><?php echo $news_data['xdate_str'][$i]; ?></td>
					<td><?php echo $news_headline; ?></td>
					<td>
						<a href='main.php?page=control_news_edit&action=edit&news_id=<?php echo $news_data['id'][$i]; ?>'>
							<img src="mws-admin/css/icons/16/edit.png" width="20">
						</a>
					</td>
					<td>
						<a href="#" onclick="decision('Are you sure delete the news: \n [ <?php echo $news_headline; ?> ]?','main.php?page=control_news_list&action=del&id=<?php echo $news_data['id'][$i]; ?>')">
							<img src="mws-admin/css/icons/32/cross.png" border="0" alt="Delete this news" width="20">
						</a>
					</td>
				</tr>
			<?php 
					}
				}
				else
				{ 
			?>
				<!--<tr>
					<td valign="center"><span style="color: red">No News Found!!!!</span></td>
					<td valign="center"></td><td valign="center"></td><td valign="center"></td>
				</tr>-->
			<?php 
				}
			?>
			</tbody>
		</table>
	</div>
</div>
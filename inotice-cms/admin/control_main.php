<div id="content">
<table width="0" border="0" cellspacing="5" cellpadding="0" width="780">
  <tr>
	<td bgcolor="#DEDEDE" width="156" valign="top">
	<?php 
	   require_once('control_menu.php');
	?>
	</td>
	<td bgcolor="#BAC7CE" width="624" valign="top">
		<table>
			<?php
				switch ($_REQUEST["cpage"]){
					case "control_banner_img_list":
					$control_page_title = "Cover Banner";
						break;
					case "control_banner_img_edit":
					$control_page_title = "Cover Banner Image Config Edit";
						break;
					case "control_banner_video_list":
					$control_page_title = "Cover Video";
						break;
					case "control_banner_video_edit":
					$control_page_title = "Cover Banner Video Config Edit";
						break;
					case "control_casting":
					$control_page_title = "Banner Casting";
						break;
					case "control_about_us":
					$control_page_title = "About Us";
						break;
					case "control_news_list":
					$control_page_title = "News Listing";
						break;
					case "control_news_edit":
					$control_page_title = "News Editor";
						break;
					case "control_gallery_list":
					$control_page_title = "Gallery Album Listing";
						break;
					case "control_gallery_edit":
					$control_page_title = "Gallery Album";
						break;
					case "control_gallery_img_edit":
					$control_page_title = "Album Photo Info";
						break;
					case "control_movie_gallery_list":
					$control_page_title = "Movie Gallery Listing";
						break;
					case "control_movie_gallery_edit":
					$control_page_title = "Movie Gallery Config Edit";
						break;
					default:
					$control_page_title = "Welcome";
				}
			?>
			<tr height="50">
				<td valign="top" class="cell_2color"><Strong><font size="+2"><?php echo $control_page_title;?></font></Strong></td>
			</tr>
			<tr>
			<?php 
			if (isset($_REQUEST["cpage"])) {
				Template($_REQUEST["cpage"]);
			}
			else
			{ 
			?>
			  <td valign="top">Welcome to the Control Panel. Please choose from the left side menu.</td>		
			<?
			}
			?>
			</tr>
		
		</table>
	</td>
  </tr>
</table>
</div>

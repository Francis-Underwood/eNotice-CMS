<?php
require_once('app.php');

$news_count = Count_news(-1);
$news_data = Select_news(-1);
	
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<news>\n";
	if (($news_count) > 0) {
		for ($i = 0; $i <= ($news_count - 1); $i++) {
			$news_id = $news_data['id'][$i];
			echo "	<item>\n";
			echo "		<id>".$news_id."</id>\n";
			
			$news_img_count = Count_images("news",-1,$news_id);
			$news_img_data = Select_images("news",-1,$news_id);
			if (($news_img_count) > 0) { 
				 for ($j = 0; $j <= ($news_img_count - 1); $j++) { 
					$file_info = pathinfo($news_img_data['image'][$j]);
					echo "		<big>".$file_info['basename']."</big>\n";
					echo "		<thumb>".$file_info['basename']."</thumb>\n";
				}
			}
			echo "		<date>".$news_data['xdate_str'][$i]."</date>\n";
			echo "		<title>".$news_data['title'][$i]."</title>\n";
			echo "		<summary>".nl2br($news_data['summary'][$i])."</summary>\n";
			echo "		<content><![CDATA[".nl2br($news_data['content'][$i])."]]></content>\n";
			echo "	</item>\n";
		}
	}
echo "</news>\n";

?>
<?php
require_once('app.php');

$banner_video_count = Count_banner_video(-1);
$banner_video_data = Select_banner_video(-1);

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<playlist>\n";

	if (($banner_video_count) > 0) {  	
	 for ($i = 0; $i <= ($banner_video_count - 1); $i++) {
		echo "	<video>\n";
		echo "		<id>".$banner_video_data['id'][$i]."</id>\n";
		echo "		<title>".$banner_video_data['title'][$i]."</title>\n";
		echo "		<link>".$banner_video_data['link'][$i]."</link>\n";
		echo "		<thumb>".$banner_video_data['thumb'][$i]."</thumb>\n";
		echo "		<aspect>\n";
		echo "			<option>".$banner_video_data['aspect_option'][$i]."</option>\n";
		echo "			<width>".$banner_video_data['aspect_width'][$i]."</width>\n";
		echo "			<height>".$banner_video_data['aspect_height'][$i]."</height>\n";
		echo "		</aspect>\n";
		echo "	</video>\n";
	 }
	}
echo "</playlist>\n";

?>
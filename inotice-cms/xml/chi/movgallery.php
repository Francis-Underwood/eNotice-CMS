<?php
require_once('app.php');

//List out all Movie Gallery
$movie_gallery_count = Count_movie_gallery(-1);
$movie_gallery_data = Select_movie_gallery(-1);


echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<movies>\n";
	if (($movie_gallery_count) > 0) {  ?>
	<?php for ($i = 0; $i <= ($movie_gallery_count - 1); $i++) {
		echo "  <movie>\n";
		echo "		<id>".$movie_gallery_data['id'][$i]."</id>\n";
		echo "		<title>".$movie_gallery_data['title'][$i]."</title>\n";
		echo "		<date>".$movie_gallery_data['cr_time_long'][$i]."</date>\n";
		echo "		<date_str>".$movie_gallery_data['cr_time'][$i]."</date_str>\n";
		echo "		<thumb>".$movie_gallery_data['thumb'][$i]."</thumb>\n";
		echo "		<link>".$movie_gallery_data['link'][$i]."</link>\n";
		echo "		<aspect>\n";
		echo "			<option>".$movie_gallery_data['aspect_option'][$i]."</option>\n";
		echo "			<width>".$movie_gallery_data['aspect_width'][$i]."</width>\n";
		echo "			<height>".$movie_gallery_data['aspect_height'][$i]."</height>\n";
		echo "		</aspect>\n";
		echo "	</movie>\n";
	}
  }
echo "</movies>\n";
?>
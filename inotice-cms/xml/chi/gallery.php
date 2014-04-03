<?php
require_once('app.php');

//Delete the empty Album(s) firstly
del_empty_gallery_album();
//List Out All Albums
$gallery_album_count = Count_gallery_album(-1);
$gallery_album_data = Select_gallery_album(-1);

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<albums>\n";

if (($gallery_album_count) > 0) {
  for ($i = 0; $i <= ($gallery_album_count - 1); $i++) {
	$aid = $gallery_album_data['id'][$i];
	//List All Photos in a Album
	$gallery_photo_count = Count_gallery_photo($aid, -1);
	$gallery_photo_data = Select_gallery_photo($aid, -1);
	
	//Don't show the album if there are no photo in this album        <--already deleted the no photo album(s)
	//if ($gallery_photo_count > 0)  {
		echo "<album>\n";
		echo "	<id>".$aid."</id>\n";
		
		$gallery_album_cover_image = Select_gallery_album_cover($aid);
		$file_info = pathinfo($gallery_album_cover_image);
		echo "	<cover>".$file_info['basename']."</cover>\n";
		
		echo "	<title>".$gallery_album_data['title'][$i]."</title>\n";
		echo "	<date>".$gallery_album_data['xdate_str'][$i]."</date>\n";
		echo "	<photos>\n";
			$gallery_photo_count = Count_gallery_photo($aid, -1);
			$gallery_photo_data = Select_gallery_photo($aid, -1);
				
			if (($gallery_photo_count) > 0) {  	
				for ($j = 0; $j <= ($gallery_photo_count - 1); $j++) {
					echo "		<photo>\n";
					echo "			<tid>".$gallery_photo_data['id'][$j]."</tid>\n";
					echo "			<title>".$gallery_photo_data['title'][$j]."</title>\n";
					echo "			<description><![CDATA[".$gallery_photo_data['description'][$j]."]]></description>\n";
					
					$file_info = pathinfo($gallery_photo_data['image'][$j]);
					echo "			<thumb>".$file_info['basename']."</thumb>\n";
					echo "			<big>".$file_info['basename']."</big>\n";
					echo "		</photo>\n";
				}
			}
		echo "	</photos>\n";
	  echo "</album>\n";
	//}
 }
}
echo "</albums>\n";
?>
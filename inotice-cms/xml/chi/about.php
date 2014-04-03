<?php
require_once('app.php');

$config_data = upload_file_config("about_us",-1);
$about_us_data = Select_about_us();

$about_us_img_count = Count_images("about_us",-1,0);
$about_us_img_data = Select_images("about_us",-1,0);


echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?> \n\n";
echo "<about>\n";
echo "<text><![CDATA[".to_normal_size($about_us_data['about_us_desc'])."]]></text> \n";
for ($i = 0; $i <= ($about_us_img_count - 1); $i++) {

	$file_info = pathinfo($about_us_img_data['image'][$i]);
	echo "<photo>".$file_info['basename']."</photo> \n";
}  
echo "</about>\n";
?>


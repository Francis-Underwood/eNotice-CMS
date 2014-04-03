<?php
require_once('app.php');

$config_data = upload_file_config("banner_image",-1);

$banner_image_count = Count_banner_image(-1);
$banner_image_data = Select_banner_image(-1);

$config_str = banner_flv_config();
$config_arr = explode("|", $config_str);
$config_text = "";

for ($i = 0; $i <= (count($config_arr) - 1); $i++) {
	$config_text .= $config_arr[$i]." ";
}  

echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?> \n\n";
echo "<photos>\n";
echo "<config ".$config_text."></config> \n";

for ($i = 0; $i <= ($banner_image_count - 1); $i++) {
	echo "<photo>\n";
	echo "	<id>".$banner_image_data['id'][$i]."</id> \n";
	echo "	<filename>".$banner_image_data['image'][$i]."</filename> \n";
	echo "	<transition flow=\"".$banner_image_data['transition_flow'][$i]."\" direction=\"".$banner_image_data['transition_direction'][$i]."\"></transition> \n";
	echo "</photo>\n";
}  
echo "</photos>\n";
?>

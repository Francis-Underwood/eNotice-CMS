<?php
require_once('app.php');

$casting_text = Select_casting();
$casting_location = Select_casting_location();

//Take Heading, subtitle & banner Type
$config_title_data = Select_config_title();

//Take Company Logo
$company_logo_image = Select_images("logo",-1,0);

//Take Background
$background_image = Select_images("bg",-1,0); 

//Take Menu Icons
$menu_icon_count = Count_images("menu_icons",-1,0);
$menu_icon_data = Select_images("menu_icons",-1,0);

//-----------------------------------------------------------------------
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<configs>\n";

$file_info = pathinfo($company_logo_image['image'][0]);
echo "  <logo>".$file_info['basename']."</logo>\n";

echo "  <title><![CDATA[".$config_title_data['company_title']."]]></title>\n";

echo "  <subtitle><![CDATA[".$config_title_data['company_subtitle']."]]></subtitle>\n";

$file_info = pathinfo($background_image['image'][0]);
echo "  <background>".$file_info['basename']."</background>\n";

echo "  <banner>".$config_title_data['banner_type']."</banner>\n";

echo "  <menuitems>\n";
if (($menu_icon_count) > 0) { 
	for ($i = 0; $i <= ($menu_icon_count - 1); $i++) {  
		echo "    <menuitem>\n";
		echo "      <id>".$menu_icon_data['id'][$i]."</id>\n";
		echo "      <fun>".$menu_icon_data['fun'][$i]."</fun>\n";
		echo "      <label>".$menu_icon_data['label'][$i]."</label>\n";
		echo "      <module>".$menu_icon_data['module'][$i]."</module>\n";
		echo "      <xmllink>".$menu_icon_data['xmllink'][$i]."</xmllink>\n";
		$file_info = pathinfo($menu_icon_data['image'][$i]);
		echo "      <background>".$file_info['basename']."</background>\n";
		echo "    </menuitem>\n";
	}
}
echo "  </menuitems>\n";
echo "</configs>\n";

?>

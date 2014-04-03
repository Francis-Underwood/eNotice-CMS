<?php
require_once('app.php');

$casting_text = Select_casting();
$casting_location = Select_casting_location();

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<message>\n";
echo "	<text><![CDATA[".$casting_text['casting']."]]></text>\n";
echo "	<xstart>".$casting_location['xstart']."</xstart>\n";
echo "	<xend>".$casting_location['xend']."</xend>\n";
echo "	<ystart>".$casting_location['ystart']."</ystart>\n";
echo "</message>";

?>
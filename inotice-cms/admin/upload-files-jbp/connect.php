<?php

//connect to the database
$hostname_site = "localhost";
$database_site = "test";
$username_site = "root";
$password_site = "";
$site = mysql_pconnect($hostname_site, $username_site, $password_site) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db($database_site, $site);
//

//general recordset function
function record_set($name,$query) {

global $site;
global ${"query_$name"};
global ${"$name"};
global ${"row_$name"};
global ${"totalRows_$name"};

	${"query_$name"} = "$query";
	${"$name"} = mysql_query(${"query_$name"},$site) or die(mysql_error());
	${"row_$name"} = mysql_fetch_assoc(${"$name"});
	${"totalRows_$name"} = mysql_num_rows(${"$name"});

}
//


?>
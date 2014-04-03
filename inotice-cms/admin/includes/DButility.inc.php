<?php
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

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}


function GetID($StrValue, $tbName, $strColName) 
{
  IF($StrValue != "NULL") 
  {
  	//take the first value
  	$temp = spliti("==>", $StrValue, 5);
	$StrValue = $temp[0];
	//Find is exist
  	$theID = 0;
	$query = "SELECT id FROM ".$database_cnforum.".".$tbName." WHERE ".$strColName."=".$StrValue." LIMIT 1";
	$query_result = mysql_query ($query) or die(mysql_error());
	while ($info = mysql_fetch_array($query_result))
	{  $theID = $info['id'];  }
	
	IF($theID !=0 )
		return $theID;    //Found
	ELSE
		{
			//No record found, Insert a new record and take ID
			$insertSQL = "INSERT INTO ".$database_cnforum.".".$tbName." (`".$strColName."`) VALUES (".$StrValue.")";
			//mysql_select_db($database_cnforum, $cnforum);
			//$Result1 = mysql_query($insertSQL, $cnforum) or die(mysql_error());
			$Result1 = mysql_query($insertSQL) or die(mysql_error());
			//Find ID again
				$query = "SELECT id FROM ".$database_cnforum.".".$tbName." WHERE ".$strColName."=".$StrValue." LIMIT 1";
				$query_result = mysql_query ($query) or die(mysql_error());
				while ($info = mysql_fetch_array($query_result))
				{
					$theID = $info['id'];
				}
		
				IF($theID !=0 )
					return $theID;
				ELSE
					return "NULL";
		}
  }
  Else
    return $StrValue;
}

function FindRdExist($tbName, $whereCase) 
{
	//Find is exist
  	$rowExist = 0;
	$query = "SELECT * FROM ".$database_cnforum.".".$tbName." WHERE ".$whereCase." LIMIT 1";
	$query_result = mysql_query ($query) or die(mysql_error());
	while ($info = mysql_fetch_array($query_result))
	{
		$rowExist = 1; //Exist
	}
	return $rowExist;
}

?>
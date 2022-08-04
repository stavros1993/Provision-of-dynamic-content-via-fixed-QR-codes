<html><head><meta http-equiv="Content-Type" content="text/xml; charset=utf-8"/> </head>
<?php
require("phpsqlajax_dbinfo.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);

return $xmlStr;
}

// Opens a connection to a MySQL server

$connection=mysql_connect ('localhost', $username1, $password1);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
//$query("SET names,content 'utf8'", $connection);

$query = "SELECT * FROM demo_qr_array1 WHERE 1";
//$mysql_set_character_set($query, "utf8");

mysql_set_charset('utf8');

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';

  echo 'name="' . parseToXML($row['name']) . '" ';
  echo 'content ="' . parseToXML($row['content']) . '" ';
  echo 'type="' . $row['type'] . '" ';
  echo 'longitude="' . $row['longitude'] . '" ';
  echo 'latitude="' . $row['latitude'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';
?>
</html>
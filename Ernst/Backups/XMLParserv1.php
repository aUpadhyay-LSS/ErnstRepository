<?php 
header('Content-type: text/plain'); 
include('Parser_Helper.php'); 
$xml = new Xml; 
 
//print_r($out); 

function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}

echo "Response_Columbia";
echo "\r\n";
$out = $xml->parse('temp.xml', 'FILE');
print_r(search($out, 'LineNumber', '1201'));
echo "\r\n";

/* echo "Response_Adams";
echo "\r\n";
$out = $xml->parse('Response_Adams.xml', 'FILE');
print_r(search($out, 'LineNumber', '1201'));
echo "\r\n";

echo "Response_Albany";
echo "\r\n";
$out = $xml->parse('Response_Albany.xml', 'FILE');
print_r(search($out, 'LineNumber', '1201'));
echo "\r\n"; */

echo "Response_Columbia";
echo "\r\n";
$out = $xml->parse('temp.xml', 'FILE');
print_r(search($out, 'LineNumber', '1203'));
echo "\r\n";

/* echo "Response_Adams";
echo "\r\n";
$out = $xml->parse('Response_Adams.xml', 'FILE');
print_r(search($out, 'LineNumber', '1203'));
echo "\r\n";

echo "Response_Albany";
echo "\r\n";
$out = $xml->parse('Response_Albany.xml', 'FILE');
print_r(search($out, 'LineNumber', '1203'));
echo "\r\n"; */
/* // create the database connection
$con = mysql_connect("127.0.0.1","root","lolzapassword") or die('Could not connect: ' . mysql_error());

$xml_obj = simplexml_load_file('xml.xml');

// init some stuff
$sql    = array();
$fields = array();

// initial name is the table name
$table_name = $xml_obj->getName();

// Create db if one doesn't exist (this is up to you. i use test)
mysql_query('CREATE DATABASE IF NOT EXISTS test');

foreach($xml_obj->children() as $child)
{
  $row = array();
  foreach($child->children() as $child)
  {
    $field = $child->getName(); // grab the name before we convert to string

    $child = trim((string)$child); // converts from SimpleXMLElement and removes extra whitespace
    if($child == '') 
      $child = -1;  // make -1 if empty

    $row[$field] = "'".mysql_real_escape_string($child, $con)."'"; // save the value hooray!

    // fill the field creation array for table creation 
    if(!isset($fields[$field])) $fields[$field] = $field.' text';
  }

  $sql[] = "INSERT INTO test.{$table_name} (".join(',', array_keys($row)).") values (".join(',',array_values($row)).")"; // store the row!
}

// create the table if it doesn't exist already. Since we have no idea what
// format stuff comes in I make them text. If you want to be more specific you can
// check types as best you can and make some assumptions from that.
mysql_query('CREATE TABLE IF NOT EXISTS test.'.$table_name.' ( '. join(',', $fields). ')');

// now we insert. remember, this code assumes that the xml is standard and there's
// no extra nodes or children than expected.
//print_r($sql); // if u want to see the sql commands
foreach($sql as $insert){
  $result = mysql_query($insert, $con);
  if(!$result)
    exit("ZOMG ERROR! ".mysql_error($con));
} */

?>
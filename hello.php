<?php
require_once "database.php";
echo "hello world<br>";
if (array_key_exists('test', $_GET)){
	echo $_GET['test']. '<br>';
 }
echo $db->host_info . "<br>";

$res = $db->query("SELECT * FROM company"); 
while ($row = $res->fetch_assoc()) {
    echo " company name : " . $row['company name']. " - product: " . $row['product']. " - price: " . $row['price'].  "<br>";
}
echo 'Total price =  ' . $result->num_rows;
?>

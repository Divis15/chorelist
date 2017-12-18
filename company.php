<?php
require_once "database.php";
require_once "html.php";
html_open();
echo "<title>Company</title>";
html_body();
echo "<div class='jumbotron'><h1>Comany Products</h1></div>";
if(array_key_exists("id", $_POST)){
	$id = $_POST['id'];
	$company =  $_POST['company name'];
	$product = $_POST['product'];
	updateCompany($id, $company, $product);
} elseif(array_key_exists("id", $_GET)){
	editCompany($_GET["id"]);
} else { 
	viewCompany();
}
function updateCompany($id, $company, $product) {
	global $db;
	$db->query("INSERT INTO users (company name, product) VALUES ('$company', '$product')"); 
	editCompany($id, $company, $product);
}
function editCompany($id) {
	global $db;
	$res = $db->query("SELECT company name, product FROM company"); 
	if ($row = $res->fetch_assoc()) {
		$company =  $row['company name'];
		$product = $row['product'];
		echo "<form method='post'>";
		echo "<input type='hidden' name='id' value='$id'>";
		echo "<input type='text' name='Company' value='$company'>";
		echo "<input type='text' name='Product' value='$product'>";
		echo "<input type='submit' value='Update'>";
		echo "</form>";
	}
	echo "<a href='/users.php'>view all</a>";
}
function viewCompany() {
	global $db;
	$res = $db->query("SELECT * FROM company name"); 
	echo "<table>";
	echo "<tr>";
	echo "<td><h3><u>Company</u></h3></td>";
	echo "<td><h3><u>Product</u></h3></td>";
	echo "<td></td>";
	echo "</tr>";
	while ($row = $res->fetch_assoc()) {
		$id = $row['id'];
		$company =  $row['company name'];
		$product = $row['product'];
		echo "<tr>";
		echo "<td><ul><li>$company</li></ul></td>";
		echo "<td><ul><li>$product</li></ul></td>";
		echo "<td>";
		echo "<a href='/company.php?id=$id'>edit</a>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
html_close();
?>

<?php
require_once "database.php";
require_once "html.php";
html_open();
echo "<title>Company</title>";
html_body();
echo "<div class='jumbotron'><h1>Comany Products</h1></div>";
if(array_key_exists("id", $_POST)){
	$id = $_POST['id'];
	$product = $_POST['product'];
	$price = $_POST['price'];
	if($id){
		if($_POST['delete']){
			deleteCompany($id, $company, $product);
		} else {
			updateCompany($id, $company, $product);
		}
	} else { 
		insertCompany($company, $price);
	}
} elseif(array_key_exists("id", $_GET)){
	$id  = $_GET["id"];
	if($id){
		editCompany($id);
	} else {
		createCompany();
	}
} else { 
	viewCompany();
}
function updateCompany($id, $company, $product) {
	global $db;
	$db->query("INSERT INTO users (company name, product) VALUES ('$company', '$product')"); 
	editCompany($id, $company, $product);
}
function deleteCompany($id) {
	global $db;
	$db->query("DELETE FROM company WHERE id = $id"); 
	viewCompany();
}
function insertCompany($chore, $day) {
	global $db;
	$db->query("INSERT INTO company SET product = '$product', price = '$price'"); 
	$id = $db->insert_id;
	editCompany($id, $company, $product);
}
function editCompany($id) {
			global $db;
?>
<script>
	function deleteChores(){
		document.userForm.delete.value = 1;
		document.userForm.submit();
	}
</script>
<?php
	$res = $db->query("SELECT company name, product FROM company"); 
	if ($row = $res->fetch_assoc()) {
		$company =  $row['company name'];
		$product = $row['product'];
		echo "<form method='post'>";
		echo "<input type='hidden' name='id' value='$id'>";
		echo "<input type='text' name='Company' value='$company'>";
		echo "<input type='text' name='Product' value='$product'>";
		echo "<input type='submit' value='Update' class='btn btn-info btn-sm'>";
		echo "</form>";
	}
	echo "<a href='/company.php' class='btn btn-info btn-sm'>view all</a>";
}
function createProduct() {
	echo "<form method='post'>";
	echo "<input type='hidden' name='id' value='0'>";
	echo "<input type='text' name='product'>";
	echo "<input type='text' name='price'>";
	echo "<input type='submit' value='Add' class='btn btn-primary btn-sm'>";
	echo "</form>";

	echo "<a href='/company.php' class='btn btn-primary btn-sm'>view all</a>";
}
function viewCompany() {
	global $db;
	$res = $db->query("SELECT * FROM company name"); 
	echo "<table class='table table-hover table-striped table-bordered'>";
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
		echo "<a href='/company.php?id=$id' class='btn btn-info btn-sm'>edit</a>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
html_close();
?>

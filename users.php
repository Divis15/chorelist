<?php
require_once "database.php";
if(array_key_exists("id", $_POST)){
	$id = $_POST['id'];
	$name =  $_POST['name'];
	$password = $_POST['password'];
	if($id){
		if($_POST['delete']){
			deleteUser($id);
		} else {
			updateUser($id, $name, $password);
		}
	} else { 
		insertUser($name, $password);
	}
} elseif(array_key_exists("id", $_GET)){
	$id  = $_GET["id"];
	if($id){
		editUser($id);
	} else {
		createUser();
	}
} else { 
	viewUsers();
}
function updateUser($id, $name, $password) {
	global $db;
	$db->query("UPDATE users SET name = '$name', password = '$password' WHERE id = $id"); 
	editUser($id, $name, $password);
}
function deleteUser($id) {
	global $db;
	$db->query("DELETE FROM users WHERE id = $id"); 
	viewUsers();
}
function insertUser($name, $password) {
	global $db;
	$db->query("INSERT INTO users SET name = '$name', password = '$password'"); 
	$id = $db->insert_id;
	editUser($id, $name, $password);
}
function editUser($id) {
	global $db;
?>
<script>
	function deleteUser(){
		document.userForm.delete.value = 1;
		document.userForm.submit();
	}
</script>
<?php
	$res = $db->query("SELECT name, password FROM users WHERE id = $id"); 
	if ($row = $res->fetch_assoc()) {
		$name =  $row['name'];
		$password = $row['password'];
		echo "<form method='post' name='userForm'>";
		echo "<input type='hidden' name='id' value='$id'>";
		echo "<input type='hidden' name='delete' value=''>";
		echo "<input type='text' name='name' value='$name'>";
		echo "<input type='text' name='password' value='$password'>";
		echo "<input type='submit' value='Update'>";
		echo "<input type='button' value='Delete' onclick='deleteUser()'>";
		echo "</form>";
	}
	echo "<a href='/users.php'>view all</a>";
}
function createUser() {
	echo "<form method='post'>";
	echo "<input type='hidden' name='id' value='0'>";
	echo "<input type='text' name='name'>";
	echo "<input type='text' name='password'>";
	echo "<input type='submit' value='Create'>";
	echo "</form>";

	echo "<a href='/users.php'>view all</a>";
}
function viewUsers() {
	global $db;
	$res = $db->query("SELECT * FROM users"); 
	echo "<table>";
	echo "<a href='/users.php?id=0'>create</a>";
	echo "<tr>";
	echo "<td><h3>Username:</h3></td>";
	echo "<td><h3>Password:</h3></td>";
	echo "<td></td>";
	echo "</tr>";
	while ($row = $res->fetch_assoc()) {
		$id = $row['id'];
		$name =  $row['name'];
		$password = $row['password'];
		echo "<tr>";
		echo "<td>$name</td>";
		echo "<td>$password</td>";
		echo "<td>";
		echo "<a href='/users.php?id=$id'>edit</a>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>

<?php
require_once "database.php";
require_once "html.php";
html_open();
echo "<title>Weekly Chorelist</title>";
html_body();
echo "<div class='jumbotron'><h1>Weekly Chorelist</h1></div>";
if(array_key_exists("id", $_POST)){
	$id = $_POST['id'];
	$chore = $_POST['chore'];
	$day = $_POST['day'];
	if($id){
		if($_POST['delete']){
			deleteChores($id, $chore, $day);
		} else {
			updateChores($id, $chore, $day);
		}
	} else { 
		insertChores($chore, $day);
	}
} elseif(array_key_exists("id", $_GET)){
	$id  = $_GET["id"];
	if($id){
		editChores($id);
	} else {
		createChores();
	}
} else { 
	viewChores();
}
function updateChores($id, $chore, $day) {
	global $db;
	$db->query("UPDATE chores SET chore = '$chore', day = '$day' WHERE id = $id"); 
	editChores($id, $chore, $day);
}
function deleteChores($id) {
	global $db;
	$db->query("DELETE FROM chores WHERE id = $id"); 
	viewChores();
}
function insertChores($chore, $day) {
	global $db;
	$db->query("INSERT INTO chores SET chore = '$chore', day = '$day'"); 
	$id = $db->insert_id;
	editChores($id, $chore, $day);
}
function editChores($id) {
			global $db;	
?>
<script>
	function deleteChores(){
		document.userForm.delete.value = 1;
		document.userForm.submit();
	}
</script>
<?php
	$res = $db->query("SELECT chore, day FROM chores WHERE id = $id"); 
	if ($row = $res->fetch_assoc()) {
		$chore =  $row['chore'];
		$day = $row['day'];
		echo "<form method='post' name='userForm'>";
		echo "<input type='hidden' name='id' value='$id'>";
		echo "<input type='hidden' name='delete' value=''>";
		echo "<input type='text' name='chore' value='$chore'>";
		echo "<input type='text' name='day' value='$day'>";
		echo "<input type='submit' value='Update' class='btn btn-primary btn-sm'>";
		echo "<input type='button' value='Delete' onclick='deleteChores()' class='btn btn-primary btn-sm'>";
		echo "</form>";
	}
	echo "<a href='/chorelist.php' class='btn btn-primary btn-sm'>view all</a>";
}
function createChores() {
	echo "<form method='post'>";
	echo "<input type='hidden' name='id' value='0'>";
	echo "<input type='text' name='chore'>";
	echo "<input type='text' name='day'>";
	echo "<input type='submit' value='Add' class='btn btn-primary btn-sm'>";
	echo "</form>";

	echo "<a href='/chorelist.php' class='btn btn-primary btn-sm'>view all</a>";
}
function viewChores() {
	global $db;
	$res = $db->query("SELECT * FROM chores"); 
	echo "<table class='table table-hover table-bordered table-condensed'>";
	echo "<thead>";
	echo "<tr>";
	echo "<td><h4><font color='blue'>Chore:</font></h4></td>";
	echo "<td><h4><font color='blue'>Weekday:</font></h4></td>";
	echo "<td><a href='/chorelist.php?id=0' class='btn btn-info btn-sm'>create</a></td>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	while ($row = $res->fetch_assoc()) {
		$id = $row['id'];
		$chore =  $row['chore'];
		$day = $row['day'];
		echo "<tr>";
		echo "<td class='info'><ul><li>$chore</li></ul></td>";
		echo "<td class=''><ul><li>$day</li></ul></td>";
		echo "<td class='info'>";
		echo "<a href='/chorelist.php?id=$id' class='btn btn-primary btn-sm'>edit</a>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}
html_close();
?>

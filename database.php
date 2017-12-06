<?php
$db = new mysqli("db", "root", "guest", "project");
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
?>

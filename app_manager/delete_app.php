<?php

include "db.php";

// Get the id from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// SQL query to delete the tasks associated with the app
$sql = "DELETE FROM task WHERE app_id = $id";

if ($conn->query($sql) === TRUE) {
  echo "Tasks deleted successfully";
} else {
  echo "Error deleting tasks: " . $conn->error;
}

// SQL query to delete the entries in user_app table associated with the app
$sql = "DELETE FROM user_app WHERE app_id = $id";

if ($conn->query($sql) === TRUE) {
  echo "User_app entries deleted successfully";
} else {
  echo "Error deleting user_app entries: " . $conn->error;
}

// SQL query to delete the app with the given id
$sql = "DELETE FROM app WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  echo "App deleted successfully";
} else {
  echo "Error deleting app: " . $conn->error;
}

$conn->close();

// Redirect to index.php
header("Location: index.php");
exit();
?>

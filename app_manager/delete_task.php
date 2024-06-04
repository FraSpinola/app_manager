<?php

session_start();

include "db.php";

// Get the id from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// SQL query to delete the task with the given id
$sql = "DELETE FROM task WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

header("Location: app.php?id=" . $_SESSION['app_id']);
exit();
?>

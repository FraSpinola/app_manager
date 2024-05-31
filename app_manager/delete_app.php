<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_manager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the id from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// SQL query to delete the tasks associated with the app
$sql = "DELETE FROM task WHERE app_id = $id";

if ($conn->query($sql) === TRUE) {
  echo "Tasks deleted successfully";
} else {
  echo "Error deleting tasks: " . $conn->error;
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

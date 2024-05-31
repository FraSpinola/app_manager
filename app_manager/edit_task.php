<?php
session_start();

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

// Get the id, name, and description from the POST data
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$status = isset($_POST['status']) ? $_POST['status'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

// Print the variables
echo "ID: " . $id . "<br>";
echo "status: " . $status . "<br>";
echo "Description: " . $description . "<br>";

// SQL query to update the task with the given id
$sql = "UPDATE task SET status = ?, description = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $status, $description, $id);

if ($stmt->execute() === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();

// Redirect to the page with all tasks for the current app
header("Location: app.php?id=" . $_SESSION['app_id']);
exit();
?>

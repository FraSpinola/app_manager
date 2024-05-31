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

// Get the id, name, and description from the POST data
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['name']) ? $_POST['name'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

// Print the variables
echo "ID: " . $id . "<br>";
echo "Name: " . $name . "<br>";
echo "Description: " . $description . "<br>";

// SQL query to update the app with the given id
$sql = "UPDATE app SET name = ?, description = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $name, $description, $id);

if ($stmt->execute() === TRUE) {
  echo "Record updated succ essfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();

// Redirect to index.php
header("Location: index.php");
exit();
?>

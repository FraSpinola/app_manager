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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $app_id = $_POST['app_id'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  $sql = "INSERT INTO task (app_id, description, status)
  VALUES ('$app_id', '$description', '$status')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();

header("Location: ../app.php?id=" . $app_id);
exit;
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO app (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);

    // Set parameters and execute
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stmt->execute();

    echo "New record created successfully";

    $stmt->close();
    $conn->close();

    // Redirect to index.php
    header("Location: ../index.php");
    exit;
}
?>

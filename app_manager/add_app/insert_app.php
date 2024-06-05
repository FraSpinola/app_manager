<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "../db.php";

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO app (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);

    // Set parameters and execute
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stmt->execute();

    // Get the id of the newly created app
    $app_id = $stmt->insert_id;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user_app (user_id, app_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $app_id);

    // Set parameters and execute
    $user_id = $_SESSION['id'];
    $stmt->execute();

    echo "New record created successfully";

    $stmt->close();
    $conn->close();

    // Redirect to index.php
    header("Location: ../index.php");
    exit;
}

?>

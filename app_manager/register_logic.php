<?php
session_start(); // Inizia la sessione

include "db.php";

// Dati dell'utente
$userName = $_POST['userName'];
$email = $_POST['email'];
$userPassword = $_POST['userPassword'];

// Query SQL per inserire un nuovo utente
$sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $userName, $email, $userPassword);

if ($stmt->execute()) {
  // L'utente è stato registrato con successo, reindirizza alla pagina di login
  header('Location: login.php');
} else {
  // Si è verificato un errore, mostra un messaggio di errore
  echo "Si è verificato un errore durante la registrazione.";
}

$conn->close();
?>

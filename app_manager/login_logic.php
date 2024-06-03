<?php
session_start(); // Inizia la sessione

include "db.php";

// Credenziali dell'utente
$userName = $_POST['userName'];
$userPassword = $_POST['userPassword'];

// Query SQL per verificare le credenziali dell'utente
$sql = "SELECT * FROM user WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $userName, $userPassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Le credenziali dell'utente sono corrette
  $user = $result->fetch_assoc();

  // Imposta le variabili di sessione
  $_SESSION['loggedin'] = true;
  $_SESSION['id'] = $user['id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['email'] = $user['email'];
  $_SESSION['password'] = $user['password'];

  // Reindirizza l'utente alla pagina index.php
  header('Location: index.php');
} else {
  // Le credenziali dell'utente non sono corrette, mostra un messaggio di errore
  echo "Le credenziali fornite non sono corrette.";
}

$conn->close();
?>

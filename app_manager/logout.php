<?php
session_start(); // Inizia la sessione

// Distruggi la sessione.
session_destroy();

// Reindirizza l'utente alla pagina di login.
header('Location: login.php');
exit;
?>

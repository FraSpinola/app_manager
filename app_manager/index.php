<?php

session_start();

include "db.php";

// Se utente non è loggato, reindirizza alla pagina di login, altrimenti salva le credenziali(da implementare)

if(!isset($_SESSION['loggedin'])){
    header('Location: login.php');
    exit;
}else if(isset($_SESSION['username'])){
    echo "Benvenuto, " . $_SESSION['username'] . "<br>"; 
    echo "id " . $_SESSION['id'] . "<br>";
    echo "email" . $_SESSION['email'] . "<br>";
    echo "password" . $_SESSION['password'] . "<br>";
} 

//logica per mostrare solo un tot di app per pagina

// Get the page number from the query string (default to 1 if not set)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of apps to display per page
$appsPerPage = 5;
// Calculate the offset for the query
$offset = ($page - 1) * $appsPerPage;

// SQL query to fetch data from app table
$user_id = $_SESSION['id'];
$sql = "SELECT app.* FROM app JOIN user_app ON app.id = user_app.app_id WHERE user_app.user_id = $user_id LIMIT $appsPerPage OFFSET $offset";
$result = $conn->query($sql);

$apps = [];
if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    $apps[] = $row;
  }
} 

// Check if there are more apps to display
$sql = "SELECT COUNT(*) as total_apps FROM app JOIN user_app ON app.id = user_app.app_id WHERE user_app.user_id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalApps = $row['total_apps'];
$moreApps = $totalApps > $offset + $appsPerPage;

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-container">
    <div>
         <?php 
         include "header.php";
         ?>
        <main class="main-container">
         <?php 
         include "sidebar.php";
         ?>
            <div class="index-dashboard">

                <a href="add_app/form.php" class="new-app-button" >
                    <svg style="width:30px;height:30px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p>add a new app</p>        
                </a>
                <?php 
                    foreach($apps as $app): ?>
                        <a href="app.php?id=<?php echo htmlspecialchars($app['id'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration: none; color: inherit;">
                            <div class="app-card">
                                <h2><?php echo htmlspecialchars($app['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                                <p><?php echo htmlspecialchars($app['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            </div></a>
                 <?php endforeach; ?>


                 <div class="navigation">
                  <?php if ($page > 1): ?>
                    <a class="app-link skip-button" href="?page=<?php echo $page - 1; ?>">Previous Page</a>
                  <?php endif; ?>
                 
                  <?php if ($moreApps): ?>
                    <a class="app-link skip-button" href="?page=<?php echo $page + 1; ?>">Next Page</a>
                  <?php endif; ?>
                 </div>

            </div>
        </main>
    </div>
</body>
</html>
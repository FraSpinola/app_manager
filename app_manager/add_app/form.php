<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new app</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="index-container">
    <div>
        <header class="index-header">
        </header>
        <main class="main-container">
            <div class="index-sidebar"></div>
            <div class="index-dashboard">
                <a style="text-decoration: none; color: inherit;" href="../index.php">
                    <p class="app-link" >Go back to all apps</p>
                </a>
                <form class="app-form" action="insert_app.php" method="post">
                    <input class="form-input" type="text" id="name" name="name" placeholder="App Name">
                    <textarea class="form-input" id="description" name="description" placeholder="App Description"></textarea>
                    <button class="edit-button" type="submit">Add App</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
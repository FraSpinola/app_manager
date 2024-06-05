<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Manager Login page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-container">
    <div>
        <header class="index-header">
        </header>
        <main class="main-container">
            <div class="index-dashboard login-dashboard">
             <h1 class="login-page-title">App Manager Login</h1>
             <form class="login-form" action="login_logic.php" method="post">
              <label class="form-label" for="userName">Username:</label><br>
              <input required class="form-input" type="text" id="userName" name="userName"><br>
              <label class="form-label" for="userPassword">Password:</label><br>
              <input required class="form-input" type="password" id="userPassword" name="userPassword"><br>
              <input class="edit-button" type="submit" value="Submit">
             </form>
             <span style="margin:1rem;">Don't have an account yet?</span>
             <a  href="./register.php">
                 Click here to register!
             </a>
            </div>
        </main>
    </div>
</body>
</html>
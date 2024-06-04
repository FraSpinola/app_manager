<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Manager Register page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-container">
    <div>
        <header class="index-header">
        </header>
        <main class="main-container">
            <div class="index-dashboard login-dashboard">
             <h1 class="login-page-title">App Manager register page</h1>
             <form class="login-form" action="register_logic.php" method="post">
             <label class="form-label" for="userName">Username:</label><br>
              <input class="form-input" type="text" id="userName" name="userName" required><br>
              <label class="form-label" for="email">Email:</label><br>
              <input class="form-input" type="email" id="email" name="email" required><br>
              <label class="form-label" for="userPassword">Password:</label><br>
              <input class="form-input" type="password" id="userPassword" name="userPassword" required><br>
              <input class="edit-button" type="submit" value="Register">
             </form>
             <span style="margin:1rem;">Already have an account?</span>
             <a  href="./login.php">
                 Click here to login!
             </a>
            </div>
        </main>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Manager Login page</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .app-card {
            margin-bottom: 1rem;
            padding: 1rem;
            border-radius: 5px;
            transition: all 0.4s ease; 
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); 
            background-color: #2d5da6;
            color: white;
        }

        .app-card:hover {
            transform: scale(1.012); 
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            background-color: #4a8edc; 
        }

        .new-app-button{
            display:flex;
            flex-direction:row; 
            align-items:center; 
            padding:5px;
            margin:20px; 
            width: 150px;
            border:none;
            cursor: pointer;
            border-radius:10px;
            background-color:green;
            color: white;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); 
            text-decoration:none;
            transition: all 0.4s ease; 
        }

        .new-app-button:hover{
            transform: scale(1.012); 
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            background-color: #4a8edc;
        }

        .skip-button{
            background-color: purple;
        }

        .login-dashboard{
            display: flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
        }

        .login-form{
            display: flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }

        .login-page-title{
            padding:1rem;
            margin:1rem;
        }

    </style>
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
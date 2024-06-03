<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Manager Register page</title>
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

        .register-dashboard{
            display: flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
        }

        .register-form{
            display: flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }

        .register-page-title{
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
            <div class="index-dashboard register-dashboard">
             <h1 class="register-page-title">App Manager register page</h1>
             <form class="register-form" action="register_logic.php" method="post">
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
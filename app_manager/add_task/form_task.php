<?php

session_start();

include "../db.php";

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new task</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="index-container">
    <div>
        <header class="index-header">
        </header>
        <main class="main-container">
            <div class="index-sidebar"></div>
            <div class="index-dashboard">
                <a style="text-decoration: none; color: inherit;" href="../app.php?id=<?php echo $_SESSION['app_id']; ?>" >
                    <p class="app-link" >Go back to all tasks</p>
                </a>
                <form class="app-form" id="editForm" method="post" action="insert_task.php">
                 <label class="form-label" for="taskStatus">Task status:</label><br>
                   <select placeholder="Task Status" class="form-input" id="addStatus" name="status">
                       <option value="TO_DO">TO_DO</option>
                       <option value="IN_PROGRESS" >IN_PROGRESS</option>
                       <option value="DONE">DONE</option>
                   </select><br>
                   <label class="form-label" for="taskDescription">Task Description:</label><br>
                   <textarea  class="form-input" id="appDescription" name="description">
                   </textarea><br>
                   <input type="hidden" name="app_id" value="<?php echo $_SESSION['app_id']; ?>">
                   <input type="submit" id="submitEditButton" class="submit-button edit-button" value="Add task">
                 </form>
            </div>
        </main>
    </div>
</body>
</html>
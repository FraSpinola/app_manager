<?php

session_start();

include "db.php";

// Get the id from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$_SESSION["app_id"] = $id;

// Get the page number from the query string (default to 1 if not set)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$tasksPerPage = 3;

// Calculate the offset for the query
$offset = ($page - 1) * $tasksPerPage;

$sql = "SELECT * FROM app WHERE id = $id";
$result = $conn->query($sql);

$app = [];
if ($result->num_rows > 0) {
  $app = $result->fetch_assoc();
} 

$sql = "SELECT * FROM task WHERE app_id = $id LIMIT $tasksPerPage OFFSET $offset";
$tasks = $conn->query($sql);

// Check if there are more tasks to display
$sql = "SELECT COUNT(*) as total_tasks FROM task WHERE app_id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalTasks = $row['total_tasks'];
$moreTasks = $totalTasks > $offset + $tasksPerPage;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Detail Page</title>
    <link rel="stylesheet" href="style.css">
    <style>

        .app-description{
            padding: 5px;
        }

        .button-container{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: left;
        }

    </style>
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

                <a style="text-decoration: none; color: inherit;" href="./index.php">
                    <p class="app-link" >Go back to all apps</p>
                </a>

                <?php if (!empty($app)): ?>
                    <div class="app-description">
                        <h2><?php echo htmlspecialchars($app['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p><?php echo htmlspecialchars($app['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php else: ?>
                    <p>No app found</p>
                <?php endif; ?>

                <div class="button-container">
                  <button id="deleteButton" class="delete-button">Delete this app</button>
                  <button id="editButton" class="edit-button">Edit this app</button>
                  <a href="add_task/form_task.php" class="new-app-button" >
                      <svg style="width:30px;height:30px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                      <p>add a new task</p>        
                  </a>
                </div>

                <div id="myModal" class="modal">
                  <div class="modal-content">
                    <h2>Are you sure you want to delete this app?</h2>
                    <div id="modal-buttons">
                      <button class="edit-button" id="noButton" class="no-button">No</button>
                      <button class="delete-button"  id="yesButton" class="yes-button">Yes</button>
                    </div>
                  </div>
                </div>

                <div id="editModal" class="modal">
                  <div class="modal-content">
                  <form id="editForm" method="post" action="edit_app.php">
                    <label class="form-label" for="appName">App Name:</label><br>
                    <input class="form-input" type="text" id="appName" name="name" value="<?php echo htmlspecialchars($app['name'], ENT_QUOTES, 'UTF-8'); ?>"><br>
                    <label class="form-label" for="appDescription">App Description:</label><br>
                    <textarea class="form-input" id="appDescription" name="description"><?php echo htmlspecialchars($app['description'], ENT_QUOTES, 'UTF-8'); ?></textarea><br>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="button" id="closeEditButton" class="close-button delete-button">Close window</button>
                    <input type="submit" id="submitEditButton" class="submit-button edit-button" value="Edit app">
                  </form>
                  </div>
                </div>

                <?php if (!empty($app)): ?>
                 <!-- Your existing app details here -->
             
                 <?php if ($tasks->num_rows > 0): ?>
                     <div class="app-tasks">
                         <h2>Tasks</h2>
                         <?php while($task = $tasks->fetch_assoc()): ?>
                          <a href="task_detail.php?id=<?php echo $task['id']; ?>" style="text-decoration: none; color: inherit;">
                              <div class="app-card">
                                  <p><?php echo htmlspecialchars($task['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                  <p>Status: <?php echo htmlspecialchars($task['status'], ENT_QUOTES, 'UTF-8'); ?></p>
                              </div>
                          </a>
                         <?php endwhile; ?>
                     </div>
                 <?php else: ?>
                     <h2>No tasks found for this app.</h2>
                 <?php endif; ?>

                 <?php else: ?>
                     <p>No app found with the given id.</p>
                 <?php endif; ?>

                 <div class="navigation">
                   <?php if ($page > 1): ?>
                     <a class="app-link skip-button" href="?id=<?php echo $id; ?>&page=<?php echo $page - 1; ?>">Previous Page</a>
                   <?php endif; ?>
                 
                   <?php if ($moreTasks): ?>
                     <a class="app-link skip-button" href="?id=<?php echo $id; ?>&page=<?php echo $page + 1; ?>">Next Page</a>
                   <?php endif; ?>
                 </div>
                
            </div>
        </main>
    </div>
    <script>

        let modal = document.getElementById("myModal");
        let btn = document.getElementById("deleteButton");
        let yesBtn = document.getElementById("yesButton");
        let noBtn = document.getElementById("noButton");
        
        btn.onclick = function() {
          modal.style.display = "block";
        }
        
        noBtn.onclick = function() {
          modal.style.display = "none";
        }
        
        yesBtn.onclick = function() {
          window.location.href = 'delete_app.php?id=' + <?php echo $id; ?>;
        }

        let editModal = document.getElementById("editModal");
        let editBtn = document.getElementById("editButton");
        let closeEditBtn = document.getElementById("closeEditButton");
        let submitEditBtn = document.getElementById("submitEditButton");
        
        editBtn.onclick = function() {
          editModal.style.display = "block";
        }
        
        closeEditBtn.onclick = function() {
          editModal.style.display = "none";
        }

    </script>
</body>
</html>
<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_manager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the id from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// SQL query to fetch the task with the given id
$sql = "SELECT * FROM task WHERE id = $id";
$result = $conn->query($sql);

$task = [];
if ($result->num_rows > 0) {
  // Output data of the row
  $task = $result->fetch_assoc();
} else {
  echo "No results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Detail Page</title>
    <link rel="stylesheet" href="style.css">
    <style>

        .app-description{
            padding: 5px;
        }

        .modal {
          display: none;
          position: fixed;
          z-index: 1;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          overflow: auto;
          background-color: rgba(0,0,0,0.4);
        }
        
        .modal-content {
          background-color: #fefefe;
          margin: 15% auto;
          padding: 20px;
          border: 1px solid #888;
          width: 80%;
          border-radius:10px;
          display:flex;
          flex-direction:column;
          align-items:center;
        }

        #modal-buttons{
          display:flex;
          flex-direction:row;
          align-items:center;
          justify-content: space-around;
          padding:1rem;
          margin:1rem;
        }
        
        .close {
          color: #aaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }
        
        .close:hover,
        .close:focus {
          color: black;
          text-decoration: none;
          cursor: pointer;
        }

    </style>
</head>
<body class="index-container">
    <div>
        <header class="index-header">
        </header>
        <main class="main-container">
            <div class="index-sidebar"></div>
            <div class="index-dashboard">

                <a style="text-decoration: none; color: inherit;" href="app.php?id=<?php echo $_SESSION['app_id']; ?>">
                    <p class="app-link" >Go back to all tasks</p>
                </a>

               <?php if (!empty($task)): ?>
                   <div>
                       <h2><?php echo htmlspecialchars($task['description'], ENT_QUOTES, 'UTF-8'); ?></h2>
                       <p>Status: <?php echo htmlspecialchars($task['status'], ENT_QUOTES, 'UTF-8'); ?></p>
                   </div>
               <?php else: ?>
                   <p>No task found with the given id.</p>
               <?php endif; ?>

               <button id="deleteButton" class="delete-button">Delete this task</button>

               <div id="myModal" class="modal">
                 <div class="modal-content">
                   <h2>Are you sure you want to delete this task?</h2>
                   <div id="modal-buttons">
                     <button class="edit-button" id="noButton" class="no-button">No</button>
                     <button class="delete-button"  id="yesButton" class="yes-button">Yes</button>
                   </div>
                 </div>
               </div>
               
               <button id="editButton" class="edit-button">Edit this task</button>
               
               <div id="editModal" class="modal">
                 <div class="modal-content">
                 <form id="editForm" method="post" action="edit_task.php">
                 <label class="form-label" for="taskStatus">Task status:</label><br>
                   <select class="form-input" id="addStatus" name="status">
                       <option value="TO_DO" <?php echo $task['status'] == 'TO_DO' ? 'selected' : ''; ?>>TO_DO</option>
                       <option value="IN_PROGRESS" <?php echo $task['status'] == 'IN_PROGRESS' ? 'selected' : ''; ?>>IN_PROGRESS</option>
                       <option value="DONE" <?php echo $task['status'] == 'DONE' ? 'selected' : ''; ?>>DONE</option>
                   </select><br>
                   <label class="form-label" for="taskDescription">Task Description:</label><br>
                   <textarea class="form-input" id="appDescription" name="description"><?php echo htmlspecialchars($task['description'], ENT_QUOTES, 'UTF-8'); ?></textarea><br>
                   <input type="hidden" name="id" value="<?php echo $id; ?>">
                   <button type="button" id="closeEditButton" class="close-button delete-button">Close window</button>
                   <input type="submit" id="submitEditButton" class="submit-button edit-button" value="Edit task">
                 </form>
                 </div>
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
          window.location.href = 'delete_task.php?id=' + <?php echo $id; ?>;
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
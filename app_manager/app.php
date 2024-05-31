<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_manager";

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla connessione
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

// Get the id from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// SQL query to fetch the app with the given id
$sql = "SELECT * FROM app WHERE id = $id";
$result = $conn->query($sql);

$app = [];
if ($result->num_rows > 0) {
  // Output data of the row
  $app = $result->fetch_assoc();
} else {
  echo "No results";
}

// SQL query to fetch the tasks associated with the app id
$sql = "SELECT * FROM task WHERE app_id = $id";
$tasks = $conn->query($sql);

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

    </style>
</head>
<body class="index-container">
    <div>
        <header class="index-header">
        </header>
        <main class="main-container">
            <div class="index-sidebar"></div>
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
                    <p>No app found with the given id.</p>
                <?php endif; ?>

                <button id="deleteButton" class="delete-button">Delete this app</button>

                <div id="myModal" class="modal">
                  <div class="modal-content">
                    <h2>Are you sure you want to delete this app?</h2>
                    <div id="modal-buttons">
                      <button class="edit-button" id="noButton" class="no-button">No</button>
                      <button class="delete-button"  id="yesButton" class="yes-button">Yes</button>
                    </div>
                  </div>
                </div>

                <button id="editButton" class="edit-button">Edit this app</button>

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
                             <div class="app-card">
                                 <p><?php echo htmlspecialchars($task['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                 <p>Status: <?php echo htmlspecialchars($task['status'], ENT_QUOTES, 'UTF-8'); ?></p>
                             </div>
                         <?php endwhile; ?>
                     </div>
                 <?php else: ?>
                     <h2>No tasks found for this app.</h2>
                 <?php endif; ?>

                 <?php else: ?>
                     <p>No app found with the given id.</p>
                 <?php endif; ?>
                
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
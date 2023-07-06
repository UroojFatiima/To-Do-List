<?php
// Check if the request is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the task ID from the request
  $taskId = $_POST['taskId'];

  // Database credentials
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "todos";

  // Create a connection to the database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL statement to delete the task
  $sql = "DELETE FROM todos WHERE id = ?";

  // Prepare and bind the statement
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $taskId);

  // Execute the statement
  if ($stmt->execute()) {
    echo "Task deleted successfully.";
  } else {
    echo "Error deleting task: " . $stmt->error;
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
}
?>

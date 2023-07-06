<?php
// Check if the request is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the task ID and completion status from the request
  $taskId = $_POST['taskId'];
  $completed = $_POST['completed'];

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

  // Prepare the SQL statement to update the task's completion status
  $sql = "UPDATE todos SET completed = ? WHERE id = ?";

  // Prepare and bind the statement
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $completed, $taskId);

  // Execute the statement
  if ($stmt->execute()) {
    echo "Task updated successfully.";
  } else {
    echo "Error updating task: " . $stmt->error;
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
}
?>

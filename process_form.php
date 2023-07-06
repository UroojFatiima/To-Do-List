<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the task title from the form
  $taskTitle = $_POST['task'];

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

  // Prepare the SQL statement
  $sql = "INSERT INTO todos (title, completed) VALUES (?, false)";

  // Prepare and bind the statement
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $taskTitle);

  // Execute the statement
  if ($stmt->execute()) {
    echo "Task added successfully.";
  } else {
    echo "Error adding task: " . $stmt->error;
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
}
?>

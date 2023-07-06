<!DOCTYPE html>
<html>
<head>
  <title>To-Do List</title>
</head>
<body>
  <h1>To-Do List</h1>

  <form action="process_form.php" method="POST">
    <label for="task">Task:</label>
    <input type="text" id="task" name="task" required>
    <button type="submit">Add Task</button>
  </form>

  <h2>Your Tasks:</h2>
  <ul id="task-list">
    <?php
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

    // Fetch the list of tasks from the database
    $sql = "SELECT * FROM todos";
    $result = $conn->query($sql);

    // Check if there are any tasks in the result set
    if ($result->num_rows > 0) {
      // Output each task as a list item with a checkbox and delete button
      while ($row = $result->fetch_assoc()) {
        $taskId = $row['id'];
        $taskTitle = $row['title'];
        $completed = $row['completed'];

        // Determine the CSS class based on completion status
        $class = ($completed) ? 'completed' : '';

        echo "<li class='$class'>";
        echo "<input type='checkbox' value='$taskId' class='task-checkbox' ";
        echo ($completed) ? 'checked' : '';
        echo ">";
        echo $taskTitle;
        echo "<button class='delete-button' data-task-id='$taskId'>Delete</button>";
        echo "</li>";
      }
    } else {
      echo "<li>No tasks found.</li>";
    }

    // Close the connection
    $conn->close();
    ?>
  </ul>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>
</html>

$(document).ready(function() {
    // Delete task
    $('.delete-button').click(function() {
      var taskId = $(this).data('task-id');
  
      $.ajax({
        url: 'delete_task.php',
        method: 'POST',
        data: { taskId: taskId },
        success: function(response) {
          console.log(response);
          // Remove the deleted task from the DOM
          $('.delete-button[data-task-id="' + taskId + '"]').parent().remove();
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
  
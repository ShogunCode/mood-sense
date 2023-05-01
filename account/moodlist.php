<?php

include_once '../header.php';

// echo $_SESSION['username'] . "<br>";
// echo $_SESSION['userid'] . "<br>";

// Redirect if user is not logged in 
if (!isset($_SESSION['username'])) {
  header("location: login.php");
  exit();
}

$endpoint = "http://localhost/moodsenseapi/CRUD/posts.php?userId=" . $_SESSION['userid'];

// Hard coded API key
$options = array(
  'http' => array(
    'method' => 'GET',
    'header' => 'X-Api-Key: 12345678'
  )
);

$context = stream_context_create($options);
$resource = file_get_contents($endpoint, false, $context);

//echo $resource;

$data = json_decode($resource, true);


?>

<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Mood List</title>
</head>

<body>

  <div class="p-4 m-2">
    <table class="table table-striped table-bordered table-hover text-center">
      <thead>
        <tr class="p-3 mb-2 bg-primary text-white">
          <th scope="col">#</th>
          <th scope="col">Mood Description</th>
          <th scope="col">Mood Score</th>
          <th scope="col">Date Posted</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 0;
        foreach ($data as $row) {
          $i++;
          echo "<tr data-id='" . $row["mood_log_id"] . "'>
          <td>" . $i . "</td>
          <td>" . $row["mood_desc"] . "</td>
          <td>" . $row["mood_score"] . "</td>
          <td>" . $row["date_posted"] . "</td>
          <td>
            <button type='button' class='btn btn-primary edit-button' data-toggle='modal'>Edit
            <img src='http://localhost/pdomoodsensetest-dani/SVG/modmood.svg'> 
            </button>
          </td>
          <td>
            <button type='button' class='btn btn-danger delete-button' data-id='" . $row["mood_log_id"] . "'>Delete
            <img src='http://localhost/pdomoodsensetest-dani/SVG/delete.svg'>
            </button>
          </td>
        </tr>";
        }
        echo "</table>";
        ?>

      </tbody>
    </table>

  </div>

  <!-- Edit Modal/Script -->
  <script>
    function loadTableData() {
      const endpoint = "http://localhost/moodsenseapi/CRUD/posts.php?userId=" + <?php echo $_SESSION['userid']; ?>;
      $.getJSON(endpoint, function (data) {
        // Clear the table body
        $('tbody').empty();
        // Populate the table with the new data
        let i = 0;
        data.forEach(function (row) {
          i++;
          $('tbody').append(
            "<tr data-id='" + row.mood_log_id + "'>" +
            "<td>" + i + "</td>" +
            "<td>" + row.mood_desc + "</td>" +
            "<td>" + row.mood_score + "</td>" +
            "<td>" + row.date_posted + "</td>" +
            "<td><button type='button' class='btn btn-primary edit-button' data-toggle='modal' data-target='#edit-modal' data-id='" + row.mood_log_id + "' data-desc='" + row.mood_desc + "'>Edit</button></td>" +
            "<td><button type='button' class='btn btn-danger delete-button' data-id='" + row.mood_log_id + "'>Delete<img src='http://localhost/pdomoodsensetest-dani/SVG/delete.svg'></button></td>" +
            "</tr>"
          );
        });
      });
    }


    $(document).ready(function () {
      // Define a variable to store the ID of the selected row
      let selectedId;

      // Add a click event listener to the edit buttons
      $('table').on('click', '.edit-button', function () {
        $('#edit-modal').modal('show');
        console.log('Edit button clicked');
        // Get the ID of the selected row
        selectedId = $(this).closest('tr').attr('data-id');
        console.log(selectedId);

        // Get the mood description from the selected row
        const moodDesc = $(this).closest('tr').find('td:nth-child(2)').text();

        // Populate the modal with the mood description
        $('#edit-modal').find('#edit-desc').val(moodDesc);
      });

      // Add a click event listener to the submit button in the edit modal
      $(document).on('click', '#edit-submit', function () {
        // Get the new mood description from the input field in the modal
        const newMoodDesc = $('#edit-modal').find('#edit-desc').val();

        // Make an AJAX request to update the mood description in the database
        $.ajax({
          url: 'http://localhost/moodsenseapi/CRUD/update.php',
          type: 'PUT',
          data: JSON.stringify({ mood_log_id: selectedId, mood_desc: newMoodDesc }),
          contentType: 'application/json',
          success: function (response) {
            // Reload the table data
            loadTableData();

            // Hide the modal
            $('#edit-modal').modal('hide');
          },
          error: function (xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      });
    });
  </script>

  <!-- Modal -->
  <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Mood Description</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="edit-form">
            <div class="form-group">
              <label for="edit-desc">Mood Description:</label>
              <input type="text" class="form-control" id="edit-desc" name="edit-desc">
              <input type="hidden" id="edit-id" name="edit-id">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="edit-submit">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Mood script -->
  <script>
    $(document).ready(function () {
      // Add a click event listener to the delete buttons
      $('table').on('click', '.delete-button', function () {
        const rowId = $(this).data('id');
        console.log('Delete button clicked with row ID:', rowId);

        // Show the delete modal
        $('#delete-modal').modal('show');

        // When the user confirms the deletion
        $('#confirm-delete-button').one('click', function () {
          // Unbind the click event handler for the confirm-delete-button
          $(this).off('click');

          // Get the row ID from the delete button
          const confirmRowId = $(this).data('id');
          console.log('Confirm delete button clicked with row ID:', confirmRowId);

          // Set the data-id attribute of the confirm delete button to the rowId value
          $('#confirm-delete-button').attr('data-id', rowId);

          // Send the delete request
          $.ajax({
            url: 'http://localhost/moodsenseapi/CRUD/delete.php',
            type: 'DELETE',
            data: JSON.stringify({ mood_log_id: rowId }),
            contentType: 'application/json',
            success: function (response) {
              // Remove the deleted row from the table
              $('tr[data-id="' + rowId + '"]').remove();
              loadTableData();
            },
            error: function (xhr, status, error) {
              console.log(xhr.responseText);
            }
          });

          // Hide the modal
          $('#delete-modal').modal('hide');
        });
      });
    });

  </script>

  <!-- Delete Modal -->
  <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="delete-modal-label">Delete Mood Entry</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this mood entry?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirm-delete-button" data-id="">Delete</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
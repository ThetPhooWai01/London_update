<?php
include 'database.php';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}

session_start();


    // Check if the browser ID is already stored in the session
    if (isset($_SESSION['browser_id'])) {
        $browserId = $_SESSION['browser_id'];
    } else {
        // Generate a new browser ID
        $browserId = generateUniqueBrowserId();

        // Store the browser ID in the session for future use
        $_SESSION['browser_id'] = $browserId;
    }

    $b_id = $browserId;

    $sql = "SELECT * FROM user_database WHERE browser_id='$b_id'";
    $result = $connection->query($sql);
    if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //$user_id = $row['user_name'];
        $user_id = $row['user_name']; //Database

        $query = "SELECT * FROM `$user_id`";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            echo '<table class="table table-md-responsive" id="dataTable">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Type</th>
                    <th>Total</th>
                    <th>Voucher</th>
                    <th>Customer</th>
                    <th>Tra ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td contenteditable="true">' . $row['product_name'] . '</td>';
                echo '<td contenteditable="true">' . $row['price'] . '</td>';
                echo '<td contenteditable="true">' . $row['qty'] . '</td>';
                echo '<td contenteditable="true"><select id="cars" contenteditable="true">
        <option value="' . $row['type'] . '">' . $row['type'] . '</option>
        <option value="ဗူး/ခု">ဗူး/ခု</option>
        <option value="ကဒ်">ကဒ်</option>
        <option value="ဖာ">ဖာ</option>
      </select></td>';
                
                echo '<td contenteditable="true">' . $row['total'] . '</td>';
                echo '<td contenteditable="true">' . $row['voucher'] . '</td>';
                echo '<td contenteditable="true">' . $row['customer'] . '</td>';
                echo '<td contenteditable="true">' . $row['tra_id'] . '</td>';


                echo '<td><button onclick="deleteRow(this)">Delete</button></td>';
                echo '</tr>';
            }

            $query = "SELECT sum(total) as total_sum FROM `$user_id`";
            $result = $connection->query($query);

            // Initialize $total to a default value
            //$total = 0;

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total = $row['total_sum'];
                echo'
        <tr>
        <td colspan=4 style="text-align:center;">Total</td>
        <td colspan=2><b>'.$total.' MMK </br></td>
        </tr>
        ';
            }

            echo '</tbody>
        </table>';
        } else {
            echo "No records found.";
        }
    }
}

$connection->close();
?>
<script>
    const editableCells = document.querySelectorAll('#dataTable td[contenteditable="true"]');

editableCells.forEach(cell => {
    cell.addEventListener('input', function() {
        saveChangesForRow(this.parentElement);  // this.parentElement refers to the row
    });
});

// Handle select dropdowns separately
const dropdowns = document.querySelectorAll('#dataTable select');
dropdowns.forEach(dropdown => {
    dropdown.addEventListener('change', function() {
        saveChangesForRow(this.closest('tr'));  // 'closest' gets the nearest parent row element
    });
});

function saveChangesForRow(row) {
    const data = {};

    for (let j = 0; j < row.cells.length; j++) {
        const cell = row.cells[j];
        if (cell && cell.hasAttribute('contenteditable')) {
            const headerText = document.getElementById('dataTable').rows[0].cells[j].textContent;
            data[headerText] = cell.textContent;
        }

        // Handle select dropdowns separately
        if (cell.querySelector('select')) {
            const headerText = document.getElementById('dataTable').rows[0].cells[j].textContent;
            data[headerText] = cell.querySelector('select').value;  // Get the selected value
        }
    }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'index_update.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log('Data updated successfully!');
                } else {
                    alert('Error updating data. Please try again.');
                }
            }
        };
        xhr.send(JSON.stringify(data));
    }
  
  function deleteRow(button) {
    const row = button.parentNode.parentNode;
    const tra_id = row.cells[5].textContent; // Assuming the Product ID is in the first column (index 0)
  
    // Send the tra_id to the backend PHP script using AJAX for deletion
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'index_delete.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          row.parentNode.removeChild(row); // Remove the row from the table on successful deletion
          alert('Data deleted successfully!');
        } else {
          alert('Error deleting data. Please try again.');
        }
      }
    };
    xhr.send('tra_id=' + encodeURIComponent(tra_id));

    
  }

  //Brower ID
  function generateUniqueBrowserId()
{
    $randomString = bin2hex(random_bytes(16));
    $timestamp = time();

    return $randomString . $timestamp;
}
</script>
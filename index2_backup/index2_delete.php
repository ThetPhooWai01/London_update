<?php
// Replace "your_username", "your_password", and "your_database" with your MySQL credentials
include 'database.php';

$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
  die("ERROR: Could not connect. " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["tra_id"])) {
    $tra_id = $connection->real_escape_string($_POST["tra_id"]);
    echo($tra_id);

    // Perform the DELETE query
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

            $query = "DELETE FROM `$user_id` WHERE tra_id = '$tra_id'";
            if ($connection->query($query)) {
                http_response_code(200);
            } else {
                http_response_code(500);
            }

            $query = "DELETE FROM sell_data WHERE tra_id = '$tra_id'";
            if ($connection->query($query)) {
                http_response_code(200);
            } else {
                http_response_code(500);
            }
        }
    }
}
function generateUniqueBrowserId()
{
    $randomString = bin2hex(random_bytes(16));
    $timestamp = time();

    return $randomString . $timestamp;
}

$connection->close();
?>

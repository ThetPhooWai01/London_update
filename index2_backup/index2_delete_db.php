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

    $sql = "DELETE FROM `$user_id`";
    if ($connection->query($sql) === true) {
        echo 'success';
    } else {
        echo 'error';
    }
}}

function generateUniqueBrowserId()
{
    $randomString = bin2hex(random_bytes(16));
    $timestamp = time();

    return $randomString . $timestamp;
}

$connection->close();
?>

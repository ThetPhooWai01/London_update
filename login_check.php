<?php 
include 'database.php';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}


    // Start or resume the session
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

// Perform a database query to check if the browser ID exists in the user_database table
$sql = "SELECT * FROM user_database WHERE browser_id='$b_id'";
$result = $connection->query($sql);
if ($result && $result->num_rows > 0) {
    //echo '<script>alert("Login Sucess");</script>';
    //echo '<script>window.location = "admin_trade_data.html";</script>';
    echo '';
    
} else {
    //echo '<script>alert("Fail");</script>';
    
    if (file_exists("../user_login.php")) {
        echo '<script>window.location = "../user_login.php";</script>';
    }
    else{
        echo '<script>window.location = "user_login.php";</script>';
    }
}

// Close the connection



function generateUniqueBrowserId()
{
    $randomString = bin2hex(random_bytes(16));
    $timestamp = time();

    return $randomString . $timestamp;
}
?>
<!-- <script>window.location = "../user_login.php";</script> -->
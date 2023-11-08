
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Alert Example</title>
</head>
<body>

<script>
    // Display a confirmation alert when the page loads
    window.addEventListener('load', function() {
        const message = "Are you sure you want to proceed?";
        const result = confirm(message);

        if (result) {
            // User clicked OK
            <?php 
            include "database.php";
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
                $query = "UPDATE user_database set browser_id='0' where browser_id='$b_id'";
                if (!$connection->query($query)) {
                    die("ERROR: Query failed. " . $connection->error);
                }
                else{ 
                    echo '<script>window.location = "../user_login.php";</script>';
                }
                
            } 

            function generateUniqueBrowserId()
            {
                $randomString = bin2hex(random_bytes(16));
                $timestamp = time();

                return $randomString . $timestamp;
            }

            ?>

        } else {
            // User clicked Cancel
            <?php
            echo '<script>window.location = "../index.php";</script>';
            ?>
        }
    });
</script>

</body>
</html>



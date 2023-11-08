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
        $user_id = $row['user_name']; //Database

            $data = json_decode(file_get_contents('php://input'), true);
            $product_name = $connection->real_escape_string($data['Product Name']);
            $price = $connection->real_escape_string($data['Price']);
            $qty = $connection->real_escape_string($data['Qty']);
            $type = $connection->real_escape_string($data['Type']);
            $tra_id = $connection->real_escape_string($data['Tra ID']);

            $sql = "SELECT * FROM product WHERE product_name='$product_name'";
            $result = $connection->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                if ($type == 'ဗူး/ခု') {
                    $price = $row['round_pieces_price'];
                } elseif ($type == 'ကဒ်') {
                    $price = $row['round_unit_price'];
                } elseif ($type == 'ဖာ') {
                    $price = $row['round_package_price'];
                }

                $total_f = $price * $qty;

            
                $query = "UPDATE `$user_id`  set price='$price',qty='$qty', type='$type', total='$total_f' WHERE tra_id='$tra_id'";
                if (!$connection->query($query)) {
                    die("ERROR: Query failed. " . $connection->error);
                }

                $query = "UPDATE sell_data set price='$price',qty='$qty', type='$type', total='$total_f' WHERE tra_id='$tra_id'";
                if (!$connection->query($query)) {
                    die("ERROR: Query failed. " . $connection->error);
                }
            }

            $connection->close();
            http_response_code(200);

            

        }
    }

    function generateUniqueBrowserId()
    {
        $randomString = bin2hex(random_bytes(16));
        $timestamp = time();
    
        return $randomString . $timestamp;
    }
?>

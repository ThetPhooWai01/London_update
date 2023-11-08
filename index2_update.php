<?php
include 'pages/database.php';

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
            echo "<script>console.log('Qty Value: " . $qty . "');</script>";
            $discount = $connection->real_escape_string($data['Discount']);
            echo "<script>console.log('Discount Value: " . $discount . "');</script>";
            $voucher = $connection->real_escape_string($data['Voucher']);
            $type = $connection->real_escape_string($data['Type']);
            $tra_id = $connection->real_escape_string($data['Tra ID']);

            $sql = "SELECT * FROM product WHERE product_name='$product_name'";
            $result = $connection->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                if ($type == 'ဗူး/ခု') {
                    $price = $row['round_pieces_price'];

                    $sql = "SELECT package_exist,unit_exist,pieces_exist FROM product WHERE product_name='$product_name'";
                    $result = $connection->query($sql);
                    if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    $pieces_exist = $row['pieces_exist'];
                    if ($pieces_exist < $qty){
                        echo '<script>window.location = "dialog_box.html";</script>';
                    }
                    else{
                        $query = "UPDATE `$user_id` set discount='$discount',price='$price',qty='$qty', type='$type',voucher='$voucher' WHERE tra_id='$tra_id'";
                        if (!$connection->query($query)) {
                            die("ERROR: Query failed. " . $connection->error);
                        }

                        $query = "UPDATE sell_data set discount='$discount',price='$price',qty='$qty', type='$type',voucher='$voucher' WHERE tra_id='$tra_id'";
                        if (!$connection->query($query)) {
                            die("ERROR: Query failed. " . $connection->error);
                        }
                        include "cal_pro_remain.php";
                    }
                    }
                }


                } elseif ($type == 'ကဒ်') {
                    $price = $row['round_unit_price'];

                    $sql = "SELECT package_exist,unit_exist,pieces_exist FROM product WHERE product_name='$product_name'";
                    $result = $connection->query($sql);
                    if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    $unit_exist = $row['unit_exist'];                 
                    if ($unit_exist < $qty){
                        echo '<script>alert("Item is not Enough")</script>';
                    }
                    else{
                        $query = "UPDATE `$user_id` set discount='$discount',price='$price',qty='$qty', type='$type' WHERE tra_id='$tra_id'";
                        if (!$connection->query($query)) {
                            die("ERROR: Query failed. " . $connection->error);
                        }

                        $query = "UPDATE sell_data set discount='$discount',price='$price',qty='$qty', type='$type' WHERE tra_id='$tra_id'";
                        if (!$connection->query($query)) {
                            die("ERROR: Query failed. " . $connection->error);
                        }
                        include "cal_pro_remain.php";
                    }
                    }
                }


                } elseif ($type == 'ဖာ') {
                    $price = $row['round_package_price'];

                    $sql = "SELECT package_exist,unit_exist,pieces_exist FROM product WHERE product_name='$product_name'";
                    $result = $connection->query($sql);
                    if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    $package_exist = $row['package_exist'];                 
                    if ($package_exist < $qty){
                        echo '<script>alert("Item is not Enough")</script>';
                    }
                    else{
                        $query = "UPDATE `$user_id` set discount='$discount',price='$price',qty='$qty', type='$type' WHERE tra_id='$tra_id'";
                        if (!$connection->query($query)) {
                            die("ERROR: Query failed. " . $connection->error);
                        }

                        $query = "UPDATE sell_data set discount='$discount',price='$price',qty='$qty', type='$type' WHERE tra_id='$tra_id'";
                        if (!$connection->query($query)) {
                            die("ERROR: Query failed. " . $connection->error);
                        }
                        include "cal_pro_remain.php";
                    }
                    }
                }
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

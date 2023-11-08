<?php 
include 'database.php';
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}

$sql = "SELECT SUM(qty) AS total_pieces_qty,barcode FROM sell_data WHERE type = 'ဗူး/ခု' GROUP BY barcode";
$result = $connection->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pieces_sell = $row['total_pieces_qty'];
        $barcode = $row['barcode'];

        
        $query = "UPDATE product set pieces_sell='$pieces_sell' WHERE barcode='$barcode'";
        if (!$connection->query($query)) {
            die("ERROR: Query failed. " . $connection->error);
        }
    }
}

$sql = "SELECT SUM(qty) AS total_unit_qty,barcode FROM sell_data WHERE type = 'ကဒ်' GROUP BY barcode";
$result = $connection->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unit_sell = $row['total_unit_qty'];
        $barcode = $row['barcode'];
        $query = "UPDATE product set unit_sell='$unit_sell' WHERE barcode='$barcode'";
        if (!$connection->query($query)) {
            die("ERROR: Query failed. " . $connection->error);
        }
    }
}

$sql = "SELECT SUM(qty) AS total_package_qty,barcode FROM sell_data WHERE type = 'ဖာ' GROUP BY barcode";
$result = $connection->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $package_sell = $row['total_package_qty'];
        $barcode = $row['barcode'];
        $query = "UPDATE product set package_sell='$package_sell' WHERE barcode='$barcode'";
        if (!$connection->query($query)) {
            die("ERROR: Query failed. " . $connection->error);
        }
    }
}

$query = "UPDATE product set package_exist= package_remain - package_sell,unit_exist= unit_remain - unit_sell,pieces_exist= pieces_remain - pieces_sell";
if (!$connection->query($query)) {
    die("ERROR: Query failed. " . $connection->error);
}


?>
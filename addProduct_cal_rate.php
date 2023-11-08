<?php 
include '../database.php';
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}


    function roundUpToNearestHundred($number) {
      return ceil($number / 100) * 100;
      }

     
    $sql = "SELECT product_name, unit, pieces, buy, rate, trans, package_price, profit FROM product";
    $result = $connection->query($sql);
    if ($result && $result->num_rows > 0) {
    $stmt = $connection->prepare("UPDATE product SET package_price=?, unit_price=?, pieces_price=?, round_package_price=?, round_unit_price=?, round_pieces_price=? WHERE product_name=?");
    while ($row = $result->fetch_assoc()) {
    $unit = $row['unit']; 
    $pieces = $row['pieces']; 
    $buy = $row['buy'];
    $rate = $row['rate']; 
    $trans = $row['trans']; 
    $profit = $row['profit'];
    $product_name = $row['product_name'];

    $package_price = (($buy / $rate) + $trans) + $profit;
    $unit_price = $package_price/$unit;
    $pieces_price = $unit_price/$pieces;
    $round_package_price = roundUpToNearestHundred($package_price);
    $round_unit_price = roundUpToNearestHundred($unit_price);
    $round_pieces_price = roundUpToNearestHundred($pieces_price);

    $stmt->bind_param("dddddds", $package_price, $unit_price, $pieces_price, $round_package_price, $round_unit_price, $round_pieces_price, $product_name);
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Error updating record: ' . $connection->error]);
    }

    }
    $stmt->close();

    exit();
    } else {
    // Handle case when no records are found or other issues
    }

    
?>
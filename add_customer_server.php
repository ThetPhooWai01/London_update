<?php 

include '../database.php';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data from the form submission

    $customer = $_POST['customer'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $note = $_POST['note'];

    $sql = "SELECT * FROM customer where name='$customer'";
    $result = $connection->query($sql);
    if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<script>alert("Already Exist") ;</script>';
        echo '<script>window.location = "addCustomer.php";</script>';
    }

    }else{
        $total_buy = '0';
        $debt = '0';
        $deposit = '0';
        $balance = '0';
        $remain_debt = '0';

        $stmt = $connection->prepare("INSERT INTO customer(name,ph_no,address,role,total_buy,debt,deposit,balance,remain_debt) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss", $customer, $phone_no, $address, $role, $total_buy, $debt, $deposit, $balance, $remain_debt);
        if ($stmt->execute()) {
            $errorMessage = "update_data success";
            echo '<script>alert("Add New Customer Success") ;</script>';
            echo '<script>window.location = "addCustomer.php";</script>';
            
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
    }

    echo $customer;



}






?>
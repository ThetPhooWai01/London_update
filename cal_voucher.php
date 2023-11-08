<?php
include '../database.php';
// include '../sidebar.php';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}

//include "login_check.php";


$sql = "DELETE FROM voucher";
if ($connection->query($sql) === TRUE) {
    //echo "All records deleted successfully";
} else {
    //echo "Error deleting records: " . $conn->error;
}


$sql_insert = "
    INSERT INTO voucher (voucher_no, customer_name, total, discount, pay, payable)
    SELECT 
        voucher,
        customer,
        SUM(total) AS total_buy,
        discount,
        '0',  
        '0'   
    FROM sell_data
    GROUP BY voucher;
";

if ($connection->query($sql_insert) === TRUE) {
    //echo "Records inserted successfully";
} else {
    echo "Error inserting records: " . $connection->error;
}


        $sql = "SELECT name,voucher,SUM(amount) AS total_pay FROM payment GROUP BY voucher";
        $result = $connection->query($sql);
        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
              $name = $row['name'];
              $voucher = $row['voucher'];
              $total_pay = $row['total_pay'];

              $sql = "UPDATE voucher SET pay='$total_pay' WHERE voucher_no='$voucher'"; //update Brower ID
              $insertResult = $connection->query($sql);
              if ($insertResult) {
                  // echo 'Update Success Browser ID';
                  // echo '<script>alert("Login Success") ;</script>';
                  // echo '<script>window.location = "admin_dashboard_index.php";</script>';

              } else {
                  // echo '<script>window.location = "admin_login.html";</script>';
              }
        
            }
          }


$sql = "UPDATE voucher SET payable = total - pay;"; //update Brower ID
$insertResult = $connection->query($sql);

?>
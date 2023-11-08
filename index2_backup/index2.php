<?php

include 'database.php';


$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
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
    echo '<script>window.location = "user_login.php";</script>';
}

// Close the connection
$connection->close();

function generateUniqueBrowserId()
{
    $randomString = bin2hex(random_bytes(16));
    $timestamp = time();

    return $randomString . $timestamp;
}



$response = null;
$product_name = "";  
$package_price = "";
$unit_price = "";
$pieces_price = "";
$class = "";
$voucher = "";
$discount = "";
$payment = "";
$errorMessage = "";  // Add this for capturing error or success message
//check2
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);
    //check_4
    $barcode = $data['barcode'] ?? null;
    $orderNumber = $data['orderNumber'] ?? null;
    $discount = $data['discount'] ?? null;
    $payment = $data['payment'] ?? null;
    $customer = $data['customer'] ?? null;
    $date = $data['date'] ?? null;
    $rate = $data['rate'] ?? null;

    include 'database.php';

    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM product where barcode=$barcode";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            function getUnique8DigitNumber($filename = "generated_numbers.txt")
            {
                if (!file_exists($filename)) {
                    file_put_contents($filename, '');
                }

                $existingNumbers = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                do {
                    $random = mt_rand(10000000, 99999999);
                } while (in_array($random, $existingNumbers));

                file_put_contents($filename, $random . PHP_EOL, FILE_APPEND);

                return $random;
            }

            $random = getUnique8DigitNumber();
            $product_name = $row["product_name"];
            $package_price = $row["round_package_price"];
            $unit_price = $row["round_unit_price"];
            $pieces_price = $row["round_pieces_price"];
            $qty = '1';
            $type = 'ဗူး/ခု';
            $voucher ='လက်လီ';
            $exp_debt ='လက်လီ';
            //$total = $pieces_price * $qty;
            $database = 'sell_database';

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

            //echo "Browser ID: " . $browserId;
            $b_id = $browserId;
            $sql = "SELECT * FROM user_database WHERE browser_id='$b_id'";
            $result = $connection->query($sql);
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  //$user_id = $row['user_name'];
                  $user_id = $row['user_name'];

          
            $stmt = $connection->prepare("INSERT INTO `$user_id` (product_name, price, qty, total, tra_id, type,voucher,customer) VALUES (?, ?, ?, ?, ?, ?,?,?)");
            $stmt->bind_param("ssssssss", $product_name, $pieces_price, $qty, $pieces_price, $random, $type,$orderNumber,$customer);

            if ($stmt->execute()) {
                $errorMessage = "update_data success";
            } else {
                $errorMessage = "Error: " . $stmt->error;
            }

            // $barcode = $data['barcode'] ?? null;
            // $orderNumber = $data['orderNumber'] ?? null;
            // $discount = $data['discount'] ?? null;
            // $payment = $data['payment'] ?? null;
            // $customer = $data['customer'] ?? null;
            // $date = $data['date'] ?? null;
            // $rate = $data['rate'] ?? null;


            $today = date("Y-m-d");

            $stmt = $connection->prepare("INSERT INTO sell_data (date, barcode, product_name, price, qty, total, tra_id, customer, bill, type, exp_debt, voucher) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssss", $today, $barcode, $product_name, $pieces_price, $qty, $pieces_price, $random, $customer, $payment, $type, $exp_debt, $orderNumber);

            if (!$stmt->execute()) {
              die("Error: " . $stmt->error);
          }
          


            $response = [
              "status" => $errorMessage ? "error" : "success",
              "message" => $errorMessage ?: "Hello, $barcode.",
              "class" => $class,
              "product_name" => $product_name,
              "package_price" => $package_price,
              "unit_price" => $unit_price,
              "pieces_price" => $pieces_price,
          ];
      
          header("Content-Type: application/json");
          echo json_encode($response);
          exit;
      }

          }
        }
        function generateUniqueBrowserId()
{
    $randomString = bin2hex(random_bytes(16));
    $timestamp = time();

    return $randomString . $timestamp;
}
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>London | လက်လီ</title>
  <link rel="stylesheet" href="style1.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

 <!-- refreshTable -->

 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function refreshTable() {
        $.ajax({
            url: 'index2_server.php',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $("#table").html(data);  // <-- This line is updated to target the div with id 'table'
            }
        });
    }

    function deleteRow(button) {
        $(button).closest("tr").remove();
    }

    $(document).ready(function() {
        refreshTable(); // Fetch data initially
        setInterval(refreshTable, 3000); // Refresh every 5 seconds
    });
</script>


     <!-- refreshTable End-->

     
</head>

<body class="hold-transition sidebar-mini layout-fixed" onload="focusOnInput()">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">


        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">London Shop</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Admin</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  အရောင်း
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>လက်လီ</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="./index2.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>လက်ကား</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  ပစ္စည်းစာရင်း
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/addProduct.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ပစ္စည်းသစ်ပေါင်းထည့်ရန်</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/kyatProduct.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ကျပ်ငွေ အရောင်း</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/bahtProduct.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ဘတ်ငွေ အရောင်း</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/yuanProduct.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ယွမ် အရောင်း</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  ဖောက်သည် စာရင်း
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/addCustomer.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ဖောက်သည်သစ်ပေါင်းထည့်ရန်</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/bigcustomer.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ဖောက်သည်စာရင်းကြည့်ရန်</p>
                  </a>
                </li>
                </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                  ဝန်ထမ်း စာရင်း
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/addStaff.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ဝန်ထမ်းသစ်ပေါင်းထည့်ရန်</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/staff.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ဝန်ထမ်းစာရင်းကြည့်ရန်</p>
                  </a>
                </li>
                </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  အကြွေး စာရင်း
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/credit.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ပေးရန်ကျန်စာရင်း</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>-</p>
                  </a>
                </li>
                </ul>
            </li>
            <li class="nav-item">
              <a href="pages/voucher.php" class="nav-link ">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  ဘောင်ချာ

                </p>
              </a>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: #CFECEC">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">လက်ကား အရောင်း</h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <form id="dataForm"> 
      <div class="d-lg-flex align-items-top justify-content-between">
        <div>
        <div class="form-res">
          <form id="dataForm">
            <table >

            <tr class="table-column label-mb">
                <td class="td-reduce-padding"><p class="text-nowrap label">BarCode:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="barcode" id="barcode" oninput="sendData()" autofocus></td>         
              </tr>

              <?php

              include 'database.php';

              // Create connection
              $connection = new mysqli($servername, $username, $password, $database);

              // Check connection
              if ($connection->connect_error) {
                  die("Connection failed: " . $connection->connect_error);
              }

              //check_3
              // Assuming the table name is 'your_table_name' and you're ordering by 'id' to get the last record
              $sql = "SELECT * FROM sell_data ORDER BY id DESC LIMIT 1";
              $result = $connection->query($sql);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $last_voucher = $row['voucher']+1;
                      echo '
                      <tr class="table-column label-mb">
                <td class="td-reduce-padding"><p class="text-nowrap label">Voucher</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="rate"  id="orderNumber"  value="'.$last_voucher.'"></td>         
              </tr>
                      
                      ';


                  }
              } else {
                  echo "0 results";
              }

              $connection->close();
              ?>

              

              <!-- Voucher ID -->
              

              <tr class="table-column label-mb">
                <td class="td-reduce-padding"><p class="text-nowrap label">လျော့ဈေး</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="discount" id="discount"></td>         
              </tr>

              <tr class="table-column label-mb">
              <td class="td-reduce-padding"><p class="text-nowrap label">ငွေချေစနစ်: </p></td>
              <td class="td-reduce-padding w-100">
                <select class="w-100" id='payment'>
                        <option value="အကြွေး">အကြွေး</option>
                        <option value="လက်ငင်း">လက်ငင်း</option>
                </select>
              </td>
            </tr>

              <tr class="table-column label-mb">
              <td class="td-reduce-padding"><p class="text-nowrap label">Customer</p></td>
              <td class="td-reduce-padding w-100">
                <select class="w-100" id='customer'>

                <?php
                include 'database.php';

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                    die("ERROR: Could not connect. " . $connection->connect_error);
                }

                    $sql = "SELECT * FROM customer";
                    $result = $connection->query($sql);
                    if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $customer = $row['name']; //Database
                        echo '
                        <option value='.$customer.'>'.$customer.'</option>
                        ';                               
                    }
                }

                $connection->close();
                ?>

                </select>
              </td>
            </tr>

              <tr class="table-column label-mb">
                <td class="td-reduce-padding"><p class="text-nowrap label">နောက်ဆုံးငွေချေရက်</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="date" name="date" id="date"></td>         
              </tr>

              <tr class="table-column label-mb">
                <td class="td-reduce-padding"><p class="text-nowrap label">Rate:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="rate" id="rate"></td>         
              </tr>

            </table>
            <div class="d-md-flex justify-content-between align-items-center mb-3 mt-2">
              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"><button type="button" class="btn btn-primary btn-sm submit" value="refresh" id="print">Print</button></div>
              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"><button type="button" class="btn btn-primary btn-sm submit" value="refresh" id="reset">Delete</button></div>

              <?php

              include 'database.php';

              // Create connection
              $connection = new mysqli($servername, $username, $password, $database);

              // Check connection
              if ($connection->connect_error) {
                  die("Connection failed: " . $connection->connect_error);
              }

              // Assuming the table name is 'your_table_name' and you're ordering by 'id' to get the last record
              $sql = "SELECT * FROM sell_data ORDER BY id DESC LIMIT 1";
              $result = $connection->query($sql);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $last_voucher = $row['voucher'] + 1;
                     
                      echo '
                      <script>
                  let currentOrderNumber = '.$last_voucher.';
                  const orderButton = document.getElementById("reset");
                  const orderInput = document.getElementById("orderNumber");

                  orderButton.addEventListener("click", () => {

                      currentOrderNumber++;
                      orderInput.value = currentOrderNumber;
                  });
              </script>
                      
                      ';


                  }
              } else {
                  echo "0 results";
              }

              $connection->close();
              ?>


              

              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"> <button type="button" class="btn btn-primary btn-sm submit" value="refresh" id="submit" onclick="addRow()">Total</button></div>
            </div>
            
            <div class="d-md-flex justify-content-between align-items-center mb-3 mt-2">
              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"><button type="button" class="btn btn-primary btn-sm submit" id="">kyat</button></div>
              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"><button type="button" class="btn btn-primary btn-sm submit" id="" onclick="baht()">Baht</button></div>
              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"> <button type="button" class="btn btn-primary btn-sm submit" id="" onclick="yuan()" >Yuan</button></div>
              
              <!-- convert to Bath -->
              <!-- check_1 -->
              <?php 
                include 'database.php';
                          
                $connection = new mysqli($servername, $username, $password, $database);
                          
                if ($connection->connect_error) {
                    die("ERROR: Could not connect. " . $connection->connect_error);
                }


            // Check if the browser ID is already stored in the session
            if (isset($_SESSION['browser_id'])) {
                $browserId = $_SESSION['browser_id'];
            } else {
                // Generate a new browser ID
                $browserId = generateUniqueBrowserId();

                // Store the browser ID in the session for future use
                $_SESSION['browser_id'] = $browserId;
            }

            //echo "Browser ID: " . $browserId;
            $b_id = $browserId;
            $sql = "SELECT * FROM user_database WHERE browser_id='$b_id'";
            $result = $connection->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //$user_id = $row['user_name'];
                    $user_id = $row['user_name'];

                    $query = "SELECT sum(total) as total_sum FROM `$user_id`";
                    $result = $connection->query($query);
                    
                    // Initialize $total to a default value
                    $total = 0;

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $total = $row['total_sum'];
                    }

                    // Close the connection
                    $connection->close();


                }
            }
                          
                
            ?>

            <script>
                // Declare a JavaScript variable to hold the value of $total from PHP
                var totalFromPHP = <?php echo json_encode($total); ?>;

                // Event listener for the "Enter" key
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter' || event.keyCode === 32) {
                        baht();
                    }
                });

                function baht() {
                    // Get the table's tbody element
                    const tbody = document.getElementById('total_table').getElementsByTagName('tbody')[0];

                    let rate = document.getElementById("rate").value;
                    console.log(rate);

                    // Calculate the total in baht
                    let totalInBaht = totalFromPHP * rate;

                    // Create a new row and cells
                    const newRow = tbody.insertRow();
                    const cell1 = newRow.insertCell(0);
                    const cell2 = newRow.insertCell(1);

                    // Add data to the cells
                    cell1.innerHTML = 'Total';
                    cell2.innerHTML = `<b>${totalInBaht} Baht</b>`;
                }

                function yuan() {
                    // Get the table's tbody element
                    const tbody = document.getElementById('total_table').getElementsByTagName('tbody')[0];

                    let rate = document.getElementById("rate").value;
                    console.log(rate);

                    // Calculate the total in baht
                    let totalInYuan = totalFromPHP * rate;

                    // Create a new row and cells
                    const newRow = tbody.insertRow();
                    const cell1 = newRow.insertCell(0);
                    const cell2 = newRow.insertCell(1);

                    // Add data to the cells
                    cell1.innerHTML = 'Total';
                    cell2.innerHTML = `<b>${totalInYuan} Yuan</b>`;
                }



            </script>



              
              


              
            </div>
          </form>

           

            <script>
                const button = document.getElementById('reset');
                button.addEventListener('click', function() {
                    if(confirm("Are you sure you want to delete all records? This action cannot be undone.")) {
                        fetch('index2_delete_db.php')
                        .then(response => response.text())
                        .then(data => {
                            if(data === 'success') {
                                alert('All records deleted successfully.');
                            } else {
                                alert('Error deleting records.');
                            }
                        });
                    }
                });

                const button_print = document.getElementById('print');

                button_print.addEventListener('click', function() {
                  window.location.href = 'index2_mini_print.php';
                });


            </script>
            
          
            <!-- <input type="button" value="refresh" id="submit"> -->
          </form>



          <script>
    function sendData() {
        const barcode = document.getElementById('barcode').value;
        const orderNumber = document.getElementById('orderNumber').value;
        const discount = document.getElementById('discount').value;
        const payment = document.getElementById('payment').value;
        console.log(payment)
        const customer = document.getElementById('customer').value;
        console.log(customer)
        const date = document.getElementById('date').value;
        console.log(date)
        const rate = document.getElementById('rate').value;

        const product_name_input = document.getElementById('product_name');
        const package_price_input = document.getElementById('package_price'); 
        const unit_price_input = document.getElementById('unit_price'); 
        const pieces_price_input = document.getElementById('pieces_price'); 
        
        //check1
        if (barcode) {
          document.getElementById("barcode").value = "";
            fetch('index2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    barcode: barcode,
                    orderNumber: orderNumber,
                    discount: discount,
                    payment: payment,
                    customer: customer,
                    date: date,
                    rate: rate

                })
            })
            .then(response => response.json())
            .then(data => {
                //console.log(data);
                product_name_input.value = data.product_name;
                package_price_input.value = data.package_price;
                unit_price_input.value = data.unit_price;
                pieces_price_input.value = data.pieces_price;
                //Fix
                document.getElementById("barcode").value = "";
                //window.location.reload();
            })
            .catch(error => {
                //console.error('There was an error!', error);
            });
        }
    }

    function focusOnInput() {
                  // Using JavaScript to set focus
                  document.getElementById("barcode").focus();
              }
    </script>

        </div>
            </div>

        <?php
    if (isset($_GET['fetch_data'])) {
        header('Content-Type: application/json');

        include 'database.php';

        $connection = new mysqli($servername, $username, $password, $database);
        
        if ($connection === false) {
            die(json_encode(["error" => "Could not connect. " . mysqli_connect_error()]));
        }

        $query = "SELECT * FROM sell_database";
        $result = mysqli_query($connection, $query);

        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        echo json_encode($data);

        mysqli_close($connection);
        exit;
    }
?>
        
        <div class="table standard-padding">
          <section class="table__body">



        <div id='table'>
      
    </div>

    <!-- when click change bath/yon  -->
    <table id='total_table'>
    
      <tbody>
      
  </tbody>

    </table>
    <?php 
                include 'database.php';
                          
                $connection = new mysqli($servername, $username, $password, $database);
                          
                if ($connection->connect_error) {
                    die("ERROR: Could not connect. " . $connection->connect_error);
                }
                          
                $query = "SELECT sum(total) as total_sum FROM sell_database";
                $result = $connection->query($query);
                
                // Initialize $total to a default value
                $total = 0;

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $total = $row['total_sum'];
                }

                // Close the connection
                $connection->close();
            ?>

<script>
                    // Event listener for the "Enter" key
                    document.addEventListener('keydown', function(event) {
                        if (event.key === 'Enter' || event.keyCode === 32) {
                            addRow();
                        }
                    });

                    function addRow() {
                        // Get the table's tbody element
                        const tbody = document.getElementById('total_table').getElementsByTagName('tbody')[0];

                        // Create a new row and cells
                        const newRow = tbody.insertRow();
                        const cell1 = newRow.insertCell(0);
                        const cell2 = newRow.insertCell(1);

                        // Add data to the cells
                        cell1.innerHTML = 'Total';
                        cell2.innerHTML = "<?php echo '<b>' . $total . ' Baht</b>'; ?>";

                    }
                </script>

            
                


          </section>
        </div>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>



<?php
include '../database.php';
// include '../sidebar.php';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}

include "login_check.php";
include "cal_voucher.php";


?>


<?php
if (isset($_POST['add'])) {

  include 'database.php';
  $connection = new mysqli($servername, $username, $password, $database);
  
  if ($connection->connect_error) {
      die("ERROR: Could not connect. " . $connection->connect_error);
  }
  
  // Check the connection
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }
  
      // Perform a database query to check if the browser ID exists in the user_database table


        $sql = "SELECT * FROM user_database WHERE browser_id='$b_id'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
            $name = $_POST['name'];
            $voucher = $_POST['voucher'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $receive_name = $row['user_name'];
            echo $receive_name;
            //$receive_name = 'user_1';
            // $sql = "SELECT * FROM sell_data WHERE buy_type='လက်ကား' ORDER BY id DESC LIMIT 1;";
            //   $result = $connection->query($sql);
            //   if ($result->num_rows > 0) {
            //       while($row = $result->fetch_assoc()) {                   
            //           $last_voucher = $row['voucher']+1;

            //       }
            //     }

            
            $sql = "SELECT * FROM voucher where voucher_no='$voucher'";
            $result = $connection->query($sql);
            if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $payable = $row['payable'];
              if ($payable < $amount){
                echo '<script>alert("ပေးရန် ပမာဏထက် ကျော်လွန်နေပါသည်၊ ကျန်ငွေ - '.$payable.'") ;</script>';

              }
              else{

                //search Name
                $sql = "SELECT customer FROM sell_data where voucher ='$voucher'";
                $result = $connection->query($sql);
                if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $customer = $row['customer'];



                $sql = "INSERT INTO payment (name, voucher, amount, date,receive_name)
                VALUES ('$customer','$voucher','$amount','$date','$receive_name')";

                if (mysqli_query($connection, $sql)) {
                    header('location:customer_payment.php');
                    echo '<script>alert("Add New Customer Success") ;</script>';
                    // echo "Insert successful";
                } else {
                    echo "Error: " . $sql . "
            " . mysqli_error($connection);
                }
              }
            }
                mysqli_close($connection);
                
              }         
            }
        
            }else{
              echo '<script>alert("Vocher No Not Found!") ;</script>';
              echo '<script>window.location = "customer_payment.php";</script>';
                       
            }
        }
    }

    }




?>

<?php
if (isset($_POST['search'])) {


            $voucher = $_POST['voucher'];
   
            $sql = "SELECT * FROM voucher where voucher_no='$voucher'";
            $result = $connection->query($sql);
            if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $payable = $row['payable'];
                $customer_name = $row['customer_name'];
                echo '<script>alert("နာမည်-'.$customer_name.'\n ပေးရန်ကျန်ငွေ '.$payable.'") ;</script>';

            }
        
            }else{
              echo '<script>alert("Voucher နံပါတ်မှားယွင်းနေပါသည်") ;</script>';
              echo '<script>window.location = "customer_payment.php";</script>';
                       
            }

  
          }




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>London Shop | ဝန်ထမ်း စာရင်း</title>
  <link rel="stylesheet" href="../style1.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
<?php 
    include '../sidebar.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #CFECEC">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ငွေချေရန်</h1>
          </div><!-- /.col -->
          <div class="input-group search-width mb-0 ml-auto" data-widget="content-wrapper-search">
              <div class="input-group mb-0 margin-l-10">
                <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary border-0" type="button" id="button-addon2">
                    <i class="fas fa-search fa-fw"></i>
                  </button>
                </div>
                </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <div class="d-lg-flex align-items-top justify-content-between">
      <div class="w-50">
      <div class="form-res form-width   ">
        <form method="POST" action="customer_payment.php">
            <table>
            
                       
              <!-- <tr class="table-column label-mb">
              <td class="td-reduce-padding"><p class="text-nowrap label">အမည် :</p></td>
              <td class="td-reduce-padding w-100">
                <select class="w-100" id='name' name="name">

                <?php
                // include 'database.php';

                // $connection = new mysqli($servername, $username, $password, $database);

                // if ($connection->connect_error) {
                //     die("ERROR: Could not connect. " . $connection->connect_error);
                // }

                //     $sql = "SELECT * FROM customer";
                //     $result = $connection->query($sql);
                //     if ($result && $result->num_rows > 0) {
                //     while ($row = $result->fetch_assoc()) {
                //         $customer = $row['name']; //Database
                //         echo '
                //         <option value="' . $customer . '">' . $customer . '</option>
                //         ';                               
                //     }
                // }
                ?>
                </select>
              </td>
                </tr> -->


              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">Voucher :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="voucher"></td>
              </tr>

              

              </tr>

              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ငွေချေပမာဏ :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="amount"></td>
              </tr>
              

              
              <?php
              $today = date("Y-m-d");
              echo '
              <tr class="table-column label-mb">
              <td class="td-reduce-padding "><p class="text-nowrap label">ရက်စွဲ :</p></td>
              <td class="td-reduce-padding w-100"><input class="w-100" type="date" name="date" value='.$today.'></td>
              </tr>
              ';
              ?>

              <!-- <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ပေးရန်ကျန်ငွေ :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-250" type="text" name="remain" id="remain"></td>
              </tr> -->

              <?php
                if (isset($_POST['search'])) {

                  
                      $voucher_no = $_POST['voucher'];
                  
                      $sql = "SELECT * FROM voucher where voucher_no='$voucher_no'";
                      $result = $connection->query($sql);
                      if ($result && $result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $remain = $row['total']; //Database
                          echo "<script>alert('ပေးရန်ကျန်ငွေ".$remain."')</script>";
                        //   echo '
                        //   <script>
                        //     let inputElement = document.getElementById("remain");
                        //     inputElement.value = "'.$remain.'";
                        // </script>
                        //   ';
                      }
                    }                      
                    }

                ?>


           
              
            </table>
            <!-- button -->
            <div class="d-md-flex justify-content-between align-items-center mb-3 mt-2">
              <div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="submit" class="btn btn-primary btn-sm submit" name="add">ပေါင်းထည့်ရန်</button></div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="submit" class="btn btn-primary btn-sm submit">ပြင်ရန်</button></div>
              </div>
              <div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="submit" class="btn btn-primary btn-sm submit" name="search">ရှာရန်</button></div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"> <button type="button" class="btn btn-primary btn-sm submit" >reset</button></div>
              </div>

            </div>
            <!-- <input type="button" value="refresh" id="submit"> -->
          </form>
      </div>
</div>
      <div class="table standard-padding">

        <section class="table__body tScope">

          <table class="table table-md-responsive">
            <thead>
              <tr>
              <th>နာမည်</th>
                <th>ပေါင်ချာ</th>
                <th>ငွေချေပမာဏ</th>
                <th>ရက်စွဲ</th>
                <th>လက်ခံသူအမည်</th>
                <th>အမှတ်စဉ်</th>
                <th>ဖျက်ရန်</th>
              </tr>
            </thead>
            <tbody>
        

            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
                $id = $connection->real_escape_string($_POST["id"]);

                $query = "DELETE FROM payment WHERE id = '$id'";
                if ($connection->query($query)) {
                    http_response_code(200);
                } else {
                    http_response_code(500);
                }
              }
    
        $sql = "Select * from payment";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // $id=$row['no'];
                $name = $row['name'];
                $voucher = $row['voucher'];
                $amount = $row['amount'];
                $date = $row['date'];
                $receive_name = $row['receive_name'];
                $id = $row['id'];
                echo '<tr>
                        <td>' . $name. '</td>
                        <td>' . $voucher . '</td>
                        <td>' . $amount . '</td>
                        <td>' . $date . '</td>
                        <td>' . $receive_name . '</td>
                        <td>' . $id . '</td>
                        <td><button onclick="deleteRow(this)">Delete</button></td>
                      </tr>';
            }
            mysqli_free_result($result);
        }
        ?>
        <script>
            function deleteRow(button) {
            const row = button.parentNode.parentNode;
            const id = row.cells[5].textContent; // Assuming the Product ID is in the first column (index 0)
          
            // Send the tra_id to the backend PHP script using AJAX for deletion
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'customer_payment.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  row.parentNode.removeChild(row); // Remove the row from the table on successful deletion
                  alert('Data deleted successfully!');
                } else {
                  alert('Error deleting data. Please try again.');
                }
              }
            };
            xhr.send('id=' + encodeURIComponent(id));     
            
          }
        </script>

     

            </tbody>
          </table>
        </section>
      </div>
    </div>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>

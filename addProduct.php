<?php
include 'database.php';
include "cal_pro_remain.php";
include "login_check.php";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}
//include "login_check.php";
?>
<?php
if (isset($_POST['add'])) {
    $barcode = $_POST['barcode'];
    $product_name = $_POST['product_name'];
    $unit = $_POST['unit'];
    $pieces = $_POST['pieces'];
    $buy = $_POST['buy'];
    $rate = $_POST['rate'];
    $trans = $_POST['trans'];
    $currency_rate = $_POST['currency_rate'];
    $currency_buy = $_POST['currency_buy'];
    $profit = $_POST['profit'];


    function roundUpToNearestHundred($number) {
      return ceil($number / 100) * 100;
    }

    $package_price = ($buy / $rate) + $trans + $profit;
    $unit_price = $package_price/$unit;
    $pieces_price = $unit_price/$pieces;

    $round_package_price = roundUpToNearestHundred($package_price);
    $round_unit_price = roundUpToNearestHundred($unit_price);
    $round_pieces_price = roundUpToNearestHundred($pieces_price);

    $package_fix_price = roundUpToNearestHundred($package_price);
    $unit_fix_price = roundUpToNearestHundred($unit_price);
    $pieces_fix_price = roundUpToNearestHundred($pieces_price);
    

    $package_remain = $_POST['package_remain'];
    $pieces_remain = $_POST['pieces_remain'];
    $unit_remain = $_POST['unit_remain'];

    $expire_date = $_POST['expire_date'];
    $profit = $_POST['profit'];

    $package_exist = ('0');
    $unit_exist = ('0');
    $package_exist = ('0');

    // $sql = "SELECT * FROM product where barcode='$barcode'";
    // $result = $connection->query($sql);
    // if ($result && $result->num_rows > 0) {
    // while ($row = $result->fetch_assoc()) {
    //       echo '<script>alert("Barcode Already Exist")</script>';
                 
    //     }      
    // }
    // else{
      $sql = "INSERT INTO product (barcode, product_name, unit, pieces, buy, rate, trans,round_package_price,round_unit_price,round_pieces_price,package_price,unit_price,pieces_price,package_fix_price,unit_fix_price,pieces_fix_price,package_remain,unit_remain,pieces_remain,package_exist,unit_exist,pieces_exist,exp_date,profit,currency_rate,currency_buy)
      VALUES ('$barcode','$product_name','$unit','$pieces','$buy','$rate','$trans','$round_package_price','$round_unit_price','$round_pieces_price','$package_price','$unit_price','$pieces_price','$package_fix_price','$unit_fix_price','$pieces_fix_price','$package_remain','$unit_remain','$pieces_remain','$package_exist','$unit_exist','$pieces_exist','$exp_date','$profit','$currency_rate','$currency_buy')";

      if (mysqli_query($connection, $sql)) {
          header('location:addProduct.php');
          // echo "Insert successful";
      } else {
          echo "Error: " . $sql . "
        " . mysqli_error($connection);
            }
    



    mysqli_close($connection);
  }
  // }
    

    

?>

<?php 
if (isset($_POST['change_currency'])) {

  $barcode = $_POST['barcode'];
  $product_name = $_POST['product_name'];
  $unit = $_POST['unit'];
  $pieces = $_POST['pieces'];
  $buy = $_POST['buy'];
  $rate = $_POST['rate'];
  $trans = $_POST['trans'];
  $currency_rate = $_POST['currency_rate'];
  $currency_buy = $_POST['currency_buy'];
  $profit = $_POST['profit'];

  
  $sql = "UPDATE product SET rate='$rate' where currency_rate='$currency_rate'";
  header('location:addProduct.php');
  //$sql = "UPDATE product SET barcode='$barcode' WHERE id='$no'";

  if ($connection->query($sql) === TRUE) {
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

        }
      }

?>

<?php 
if (isset($_POST['add_exist'])) {

  $barcode = $_POST['barcode'];
  $product_name = $_POST['product_name'];
  $unit = $_POST['unit'];
  $pieces = $_POST['pieces'];
  $buy = $_POST['buy'];
  $rate = $_POST['rate'];
  $trans = $_POST['trans'];
  $currency_rate = $_POST['currency_rate'];
  $currency_buy = $_POST['currency_buy'];
  $profit = $_POST['profit'];
  $package_remain_entry= $_POST['package_remain'];
  $unit_remain_entry= $_POST['unit_remain'];
  $pieces_remain_entry= $_POST['pieces_remain'];


  $sql = "SELECT package_remain,unit_remain,pieces_remain FROM product where barcode='$barcode'";
  $result = $connection->query($sql);
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $package_remain = $row['package_remain'];
    $unit_remain = $row['unit_remain'];
    $pieces_remain = $row['pieces_remain'];

    $package_remain_total = $package_remain + $package_remain_entry;
    $unit_remain_total = $unit_remain + $unit_remain_entry;
    $pieces_remain_total = $pieces_remain + $pieces_remain_entry;

    $stmt = $connection->prepare("UPDATE product SET package_remain=?, unit_remain=?, pieces_remain=? WHERE barcode=?");
    $stmt->bind_param("iiis", $package_remain_total, $unit_remain_total, $pieces_remain_total, $barcode);
    if ($stmt->execute()) {
        echo '<script>alert("Update Success") ;</script>';
        header('location:addProduct.php');
        //include "../cal_pro_remain.php";
    } else {
        echo '<script>alert("Update Error: ' . $stmt->error . '") ;</script>';
    }

  
  }
}
}

  

  // $sql = "UPDATE product SET rate='$rate' where currency_rate='$currency_rate'";
  // //$sql = "UPDATE product SET barcode='$barcode' WHERE id='$no'";
  // if ($connection->query($sql) === TRUE) {
  //   function roundUpToNearestHundred($number) {
  //     return ceil($number / 100) * 100;
  //     }
    

  //     $sql = "SELECT product_name, unit, pieces, buy, rate, trans, package_price, profit FROM product";
  //     $result = $connection->query($sql);
  //     if ($result && $result->num_rows > 0) {

  //         $stmt = $connection->prepare("UPDATE product SET package_price=?, unit_price=?, pieces_price=?, round_package_price=?, round_unit_price=?, round_pieces_price=? WHERE product_name=?");
  //         while ($row = $result->fetch_assoc()) {
  //             $unit = $row['unit']; 
  //             $pieces = $row['pieces']; 
  //             $buy = $row['buy'];
  //             $rate = $row['rate']; 
  //             $trans = $row['trans']; 
  //             $profit = $row['profit'];
  //             $product_name = $row['product_name'];

  //             $package_price = (($buy / $rate) + $trans) + $profit;
  //             $unit_price = $package_price/$unit;
  //             $pieces_price = $unit_price/$pieces;
  //             $round_package_price = roundUpToNearestHundred($package_price);
  //             $round_unit_price = roundUpToNearestHundred($unit_price);
  //             $round_pieces_price = roundUpToNearestHundred($pieces_price);

  //             $stmt->bind_param("dddddds", $package_price, $unit_price, $pieces_price, $round_package_price, $round_unit_price, $round_pieces_price, $product_name);
  //             if (!$stmt->execute()) {
  //                 echo json_encode(['status' => 'error', 'message' => 'Error updating record: ' . $connection->error]);
  //             }
  //         }
  //         $stmt->close();
  //         header('location:addProduct.php');
  //         exit();
  //     } else {
  //         // Handle case when no records are found or other issues
  //     }

  //       }
  //     }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>London Shop | ဝန်ထမ်း စာရင်း</title>
  <link rel="stylesheet" href="style1.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
  <?php 
    include 'sidebar.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #CFECEC">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ပစ္စည်းစာရင်းပေါင်းထည့်ရန်</h1>
          </div><!-- /.col -->

          <div class="input-group search-width mb-0 ml-auto" data-widget="content-wrapper-search">
              <div class="input-group mb-0 margin-l-10">

                <input type="text" id="searchInput" class="form-control" placeholder="Search">
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
      <div>
      <div class="form-res ">
        <form method="POST" action="addProduct.php">
            <table>
              <tr class="table-column label-mb ">
                <td class="td-reduce-padding "><p class="text-nowrap label">Bar Code:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="barcode" value='1'></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ပစ္စည်းအမည်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="product_name" value='1'></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ကဒ်အရေအတွက်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="unit" value='1'></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဗူးအရေအတွက် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="pieces" value='1'></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဖာလိုက် ဝယ်ဈေး :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-50" type="text" name="buy" value='1'>

                    <select name="currency_rate" id="cars" class="w-20">                       
                        <option value="Baht" name="purchase_baht">ဘတ်</option>
                        <option value="Kyat" name="purchase_kyat">ကျပ်</option>
                        <option value="Yuan" name="purchase_yuan">ယွမ်</option>

                      </select></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ငွေဈေးနှုန်း:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-50" type="text" name="rate" value='1'>
                    <select name="currency_buy" id="cars" class="w-20">
                    <option value="Baht" name="purchase_baht">ဘတ်</option>
                        <option value="Kyat" name="purchase_kyat">ကျပ်</option>
                        <option value="Yuan" name="purchase_yuan">ယွမ်</option>

                  </select></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">သယ်ဆောင်ခ:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="trans" value='0'></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဖာလိုက်လက်ကျန်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="package_remain" value='0'></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ကဒ်လိုက်လက်ကျန်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="unit_remain" value='0'></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဗူးလိုက်လက်ကျန်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="pieces_remain" value='0'></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ကုန်ဆုံးရက် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="date" name="expire_date"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">အမြတ် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="profit" value='0'></td>
              </tr>

            </table>
            <div class="d-md-flex justify-content-center align-items-center mb-3 mt-2">
              <div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="submit" class="btn btn-primary btn-sm submit1" name="add_exist">ပေါင်းထည့်ရန်</button></div>
              </div>
</div>
<div class="d-md-flex justify-content-center align-items-center mb-3 mt-2">
              <div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="submit" class="btn btn-primary btn-sm submit1" name="change_currency">ငွေဈေးပြောင်းရန်</button></div>
              </div>
</div>
<div class="d-md-flex justify-content-center align-items-center mb-3 mt-2">
              <div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="submit" class="btn btn-primary btn-sm submit1" name="add">ပစ္စည်းသစ်ပေါင်းထည့်ရန်</button></div>
                <!-- <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"> <button type="button" class="btn btn-primary btn-sm submit" >reset</button></div> -->
              </div>

            </div>
            <!-- <input type="button" value="refresh" id="submit"> -->
          </form>
      </div>
</div>
      <div class="table standard-padding">

        <section class="table__body tScope">

        <?php
            include 'database.php';
            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die("ERROR: Could not connect. " . $connection->connect_error);
            }

            $dataArray = [];

            $sql = "SELECT * FROM product ORDER BY id DESC";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $dataArray[] = $row;
                }
                mysqli_free_result($result);
            }
            ?>

          <table class="table table-md-responsive" id="dataTable">
            <thead>
              <tr>
                <th class="fixed-column">no</th>
                <th class="fixed-column-2">barcode</th>
                <th class="fixed-column-3">ပစ္စည်းအမည်</th>
                <th>ကဒ်အရေအတွက်</th>
                <th>ဗူးအရေအတွက်</th>
                <th>ဝယ်ဈေး</th>
                <th></th>
                <th>ငွေဈေး</th>
                <th></th>
                <th>သယ်ဆောင်ခ</th>

                <th>ဖာလိုက်‌ရောင်းဈေး</th>
                <th>ဖာလိုက်‌မူရင်းဈေး</th>

                <th>ကဒ်လိုက်ရောင်းဈေး</th>
                <th>ကဒ်လိုက်‌မူရင်းဈေး</th>

                <th>ဗူးလိုက်ရောင်းဈေး</th>
                <th>ဗူးလိုက်‌မူရင်းဈေး</th>

                <th>စုစုပေါင်း(ဖာ)</th>
                <th>ရောင်းပြီး (ဖာ)</th>
                <th style="color:red">လက်ကျန် (ဖာ)</th>

                <th>စုစုပေါင်း(ကဒ်)</th>
                <th>ရောင်းပြီး (ကဒ်)</th>
                <th style="color:red">လက်ကျန် (ကဒ်)</th>

                <th>စုစုပေါင်း(ဗူး)</th>               
                <th>ရောင်းပြီး (ဗူး)</th>
                <th style="color:red">လက်ကျန် (ဗူး)</th>

                <th>အမြတ်</th>
                
                
                
              </tr>
            </thead>
            <tbody>
        
          

        <?php
        foreach ($dataArray as $row) {

        echo '<tr>
                <td contenteditable="true" class="fixed-column">' . htmlspecialchars($row['id']) . '</td>          
                <td contenteditable="true" class="fixed-column-2">' . htmlspecialchars($row['barcode']) . '</td>
                <td contenteditable="true" class="fixed-column-3">' . htmlspecialchars($row['product_name']) . '</td>
                <td contenteditable="true">' . htmlspecialchars($row['unit']) . '</td>
                <td contenteditable="true">' . htmlspecialchars($row['pieces']) . '</td>                
                <td contenteditable="true">' . htmlspecialchars($row['buy']) . '</td>
                <td contenteditable="true">' . htmlspecialchars($row['currency_buy']) . '</td>
                <td contenteditable="true" style="color:red;">' . htmlspecialchars($row['rate']) . '</td>
                <td contenteditable="true" style="color:red;">' . htmlspecialchars($row['currency_rate']) . '</td>
                <td contenteditable="true">' . htmlspecialchars($row['trans']) . '</td>
                <td contenteditable="true" style="color:orange;">' . htmlspecialchars($row['round_package_price']).'</td>
                <td contenteditable="true" style="color:green;">' . htmlspecialchars($row['package_price']) .' MMK</td>
                <td contenteditable="true" style="color:orange;">' . htmlspecialchars($row['round_unit_price']).'</td>
                <td contenteditable="true" style="color:green;">' . htmlspecialchars($row['unit_price']). ' MMK</td>
                <td contenteditable="true" style="color:orange;">' . htmlspecialchars($row['round_pieces_price']).'</td>
                <td contenteditable="true" style="color:green;">' . htmlspecialchars($row['pieces_price']) .' MMK</td>

                <td contenteditable="true" >'. htmlspecialchars($row['package_remain']) . '</td>
                <td contenteditable="true" >'. htmlspecialchars($row['package_sell']) . '</td>
                <td contenteditable="true" >'. htmlspecialchars($row['package_exist']) . '</td>

                <td contenteditable="true">' . htmlspecialchars($row['unit_remain']) . '</td>
                <td contenteditable="true">' . htmlspecialchars($row['unit_sell']) . '</td>
                <td contenteditable="true">' . htmlspecialchars($row['unit_exist']) . '</td>

                <td contenteditable="true">' . htmlspecialchars($row['pieces_remain']) . '</td>                
                <td contenteditable="true">' . htmlspecialchars($row['pieces_sell']) . '</td>              
                <td contenteditable="true">' . htmlspecialchars($row['pieces_exist']) . '</td>

                <td contenteditable="true">' . htmlspecialchars($row['profit']) . '</td>
                
                
                
              </tr>';
              }
             
          
          ?>





            <!-- Auto Update JS -->
            

            </tbody>
          </table>
          <script> 

          $(document).ready(function() {
              $("#searchInput").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  
                  $("#dataTable tbody tr").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                  });
              });
          });

          </script>

          <script>
                const editableCells = document.querySelectorAll('#dataTable td[contenteditable="true"]');

            editableCells.forEach(cell => {
                cell.addEventListener('input', function() {
                    saveChangesForRow(this.parentElement);  // this.parentElement refers to the row
                });
            });

            // Handle select dropdowns separately
            const dropdowns = document.querySelectorAll('#dataTable select');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('change', function() {
                    saveChangesForRow(this.closest('tr'));  // 'closest' gets the nearest parent row element
                });
            });

            function saveChangesForRow(row) {
                const data = {};
                console.log(data)

                for (let j = 0; j < row.cells.length; j++) {
                    const cell = row.cells[j];
                    if (cell && cell.hasAttribute('contenteditable')) {
                        const headerText = document.getElementById('dataTable').rows[0].cells[j].textContent;
                        data[headerText] = cell.textContent;
                    }

                    // Handle select dropdowns separately
                    if (cell.querySelector('select')) {
                        const headerText = document.getElementById('dataTable').rows[0].cells[j].textContent;
                        data[headerText] = cell.querySelector('select').value;  // Get the selected value

                    }
                }

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'addProduct_update.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log('Data updated successfully!');
                            } else {
                                alert('Error updating data. Please try again!.');
                            }
                        }
                    };
                    xhr.send(JSON.stringify(data));
                }
                </script>


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

<?php
include '../database.php';


$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
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
 <div class="content-wrapper" style="background-color: #CFECEC">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ပစ္စည်းစာရင်းပေါင်းထည့်ရန်</h1>
          </div><!-- /.col -->

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
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="barcode"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ပစ္စည်းအမည်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="product_name"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ကဒ်အရေအတွက်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="unit_count"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဗူးအရေအတွက် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="pieces_count"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဝယ်ဈေး(ကျပ်/ဘတ်/ယွမ်) :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-70" type="text" name="purchase_price">
                    <select name="ငွေဈေးနှုန်း" id="cars" class="w-20">
                        <option value="ကျပ်" name="purchase_kyat">ကျပ်</option>
                        <option value="ဘတ်" name="purchase_baht">ဘတ်</option>
                        <option value="ယွမ်" name="purchase_yuan">ယွမ်</option>

                      </select></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ငွေဈေးနှုန်း:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-70" type="text" name="money_rate">
                    <select name="ငွေဈေးနှုန်း" id="cars" class="w-20">
                    <option name="kyat_rate" value="kyat_rate">ကျပ်</option>
                    <option name="baht_rate" value="baht_rate">ဘတ်</option>
                    <option name="yuan_rate" value="yuan_rate">ယွမ်</option>

                  </select></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">သယ်ဆောင်ခ:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="deli_fee"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဖာလိုက်လက်ကျန်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="p_totalcount" ></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ကဒ်လိုက်လက်ကျန်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="c_totalcount"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဗူးလိုက်လက်ကျန်:</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="b_totalcount"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ကုန်ဆုံးရက် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="date" name="expire_date"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">အမြတ် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="profit"></td>
              </tr>

            </table>

            <div class="d-md-flex justify-content-between align-items-center mb-3 mt-2">
              <div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="submit" class="btn btn-primary btn-sm submit" name="add">ပေါင်းထည့်ရန်</button></div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="button" class="btn btn-primary btn-sm submit">ပြင်ရန်</button></div>
              </div>
              <div>
                <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-50"><button type="button" class="btn btn-primary btn-sm submit" >ရှာရန်</button></div>
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
              <th> No. </th>
                <th> barcode </th>
                <th> ပစ္စည်းအမည် </th>
                <th> အရေအတွက် </th>
                <th> ဝယ်ဈေး </th>
                <th> ရောင်းဈေး</th>
                <th> အမြတ်</th>
              </tr>
            </thead>
            <tbody>
        <?php
// $connection = new mysqli($servername, $username, $password, $database);

// if ($connection->connect_error) {
//      die("ERROR: Could not connect. " . $connection->connect_error);
//  }
$count_result = mysqli_query($connection, "select count(*) as total from product");
$count = mysqli_fetch_assoc($count_result)['total'];
mysqli_free_result($count_result);
$sql = "Select * from product ORDER BY no DESC";
$result = mysqli_query($connection, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // $id=$row['no'];
        $barcode = $row['barcode'];
        $product_name = $row['product_name'];
        $unit_count = $row['unit'];
        $buy = $row['buy'];
        $package_price = $row['package_price'];
        $profit = $row['profit'];
        echo '<tr>
                <td>' . $count-- . '</td>
                <td>' . $barcode . '</td>
                <td>' . $product_name . '</td>
                <td>' . $unit_count . '</td>
                <td>' . $buy . '</td>
                <td>' . $package_price . '</td>
                <td>' . $profit . '</td>
              </tr>';
    }
    mysqli_free_result($result);
}
?>

              <!-- <tr>
                <td> M 150 </td>
                <td> 1000</td>
                <td> M 150 </td>
                <td> 1000</td>
                <td> M 150 </td>
                <td> 1000</td>

              </tr> -->
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
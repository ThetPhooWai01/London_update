
<!DOCTYPE html>
<html lang="en">

<?php
include '../database.php';
// include '../sidebar.php';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}
include "login_check.php";
?>

<?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $ph_no = $_POST['ph_no'];
    $nrc = $_POST['nrc'];
    $father_name = $_POST['father_name'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];

    $sql = "SELECT * FROM staff where name='$name'";
    $result = $connection->query($sql);
    if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<script>alert("Already Exist") ;</script>';
        echo '<script>window.location = "addStaff.php";</script>';
    }

    }else{
      $sql = "INSERT INTO staff (name, ph_no,nrc,father_name,address,role,salary)
      VALUES ('$name','$ph_no','$nrc','$father_name','$address','$role','$salary')";

      if (mysqli_query($connection, $sql)) { 
          header('location:addStaff.php');
          echo '<script>alert("Add New Staff Success") ;</script>';
          // echo "Insert successful";
      } else {
          echo "Error: " . $sql . "
  " . mysqli_error($connection);
      }
      mysqli_close($connection);


    }
  }
    
  

//     $sql = "INSERT INTO customer (name, ph_no, address, role,total_buy,debt,pay,balance,remain_debt)
// 	  VALUES ('$name','$ph_no','$address','$role','$total_buy','$debt','$pay','$balance','$remain_debt')";

//     if (mysqli_query($connection, $sql)) {
//         header('location:addCustomer.php');
//         // echo "Insert successful";
//     } else {
//         echo "Error: " . $sql . "
// " . mysqli_error($connection);
//     }
//     mysqli_close($connection);
// }
?>

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
            <h1 class="m-0">ဝန်ထမ်းသစ်စာရင်း ထည့်ရန်</h1>
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
      <div class="form-res  form-width">
        <form method="POST" action="addStaff.php">
            <table>
              <tr class="table-column label-mb ">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဝန်ထမ်းအမည် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="name"></td>
              </tr>
              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">ဖုန်းနံပါတ် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="ph_no"></td>
              </tr>

              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">မှတ်ပုံတင်နံပါတ် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="nrc"></td>
              </tr>

              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">အဖအမည် :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="father_name"></td>
              </tr>

              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">နေရပ်လိပ်စာ :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="address"></td>
              </tr>

              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">Role :</p></td>
                <td class="td-reduce-padding w-100">
                    <select name="role" id="cars" class="w-100">
                        <option value="Broze" name="purchase_kyat">အရောင်း</option>
                        <option value="Silver" name="purchase_baht">မန်နေဂျာ</option>
                        <option value="Gold" name="purchase_yuan">စာရေး</option>
                      </select></td>
              </tr>        

              <tr class="table-column label-mb">
                <td class="td-reduce-padding "><p class="text-nowrap label">သတ်မှတ်လစာ :</p></td>
                <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="salary"></td>
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
      <div class="table standard-padding mr-3">

        <section class="table__body tScope">

          <table class="table table-md-responsive">
            <thead>
              <tr>
              <th>နာမည်</th>
              <th>ဖုန်းနံပါတ်</th>
              <th>မှတ်ပုံတင်အမှတ်</th>
              <th>အဖအမည်</th>
              <th>လိပ်စာ</th>
              <th>role</th>
              <th>သတ်မှတ်လစာ</th>
              </tr>
            </thead>
            <tbody>
        

            <?php
        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("ERROR: Could not connect. " . $connection->connect_error);
        }


        
        $sql = "Select * from staff";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // $id=$row['no'];
                $name = $row['name'];
                $ph_no = $row['ph_no'];
                $nrc = $row['nrc'];
                $father_name = $row['father_name'];
                $address = $row['address'];
                $role = $row['role'];
                $salary = $row['salary'];

                echo '<tr>
                        <td>' . $name . '</td>
                        <td>' . $ph_no . '</td>
                        <td>' . $nrc . '</td>
                        <td>' . $father_name . '</td>
                        <td>' . $address . '</td>
                        <td>' . $role . '</td>
                        <td>' . $salary . '</td>
                      </tr>';
            }
            mysqli_free_result($result);
        }
        ?>

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

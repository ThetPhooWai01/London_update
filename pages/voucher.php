<?php
    include '../database.php';
    include 'login_check.php';
   

      $connection = new mysqli($servername, $username, $password, $database);
                              
       if ($connection->connect_error) {
        die("ERROR: Could not connect. " . $connection->connect_error);
                    }
    if(isset($_GET['deleteid']))
    {	 
      $id=$_GET['deleteid'];
      $sql="delete from product where no=$id";
    
      $result=mysqli_query($connection,$sql);
      if($result){ 
        header('Location: kyatProduct.php');
        
      }else{
        die(mysqli_error($connection));
      }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>London Shop | ပေါင်ချာစာရင်း</title>
  <link rel="stylesheet" href="../style1.css">
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
 
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
    include "cal_voucher.php";
    //include "login_check.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #CFECEC">
    <!-- Content Header (Page header) -->
    <div class="content-header mb-0">
      <div class="container-fluid">
        <div class="row mb-2 d-flex flex-column align-items-between">
          <div class=" mb-4 mx-2">
            <h1 class="m-0">ပေါင်ချာ</h1>
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

    <!-- Main content -->
    <div class="d-lg-flex align-items-top justify-content-between">
     
      
      <div class="table standard-padding px-3">
        <section class="table__body">
          <table class="table table-md-responsive" id="dataTable" >
            <thead>
              <tr>
                <th>ပေါင်ချာနံပါတ်</th>
                <th>ဖောက်သည်အမည်</th>
                <th>ဝယ်အား</th>
                <th>လျော့ဈေး</th>
                <th> ငွေချေပြီး </th>
                <th> ပေးရန်ကျန်ငွေ</th>   
                <th> အသေးစိတ်</th>
                <th> ငွေချေပေါင်ချာ</th>      
              </tr>
            </thead>
            <tbody>
    
              
              
            <?php
   
    
            $sql="select * from voucher ORDER BY voucher_no DESC";
            $result=mysqli_query($connection,$sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                $voucher_no=$row['voucher_no'];
                $customer_name=$row['customer_name'];
                $total=$row['total'];
                $discount =$row['discount'];
                $pay=$row['pay'];
                $payable =$row['payable'];

                echo '<tr>
                <td>' .$voucher_no. '</td>
                <td>' .$customer_name.'</td>
                <td>' .$total. '</td>
                <td>' .$discount.'</td>
                <td>' .$pay. '</td>
                <td>' .$payable.'</td>        
                <td><a href="voucher_detail.php?voucher=' . $voucher_no .'&customer=' . urlencode($customer_name) . '" target="_blank">Detail</a></td>
                <td><a href="voucher_payment_print.php?voucher=' . $voucher_no . '&customer=' . urlencode($customer_name) . '&payable=' . urlencode($payable) . '&pay=' . urlencode($pay) . '" target="_blank">Print</a></td>
  

              </tr>';
              }
            }
            ?>

            
            
              
            </tbody>
          </table>

          <script>
  document.getElementById("searchInput").addEventListener("input", function () {
    const input = this.value.toLowerCase();
    const table = document.getElementById("dataTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
      const rowData = rows[i].getElementsByTagName("td");
      let rowMatch = false;

      for (let j = 0; j < rowData.length; j++) {
        const cell = rowData[j];
        if (cell) {
          const cellText = cell.textContent.toLowerCase();
          if (cellText.includes(input)) {
            rowMatch = true;
            break;
          }
        }
      }

      if (rowMatch) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  });
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
<script>let table = new DataTable('#myTable')</script>
</body>
</html>

<?php
    include '../database.php';
   

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
  <title>London Shop | ဝန်ထမ်း စာရင်း</title>
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
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #CFECEC">
    <!-- Content Header (Page header) -->
    <div class="content-header mb-0">
      <div class="container-fluid">
        <div class="row mb-2 d-flex flex-column align-items-between">
          <div class=" mb-4 mx-2">
            <h1 class="m-0"> ပစ္စည်းစာရင်းများကြည့်ရန်</h1>
          </div><!-- /.col -->
         
          
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <div class="d-lg-flex align-items-top justify-content-between">
     
      
      <div class="table standard-padding px-3">
        <section class="table__body">
          <table class="table table-md-responsive" id="myTable" >
            <thead>
              <tr>
                <th>Operation</th>
                <th> No. </th>
                <th> ဘားကုဒ် </th>
                <th> ပစ္စည်းအမည် </th>
                <th> ကဒ်အရေအတွက် </th>
                <th> ဗူးအရေအတွက်</th>
                <th> ဝယ်ဈေး(ကျပ်) </th>
                <th> ငွေဈေး(ကျပ်) </th>
                <th> သယ်ဆောင်ခ </th>
                <th> ဖာလိုက်ရောင်းဈေး </th>
                <th> ကဒ်လိုက်ရောင်းဈေး </th>
                <th> ဗူးလိုက်ရောင်းဈေး </th>
                <th> ဖာလိုက်ဈေးနှုန်း </th>
                <th> ကဒ်လိုက်ဈေးနှုန်း</th>
                <th> ဗူးလိုက်ဈေးနှုန်း </th>
                <th> ဖာလိုက်လက်ကျန် </th>
                <th> ကဒ်လိုက်လက်ကျန် </th>
                <th> ဗူးလိုက်လက်ကျန် </th>
                <th> Exp Date </th>
                <th> အမြတ် </th>
              </tr>
            </thead>
            <tbody>
            <?php
            $count_result = mysqli_query($connection, "select count(*) as total from product");
            $count=mysqli_fetch_assoc($count_result)['total'];   
            mysqli_free_result($count_result); 
            $sql="Select * from product ORDER BY no DESC";
            $result=mysqli_query($connection,$sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                $id=$row['no'];
                $barcode=$row['barcode'];
                $product_name=$row['product_name'];
                $unit_count=$row['unit'];
                $pieces_count=$row['pieces'];
                $buy=$row['buy'];
                $currency=$row['currency'];
                $trans=$row['trans'];
                $round_package_price=$row['round_package_price'];
                $round_unit_price=$row['round_unit_price'];
                $round_pieces_price=$row['round_pieces_price'];
                $package_price=$row['package_price'];
                $unit_price=$row['unit_price'];
                $pieces_price=$row['pieces_price'];
                $package_remain=$row['package_remain'];
                $unit_remain=$row['unit_remain'];
                $pieces_remain=$row['pieces_remain'];
                $exp_date=$row['exp_date'];
                $profit=$row['profit'];
                echo '<tr>
                <td>
                <button class="btn btn-primary"><a href="update.php" class="text-light">Update</a></button>
                <button class="btn btn-primary"><a href="kyatProduct.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                </td>
                <td>' .$count--. '</td>
                <td>' .$barcode.'</td>
                <td>' .$product_name. '</td>
                <td>' .$unit_count.'</td>
                <td>' .$pieces_count. '</td>
                <td>' .$buy.'</td>
                <td>' .$currency.'</td>
                <td>' .$trans. '</td>
                <td>' .$round_package_price.'</td>
                <td>' .$round_unit_price. '</td>
                <td>' .$round_pieces_price.'</td>
                <td>' .$package_price.'</td>
                <td>' .$unit_price.'</td>
                <td>' .$pieces_price. '</td>
                <td>' .$package_remain.'</td>
                <td>' .$unit_remain. '</td>
                <td>' .$pieces_remain.'</td>
                <td>' .$exp_date. '</td>
                <td>' .$profit.'</td>
                
                
              </tr>';
              }
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
<script>let table = new DataTable('#myTable')</script>
</body>
</html>

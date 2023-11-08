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
         
          
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <div class="d-lg-flex align-items-top justify-content-between">
     
      
      <div class="table standard-padding px-3">
        <section class="table__body">
          <table class="table table-md-responsive" id="dateTable" >
            <thead>
              <tr>
                <th>ရက်ဆွဲ</th>
                <th>စုစုပေါင်းရောင်းရငွေ</th>
                <th>အသေးစိတ်ကြည့်ရန်</th>
                <!-- <th>စုစုပေါင်းအသုံစရိတ်</th>
                <th>1 - January</th>
                <th>1 - January</th>
                <th>1 - January</th> -->
                
    
              </tr>
            </thead>
            <tbody>
              
            <?php
   
    
            $sql="select date,SUM(total) as total_data from sell_data Group BY date";
            $result=mysqli_query($connection,$sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                $date = $row['date'];
                $total_data=$row['total_data'];

                echo '<tr>
          
                <td>' .$date. '</td> 
                <td>' .$total_data. '</td>    
                <td><a href="detail_day_list.php?date='.$date.'" target="_blank">Detail</a></td>
               
              </tr>';
              }
            }



            ?>

            
            
              
            </tbody>
          </table>

          <!-- <script>
    function generateDateTable() {
      const table = document.getElementById("dateTable").getElementsByTagName("tbody")[0];
      const startDate = new Date("2023-01-01"); // Start from January 1, 2023
      const endDate = new Date("2023-12-31"); // End on December 31, 2023

      while (startDate <= endDate) {
        const row = table.insertRow();
        const dayCell = row.insertCell(0);
        const dateCell = row.insertCell(1);

        // Format the date as "M/D/YYYY"
        const month = (startDate.getMonth() + 1).toString().padStart(2, '0');
        const day = startDate.getDate().toString().padStart(2, '0');
        const year = startDate.getFullYear();
        const formattedDate = `${month}/${day}/${year}`;

        dayCell.textContent = formattedDate;
        startDate.setDate(startDate.getDate() + 1); // Increment to the next day
      }
    }

    generateDateTable();
  </script> -->



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

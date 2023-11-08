<!DOCTYPE html>
<html lang="en">
<head>
<?php 
include "login_check.php";
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>London Shop | all</title>
  <link rel="stylesheet" href="style1.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
  
    <!-- Main content -->
    <div class="content-wrapper " style="background-color: #CFECEC">
    <div class="main">
        <div class="container-fluid">
            <!-- /# row -->
            <section id="main-content">
            <div class="row pt-3">
  <div class="col-lg-3 col-sm-12 col-md-6">
    <div class="card">
      <div class="card-body bg-secondary rounded" style="min-height:115px">
      <div class="stat-content dib">
    <?php 
    include '../database.php';
    // include "login_check.php";
    // include '../sidebar.php';

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("ERROR: Could not connect. " . $connection->connect_error);
    }
    $sql = "SELECT COUNT(*) as total_row FROM customer";
    $result = $connection->query($sql);
    if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total_row = $row['total_row'];
        echo '
        <div class="stat-text">Total Customers</div>
        <div class="stat-digit">'.$total_row.'</div>';
        
        }
    }
    ?>
                                    
                                    
                                </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-12 col-md-6">
    <div class="card ">
      <div class="card-body bg-success rounded" style="min-height:115px">
      <div class="stat-content dib">
                                    <?php
                                    $today = date("Y-m-d");
                                    $sql = "SELECT sum(total) as total_sell FROM sell_data where date='$today'";
                                    $result = $connection->query($sql);
                                    if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $total_sell = $row['total_sell'];
                                        echo '
                                        <div class="stat-text">ယနေ့အတွက် ရောင်းရငွေ ('.$today.')</div>
                                        <div class="stat-digit">'.$total_sell.'</div>';                                        
                                        }
                                    }

                                    ?>
                        
                                </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-12 col-md-6">
    <div class="card ">
      <div class="card-body bg-info rounded" style="min-height:115px" >
      <div class="stat-content dib">
                                <?php
                                    $month = date("m");  
                                    $monthName = date("F");
                                    $sql = "SELECT sum(total) as total_sell FROM sell_data where month(date)='$month'";
                                    $result = $connection->query($sql);
                                    if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $total_sell = $row['total_sell'];
                                        echo '
                                        <div class="stat-text">ယခုလအတွက်ရောင်းရငွေ ('.$monthName.')</div>
                                        <div class="stat-digit">'.$total_sell.'</div>';                                        
                                        }
                                    }

                                    ?>
                                </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-12 col-md-6">
    <div class="card ">
      <div class="card-body bg-warning rounded" style="min-height:115px">
      <div class="stat-content dib">
                                <?php
                                    $year = date("Y");  
                                    $sql = "SELECT sum(total) as total_sell FROM sell_data where year(date)='$year'";
                                    $result = $connection->query($sql);
                                    if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $total_sell = $row['total_sell'];
                                        echo '
                                        <div class="stat-text">ယခုနှစ် အတွက်ရောင်းရငွေ ('.$year.')</div>
                                        <div class="stat-digit">'.$total_sell.'</div>';                                        
                                        }
                                    }

                                    ?>
                                </div>
      </div>
    </div>
  </div>
</div>
                         
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title text-center mt-2">
                                <h4>ဗူးလိုက်ရောင်းရအရေအတွက်</h4>
                            </div>                          
                            <div class="card-body" style="height: 500px;">
    
                                <iframe src="chart_pieces.php" title="" style="width:100%;height:100%"></iframe>                           
                            </div>
               
                        </div>
                    </div>

                           
                    <div class="col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-title text-center mt-2">
                                <h4>ကဒ်လိုက်ရောင်းရအရေအတွက်</h4>
                            </div>
                            <div class="card-body" style="height: 500px;">
                                <div class="ct-pie-chart"></div>
                                <!-- Chart piecec -->                                
                                <iframe src="chart_unit.php" title="" style="width:100%;height:100%"></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title text-center mt-2">
                                <h4>ဖာလိုက်ရောင်းရအရေအတွက်</h4>
                            </div>
                            <div class="card-body" style="height: 500px;">
                                <div class="ct-pie-chart"></div>
                                <!-- Chart piecec -->                                
                                <iframe src="chart_package.php" title="" style="width:100%;height:100%"></iframe>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
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
<?php require("jslink.php") ?>
<script>
$('.stat-digit').counterUp({
    'delay': 10,
    'time': 1000
});

var xValues = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
var yValues = JSON.parse(`<?php echo $data; ?>`);
var barColors = "#1e7145";

new Chart("areaChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        legend: {
            display: false
        },
        title: {
            display: false,
        }
    }
});

var pieLabel = JSON.parse(`<?php echo $data2; ?>`)
var pieData = JSON.parse(`<?php echo $data3; ?>`)

var barColorsPie = ["#b91d47", "#c3a5b4", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145", "#201923", "#2f2aa0", "#b732cc",
    "#632819", "#772b9d", "#5d4c86"
];

new Chart("pieChart", {
    type: "pie",
    data: {
        labels: pieLabel,
        datasets: [{
            backgroundColor: barColorsPie,
            data: pieData
        }]
    },
    options: {
        title: {
            display: false,
        }
    }
});


</script>

</body>
</html>

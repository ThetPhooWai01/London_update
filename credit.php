<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>London Shop | အကြွေး စာရင်း</title>
  <link rel="stylesheet" href="../style1.css">

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
  <div class="content-wrapper" style="background-color: #CFECEC">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">အကြွေးစာရင်းများ</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="d-lg-flex align-items-top justify-content-between">
      <div>
      <div class="form-res">
        <form>
          <table>
            <tr class="table-column label-mb">
              <td class="td-reduce-padding"><p class="text-nowrap label">Customer:</p></td>
              <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="barcode"></td>
            </tr>
            <tr class="table-column label-mb">
              <td class="td-reduce-padding"><p class="text-nowrap label">ငွေချေ:</p></td>
              <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="ပစ္စည်းအမည်:" ></td>
            </tr>
            <tr class="table-column label-mb">
              <td class="td-reduce-padding"><p class="text-nowrap label">မှတ်စု:</p></td>
              <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="ဖာလိုက်ဈေးနှုန်း:" ></td>
            </tr>
            <tr class="table-column label-mb">
              <td class="td-reduce-padding"><p class="text-nowrap label">OrderID:</p></td>
              <td class="td-reduce-padding w-100"><input class="w-100" type="text" name="ကဒ်လိုက်ဈေးနှုန်း:" ></td>
            </tr>
                    </table>
          
          <div class="d-md-flex justify-content-between align-items-center mb-3 mt-2">
              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"><button type="button" class="btn btn-primary btn-sm" id="submit">ငွေချေရန်</button></div>
              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"><button type="button" class="btn btn-primary btn-sm" id="submit">ပြင်ရန်</button></div>
              <div class="pr-3 pl-3 pb-3 w-sm-100 w-lg-25"> <button type="button" class="btn btn-primary btn-sm" id="submit">ရှာရန်</button></div>
            </div>
          <!-- <input type="button" value="refresh" id="submit"> -->
        </form>
      </div>
</div>
      <div class="table standard-padding">
        <section class="table__body">
          <table class="table table-md-responsive">
            <thead>
              <tr>
                <th> အမည် </th>
                <th> role </th>
                <th> ဝယ်အား </th>
                <th> အကြွေး</th>
                <th> ပေးချေပြီး </th>
                <th> ပေးရန်ကျန် </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> Daw Mya </td>
                <td> Silver</td>
                
                <td>
                  9950
                </td>
                <td>
                  0.0
                </td>
                <td>
                  0.0
                </td>
                <td> 0.0</td>
              </tr>
              <tr>
                <td> Daw Hla </td>
                <td> Silver</td>
                
                <td>
                  4410
                </td>
                <td>
                  0.0
                </td>
                <td>
                  0.0
                </td>
                <td> 0.0</td>
              </tr>
              
              
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

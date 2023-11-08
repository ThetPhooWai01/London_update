<?php
$pageName = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>


    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar>

 Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">

  <?php 
  include "database.php"; 
  $connection = new mysqli($servername, $username, $password, $database);

  if ($connection->connect_error) {
      die("ERROR: Could not connect. " . $connection->connect_error);
  }
  //Shop Name
  $sql = "SELECT * FROM shop_name where id='1'";
  $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $shop_name = $row["shop_name"];
          echo '
          <!-- Brand Logo -->
        <a href="../index3.html" class="brand-link">
          <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">'.$shop_name.'</span>
        </a>
          
          
          ';          
        }
      }

       // Start or resume the session

    //==========User Name==========
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

    
  $sql = "SELECT * FROM user_database where browser_id='$b_id'";
  $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $user_name = $row["user_name"];
          echo '
          <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">'.$user_name.'</a>
        </div>
      </div>              
          ';          
        }
      }
  ?>

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
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    အရောင်း
                    <i class="right fas fa-angle-left"></i>
                  </p>

                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php" class="nav-link <?=$pageName == 'index.php' ? 'active' : '';?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>လက်လီ</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index2.php" class="nav-link <?=$pageName == 'index2.php' ? 'active' : '';?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>လက်ကား</p>
                    </a>
                  </li>
                  </ul>
              </li>
              <li class="nav-item">
                <a href="addProduct.php" class="nav-link <?=$pageName == 'addProduct.php' ? 'active bg-gradient-primary' : '';?>">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>ပစ္စည်းသစ်ပေါင်းထည့်ရန်</p>
                </a>
              </li>
              <li class="nav-item <?=$pageName == 'addCustomer.php'? 'menu-open' : '';?> <?=$pageName == 'customer_payment.php'? 'menu-open' : '';?>">
                <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    ဖောက်သည် စာရင်း
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="addCustomer.php" class="nav-link <?=$pageName == 'addCustomer.php' ? 'active' : '';?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>ဖောက်သည်သစ်ပေါင်းထည့်ရန်</p>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="customer_payment.php" class="nav-link <?=$pageName == 'customer_payment.php' ? 'active' : '';?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>ဖောက်သည်ငွေချေရန်</p>
                    </a>
                  </li>
                  </ul>
              </li>


          <li class="nav-item">
          <a href="addStaff.php" class="nav-link <?=$pageName == 'addStaff.php' ? 'active' : '';?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              ဝန်ထမ်းသစ်ပေါင်းထည့်ရန်
                
              </p>
            </a>
</li>
           

          




          <li class="nav-item">
            <a href="voucher.php" class="nav-link <?=$pageName == 'voucher.php' ? 'active' : '';?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                ဘောင်ချာ

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?=$pageName == 'dashboard.php' ? 'active' : '';?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                စာရင်းချုပ်
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="detail_day.php" class="nav-link <?=$pageName == 'detail_day.php' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ရက်ချုပ်</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="detail_month.php" class="nav-link <?=$pageName == 'detail_month.php' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>လချုပ်</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="detail_year.php" class="nav-link <?=$pageName == 'detail_year.php' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>နှစ်ချုပ်</p>
                </a>
              </li>

              

              </ul>
          </li>

          <li class="nav-item">
            <a href="log_out.php" class="nav-link <?=$pageName == 'log_out.php' ? 'active' : '';?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Account ထွက်ရန်
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

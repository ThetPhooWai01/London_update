<!DOCTYPE html>
<html>
<head>
  <title>A4 Voucher</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .voucher-container {
      width: 210mm; /* A4 paper width */
      height: 297mm; /* A4 paper height */
      background-color: #f2f2f2;
      padding: 20mm;
      box-sizing: border-box;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
    }

    .voucher-header {
      text-align: center;
      font-size: 24px;
      margin-bottom: 10px;
    }

    .voucher-content {
      font-size: 13px;
    }

    .voucher-footer {
      margin-top: 10px;
      text-align: right;
    }

    @media print {
      body {
        width: 210mm;
        height: 297mm;
      }
    }
  </style>
</head>
<body>
  
  <div class="voucher-container">
    <table>
      <tr>
        <td colspan="2" class="voucher-header">
            <img src="../logo.png" style="width: 150px; margin-bottom: -50px;">
            <br><br>
            </img>
            <address style="text-align: left;font-size: 13px;"> နောင်ကျောက်ရပ်ကွက်၊ ကျိုင်းတုံမြို့ <br> 09 428 217 111</address>
            <?php
              include 'database.php';

              $connection = new mysqli($servername, $username, $password, $database);
              if ($connection->connect_error) {
                  die("Connection failed: " . $connection->connect_error);
              }
              if (isset($_GET['month'])) {
                $month = $_GET['month'];


                echo'<h3 style="text-align:left;font-size:12px;">Month: '.$month.'</h3>';

              ?>
          
          </td>
      </tr>
      <tr>
        <td colspan="2" class="voucher-content">
            <table><br>
                <tr>
                  <th>ပစ္စည်းအမည်</th>
                  <th>အရေအတွက်</th>
                  <th>ဈေးနှုန်း</th>
                  <th>လျော့ဈေး</th>
                  <th>ကျသင့်ငွေ</th>
                </tr>
    <?php
      include 'database.php';
   

      $connection = new mysqli($servername, $username, $password, $database);
      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }

      

        $sql = "SELECT * FROM sell_data WHERE month(date)='$month'";

        $result = $connection->query($sql);
        if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='user_table_td'>
                <td>" . $row["product_name"] . "</td>
                <td>" . $row["qty"] . "</td>
                <td>" . $row["price"] . "</td>
                <td>" . $row["discount"] . "</td>
                <td>" . $row["total"] . "</td>
            </tr>";                        
        }
            } 

            $sql = "SELECT SUM(total) AS total_sum, SUM(discount) As total_discount from sell_data where month(date)='$month'"; // Use an alias "total_sum" for the sum(total) column
            $result = $connection->query($sql);

            if ($result === false) {
                // Query failed, display the error message
                die("Error executing the query: " . $connection->error);
            }

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Fetch the row
                $totalSum = $row["total_sum"]; // Get the sum value from the fetched row
                $total_discount = $row["total_discount"];

                // Display the total sum in the table row
                echo "<tr class='user_table_td'>
                    
        
                        <td colspan=3 style='text-align:center;'>Total</td>
                        <td><b>" . $total_discount . "</td></b>
                        <td><b>" . $totalSum . "</td></b>
                    </tr>";
            } else {
                echo "No results found.";
            }





            $connection->close();




    } else {
        die("No voucher provided.");
    }

           
                  ?>

            </table>
        </td>
      </tr>

      <tr>
        <?php
        $today = date("Y-m-d");
          echo'
          <td class="voucher-footer" colspan="2">Date: '.$today.'<br>
            <label>ဝယ်ယူအားပေးမှုအတွက် အထူးကျေးဇူးတင်ရှိပါသည်</label>
        </td>
          ';
        ?>
        
        
      </tr>
    </table>
  </div>
</body>
</html>


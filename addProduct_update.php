<?php
include 'database.php';
$connection = new mysqli($servername, $username, $password, $database);


if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = json_decode(file_get_contents('php://input'), true);

  // Assuming 'no' is the primary key for your product table
  if (isset($data['no'])) {
      header('location:addProduct.php');
      $no = $connection->real_escape_string($data['no']);
      $barcode = $connection->real_escape_string($data['barcode']);
      $product_name = $connection->real_escape_string($data['ပစ္စည်းအမည်']);
      $unit = $connection->real_escape_string($data['ကဒ်အရေအတွက်']);
      $pieces = $connection->real_escape_string($data['ဗူးအရေအတွက်']);
      $buy = $connection->real_escape_string($data['ဝယ်ဈေး']);
      $rate = $connection->real_escape_string($data['ငွေဈေး']);
      $trans = $connection->real_escape_string($data['သယ်ဆောင်ခ']);
      $round_package_price = $connection->real_escape_string($data['ဖာလိုက်ရောင်းဈေး']);
      $round_unit_price = $connection->real_escape_string($data['ကဒ်လိုက်ရောင်းဈေး']);
      $round_pieces_price = $connection->real_escape_string($data['ဗူးလိုက်ရောင်းဈေး']);
      $profit = $connection->real_escape_string($data['အမြတ်']);

      echo "hi";
      echo "<script>alert('Hello World')</script>";
      echo "<script>console.log('Hello World')</script>";


      
    
    
      
      //update barcode,name.....
      $sql = "UPDATE product SET barcode='$barcode',product_name='$product_name',unit='$unit',pieces='$pieces',buy='$buy',rate='$rate',trans='$trans',round_package_price='$round_package_price',round_unit_price='$round_unit_price',round_pieces_price='$round_pieces_price',profit='$profit' WHERE id='$no'";
      //$sql = "UPDATE product SET barcode='$barcode' WHERE id='$no'";
      if ($connection->query($sql) === TRUE) {
          //echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
      } else {
          //echo json_encode(['status' => 'error', 'message' => 'Error updating record: ' . $connection->error]);
      }
      include "../cal_pro_remain.php";


      header('location:addProduct.php');

    //   if (isset($data['ဖာလိုက်ရောင်းဈေး']) || isset($data['ကဒ်လိုက်ရောင်းဈေး']) || isset($data['ဗူးလိုက်ရောင်းဈေး'])) {

    //     echo "";
        
    //     } else {

            function roundUpToNearestHundred($number) {
                return ceil($number / 100) * 100;
                }
              
        
                $sql = "SELECT * FROM product where id='$no'";
                $result = $connection->query($sql);
                if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $unit = $row['unit']; 
                    $pieces = $row['pieces']; 
                    $buy = $row['buy'];
                    $rate = $row['rate']; 
                    $trans = $row['trans'];
                    $round_package_price_db = $row['round_package_price']; 
                    $round_unit_price_db = $row['round_unit_price']; 
                    $round_pieces_price_db = $row['round_pieces_price']; 

                    //if ($round_package_price_db == $round_package_price && $round_unit_price_db == $round_unit_price && $round_pieces_price_db == $round_pieces_price){
                    $package_price = (($buy / $rate) + $trans) + $profit;
                    $unit_price = $package_price/$unit;
                    $pieces_price = $unit_price/$pieces;
                    $round_package_price = roundUpToNearestHundred($package_price);
                    $round_unit_price = roundUpToNearestHundred($unit_price);
                    $round_pieces_price = roundUpToNearestHundred($pieces_price);
                    
                    $sql = "UPDATE product SET package_price='$package_price',unit_price='$unit_price',pieces_price='$pieces_price',round_package_price='$round_package_price',round_unit_price='$round_unit_price',round_pieces_price='$round_pieces_price' where id='$no'";
                    //$sql = "UPDATE product SET barcode='$barcode' WHERE id='$no'";
                    if ($connection->query($sql) === TRUE) {
                        echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Error updating record: ' . $connection->error]);
                    }

                    //} else {

                    //}


        
                    
                       
                  }
                // }
        }
  

      


  } else {
      echo json_encode(['status' => 'error', 'message' => 'Invalid data format.']);
  }

  //Calculate Rate
  // $sql = "UPDATE product SET rate='$rate'";
  //     //$sql = "UPDATE product SET barcode='$barcode' WHERE id='$no'";
  //     if ($connection->query($sql) === TRUE) {
  //       function roundUpToNearestHundred($number) {
  //         return ceil($number / 100) * 100;
  //         }
        
  
  //         $sql = "SELECT * FROM product";
  //         $result = $connection->query($sql);
  //         if ($result && $result->num_rows > 0) {
  //         while ($row = $result->fetch_assoc()) {
  //             $unit = $row['unit']; 
  //             $pieces = $row['pieces']; 
  //             $buy = $row['buy'];
  //             $rate = $row['rate']; 
  //             $trans = $row['trans']; 
  
  //             $package_price = (($buy / $rate) + $trans) + $profit;
  //             $unit_price = $package_price/$unit;
  //             $pieces_price = $unit_price/$pieces;
  //             $round_package_price = roundUpToNearestHundred($package_price);
  //             $round_unit_price = roundUpToNearestHundred($unit_price);
  //             $round_pieces_price = roundUpToNearestHundred($pieces_price);
  //             echo $round_package_price;
  
  
  //               $sql = "UPDATE product SET package_price='$package_price',unit_price='$unit_price',pieces_price='$pieces_price',round_package_price='$round_package_price',round_unit_price='$round_unit_price',round_pieces_price='$round_pieces_price'";
  //               //$sql = "UPDATE product SET barcode='$barcode' WHERE id='$no'";
  //               if ($connection->query($sql) === TRUE) {
  //                   echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
  //               } else {
  //                   echo json_encode(['status' => 'error', 'message' => 'Error updating record: ' . $connection->error]);
  //               }       
  //           }
  //         }

  //     } else {
  //         //echo json_encode(['status' => 'error', 'message' => 'Error updating record: ' . $connection->error]);
  //     }

  // Close the connection
  $connection->close();
  exit;  // Important to stop further processing
}


?>
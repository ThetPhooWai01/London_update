<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Layout 58 x 3276 mm</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            height: fit-content;
        }

        @page {
            size: auto; /* Use the default paper size, which depends on the printer. */
            margin: 0;
        }

        @media print {
            body {
                height: 10mm; /* Define the fixed height of the print area */
                overflow: hidden;
                page-break-after: always; /* Force a page break after each "page" */
            }
        }

        #print-container {
            width: 60mm;
            /*border: 1px solid black;  This is just to visualize the boundary. You might want to remove it when printing */
            overflow: hidden;
            background-color: #f9f9f9; /* You can change this to any desired background color */
            padding: 1px; /* Optional padding */
        }

        .title {
            text-align: center;
            font-size: 20px;
        }

        .address {
            font-size: 15px;
            text-align: center;
        }

        .ph_no {
            font-size: 15px;
            text-align: center;
        }

        table {
            margin-left: 15px;
            font-size: 13px;
        }

        th, td {
            text-align: left;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #print-container, #print-container * {
                visibility: visible;
            }
            #print-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }

        /* Additional styling for the content can go here */
    </style>
</head>

<body>

    <div id="print-container">
        <div class='title'><b>London Store</b></div>
        <div class='address'>No:84, Yay Aye Quarter, Kyaing Tong</div>
        <div class='ph_no'>09 6666 350 555</div>

        <?php
            include 'pages/database.php';

            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die("ERROR: Could not connect. " . $connection->connect_error);
            }

            session_start();

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

            $sql = "SELECT * FROM user_database WHERE browser_id='$b_id'";
            $result = $connection->query($sql);
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
         
                $user_id = $row['user_name_LL'];

                $query = "SELECT * FROM `$user_id`";
                
                $result = $connection->query($query);
                echo '
                <table>
                <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Total</th>
                </tr>';

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <tr>
                        <td>' . $row['product_name'] . '</td>
                        <td>' . $row['qty'] . '</td>
                        <td>' . $row['total'] . '</td>
                        </tr>
                        ';
                    }
                }

                echo '
                        <tr>
                        <td colspan=3 >-------------------------------------</td>
                        </tr>
                        ';

                $query = "SELECT sum(total) as total_sum FROM `$user_id`";
                $result = $connection->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <tr>
                        <td colspan=2 style="margin-left:5px">Total (MMK)</td>
                        <td><b>' . $row['total_sum'] . '</b></td>
                        </tr>
                        ';
                    }
                }

              }
            }



            

            function generateUniqueBrowserId()
                {
                    $randomString = bin2hex(random_bytes(16));
                    $timestamp = time();

                    return $randomString . $timestamp;
                }

            
        ?>
    </div>
    
</body>

</html>

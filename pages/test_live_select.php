<?php
include '../database.php';

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("ERROR: Could not connect. " . $connection->connect_error);
}

if(isset($_POST['selectedOption'])) {
    $name = $connection->real_escape_string($_POST['selectedOption']); // Sanitize input to prevent SQL injection
    $sql = "SELECT * FROM voucher WHERE customer_name = '$name'";
    $result = $connection->query($sql);
    $vouchers = [];
    while ($row = $result->fetch_assoc()) {
        $vouchers[] = $row['voucher_no'];
    }
    echo json_encode($vouchers); // Return voucher numbers as JSON
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JS Live Select Option</title>
</head>
<body>
    <select id="name">
        <option value="">Select a name</option>
        <option value="Daw_Mya">Daw_Mya</option>
        <option value="Aung_Kaung">Aung_Kaung</option>
        <option value="Option 3">Option 3</option>
    </select>
    <br>
    <br>
    
    <select id='voucher' name="voucher"></select>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let nameSelect = document.getElementById('name');
            let voucherSelect = document.getElementById('voucher');

            nameSelect.addEventListener('change', function() {
                // Send the selected option value to PHP
                fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'selectedOption=' + encodeURIComponent(nameSelect.value),
                })
                .then(response => response.json())
                .then(vouchers => {
                    // Clear existing options
                    voucherSelect.innerHTML = '';
                    // Populate voucher dropdown with the new set of vouchers
                    vouchers.forEach(voucher => {
                        let option = document.createElement('option');
                        option.value = voucher;
                        option.textContent = voucher;
                        voucherSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>

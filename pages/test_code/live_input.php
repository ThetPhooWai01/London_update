<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inputData'])) {
    $receivedData = $_POST['inputData'];
    
    // Process the data (For this example, we'll simply echo it back)
    echo "Received: " . htmlspecialchars($receivedData);


    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Fetch with PHP</title>
</head>
<body>

<input type="text" id="autoInput" placeholder="Start typing...">



<script>
    document.getElementById('autoInput').addEventListener('input', function() {
        let inputValue = this.value;
        
        fetch('live_input.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'inputData=' + encodeURIComponent(inputValue)
        })
        .then(response => response.text())
        .then(data => {
        
        })
        .catch(error => console.error('Error:', error));
    });
</script>

</body>
</html>

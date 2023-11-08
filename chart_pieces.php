<?php
 // Replace these variables with your MySQL database credentials
 include "database.php";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $database); // Change $dbname to $database here

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to sum quantities for each product name
$sql = "SELECT product_name, SUM(qty) AS total_quantity FROM sell_data where type='ဗူး/ခု' GROUP BY product_name Order by total_quantity ASC";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through the results and print each product name and its total quantity
    while ($row = $result->fetch_assoc()) {
        //echo $row["product_name"] . ": " . $row["total_quantity"] . "<br>";
        $dataPoints[] = array(
            "y" => $row["total_quantity"],
            "label" => $row["product_name"],
        );
    }
} else {
    echo "No products found.";
}

// Close the connection
$conn->close();

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "ဗူးလိုက်ရောင်းအားပြဇယား"
	},
	axisY: {
		title: "",
		includeZero: true,
		prefix: "",
		suffix:  " ဗူး"
	},
	data: [{
		type: "bar",
		yValueFormatString: "#,##0 ဗူး",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 100%; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>                              
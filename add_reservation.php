<?php
// Establish database connection
$mysqli = new mysqli('localhost', 'root', '', 'tailoring');
if($mysqli->connect_error) {
    die('Connection failed: '. $mysqli->connect_error);
}

// Retrieve form data
$customerID = $_POST['customer'];
$serviceID = $_POST['service'];
$reserveDate = $_POST['reserveDate'];
$status = $_POST['status'];

// Perform data validation if necessary

// Insert data into the reserves table
$sql = "INSERT INTO reserves (CustomerID, serviceID, reserveDate, status) 
        VALUES ('$customerID', '$serviceID', '$reserveDate', '$status')";
if ($mysqli->query($sql) === TRUE) {
    echo "New reservation added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Close database connection
$mysqli->close();
?>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "tailoring";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$productName = $_POST['productName'];
$quantity = $_POST['quantity'];
$unitPrice = $_POST['unitPrice'];

// Prepare and execute SQL query
$sql = "INSERT INTO Product (ProductName, Quantity, UnitPrice) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sid", $productName, $quantity, $unitPrice);

if ($stmt->execute()) {
    echo "New product added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

<?php
// Include the database configuration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "tailoring";

    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $user_id = $_POST['user_id'];
        $user_balance = $_POST['user_balance'];

        // Validate input
        if (empty($product_name) || empty($product_price) || empty($user_balance) || empty($user_id)) {
            echo "All fields are required.";
            exit;
        }

        // Check if user has enough balance
        if ($user_balance < $product_price) {
            echo "Insufficient balance.";
            exit;
        }

        // Update user's balance
        $new_balance = $user_balance - $product_price;
        $update_query = "UPDATE users SET balance = $new_balance WHERE id = $user_id";

        if ($conn->query($update_query) === TRUE) {
            echo "Purchase successful. Your new balance is: $new_balance";
        } else {
            echo "Error updating balance: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Form</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('product_image.jpg');
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: green;
    }

    h2 {
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 10px;
    }

    input[type="number"],
    input[type="text"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid gray;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #555;
    }
</style>
<header>
    <h1>Welcome to Tailoring Project</h1>
    <nav>
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="display_product.php">Products</a></li>
            <li><a href="newpro.html">New</a></li>
            <li><a href="reserves.php">Reserves</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
            <li><a href="purchase_product.php">Purchase prod</a></li>
            <li><a href="save_balance.php">My balance</a></li>
            <li>
                <a href="Sign_up.php">Sign Up</a>
                <div class="sub-menu">
                    <a href="register.php">Register</a>
                    <a href="login.php">Login</a>
                    <a href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

</header>
<div class="container">
    <h2>Purchase Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="user_id">User ID:</label><br>
        <input type="number" id="user_id" name="user_id"><br>
        <label for="product_name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name"><br>
        <label for="product_price">Product Price:</label><br>
        <input type="number" id="product_price" name="product_price"><br>
        <label for="user_balance">Your Balance:</label><br>
        <input type="number" id="user_balance" name="user_balance"><br>
        <input type="submit" value="Purchase">
    </form>
</div>
</body>
</html>

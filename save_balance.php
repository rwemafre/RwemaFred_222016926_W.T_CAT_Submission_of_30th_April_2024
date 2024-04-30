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
    $user_id = $_POST['user_id'];
    $balance = $_POST['balance'];

    // Validate input
    if (empty($user_id) || empty($balance)) {
        echo "All fields are required.";
        exit;
    }

    // Insert balance into database
    $insert_query = "INSERT INTO balances (user_id, balance) VALUES ('$user_id', '$balance')";

    if ($conn->query($insert_query) === TRUE) {
        echo "Balance saved successfully.";
    } else {
        echo "Error saving balance: " . $conn->error;
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Form</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <script>
        function validateForm() {
            var userId = document.getElementById("user_id").value;
            var balance = document.getElementById("balance").value;

            if (userId === '' || balance === '') {
                alert("All fields are required.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <style>
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
        <h2>Balance Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <label for="user_id">User ID:</label><br>
            <input type="number" id="user_id" name="user_id" required><br>
            <label for="balance">Balance Amount:</label><br>
            <input type="number" id="balance" name="balance" required><br>
            <input type="submit" value="Save">
        </form>
    </div>
</body>
</html>

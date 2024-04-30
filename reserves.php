<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Reservation</title>
    <link rel="stylesheet" type="text/css" href="home.css">
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        input[type="date"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
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
</head>
<body>
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
                <li><a href="edit_update.php">product edit</a></li>
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
        <h2>Add New Reservation</h2>
        <form action="add_reservation.php" method="post">
            <label for="customer">Customer:</label>
            <select id="customer" name="customer" required>
                 <?php
                $mysqli = new mysqli('localhost', 'root', '', 'tailoring');
                if($mysqli->connect_error) {
                    die('Connection failed:'. $mysqli->connect_error);
                }
                $query = "SELECT CustomerID, FirstName, LastName from customer";
                $result = $mysqli->query($query);
                if($result) {
                    while($row = $result->fetch_assoc()){
                        echo'<option value="'.$row['CustomerID'].'">' . $row['FirstName'] . '</option>';
                    }
                }
                ?>
                <option value="">Select Customer</option>
            </select>

            <label for="service">Service:</label>
            <select id="service" name="service" required>
                <option value="">Select Service</option>
                <!-- Replace this with your static options -->
                <option value="1">Service 1</option>
                <option value="2">Service 2</option>
                <option value="3">Service 3</option>
            </select>

            <label for="reserveDate">Reservation Date:</label>
            <input type="date" id="reserveDate" name="reserveDate" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>

            <input type="submit" value="Add Reservation">
        </form>
    </div>
     <footer>
        <p>&copy; 2024 Tailoring Project</p>
    </footer>
</body>
</html>

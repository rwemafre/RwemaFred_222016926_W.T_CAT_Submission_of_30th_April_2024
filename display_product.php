<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <style>
        body {
            background-image: url('product_image.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: palegoldenrod;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .image-cell img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .price {
            font-weight: bold;
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
    <table>
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Database connection
        include('dbConfig.php');

        // Fetch products from database
        $sql = "SELECT ProductName, Quantity, UnitPrice FROM Product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ProductName"] . "</td>";
                echo "<td>" . $row["Quantity"] . "</td>";
                echo "<td class='price'>$" . $row["UnitPrice"] . "</td>";
                echo "<td><button onclick='purchaseProduct(\"" . $row["ProductName"] . "\", " . $row["UnitPrice"] . ")'>Purchase</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No products found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
        </tbody>
    </table>
    <form id="purchaseForm" style="display: none;">
        <h2>Confirm Purchase</h2>
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" readonly><br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1"><br><br>
        <label for="totalPrice">Total Price:</label>
        <input type="text" id="totalPrice" name="totalPrice" readonly><br><br>
        <button type="submit">Confirm Purchase</button>
    </form>
    <div id="confirmationMessage" style="display: none;">
        <h2>Thank you for your purchase!</h2>
        <p>Your product will be delivered soon.</p>
    </div>
</div>

<script>
    function purchaseProduct(productName, unitPrice) {
        document.getElementById('productName').value = productName;
        document.getElementById('totalPrice').value = unitPrice;
        document.getElementById('purchaseForm').style.display = 'block';
    }

    // Function to handle form submission
    document.getElementById('purchaseForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Hide purchase form and show confirmation message
        document.getElementById('purchaseForm').style.display = 'none';
        document.getElementById('confirmationMessage').style.display = 'block';
    });
</script>
 <footer>
        <p>&copy; 2024 Tailoring Project</p>
    </footer>
</body>
</html>

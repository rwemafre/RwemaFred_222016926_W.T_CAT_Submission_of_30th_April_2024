<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.container {
    width: 300px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="email"],
input[type="password"] {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3;
}

        /* Additional styles for form */
        .form-container {
            margin-top: 20px;
            background-color: gray;
            padding: 30px;
            border-radius: 10px;
            width: 50%;
            
        }

        .form-container h2 {
            margin-top: 0;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
        }

        .form-container input[type="text"],
        .form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container input[type="submit"],
        .form-container button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover,
        .form-container button:hover {
            background-color: #555;
        }

        .error-message {
            color: red;
            font-size: 14px;
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
<div class="form-container">
    <h2>Edit Product</h2>
    <?php
    // Database connection
    include('dbConfig.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form submission
        if (isset($_POST['editSubmit'])) {
            $productName = $_POST['editProductName'];
            $newQuantity = $_POST['editQuantity'];
            $newUnitPrice = $_POST['editUnitPrice'];

            // Update product in database
            $sql = "UPDATE Product SET Quantity='$newQuantity', UnitPrice='$newUnitPrice' WHERE ProductName='$productName'";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Product updated successfully.</p>";
            } else {
                echo "<p>Error updating product: " . $conn->error . "</p>";
            }
        } elseif (isset($_POST['deleteSubmit'])) {
            $productName = $_POST['editProductName'];

            // Delete product from database
            $sql = "DELETE FROM Product WHERE ProductName='$productName'";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Product deleted successfully.</p>";
            } else {
                echo "<p>Error deleting product: " . $conn->error . "</p>";
            }
        }
    
    }

    // Close connection
    $conn->close();
    ?>
    <!-- Edit product form -->
    <form id="editForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="editProductName">Product Name:</label>
        <input type="text" id="editProductName" name="editProductName" required><br>

        <label for="editQuantity">New Quantity:</label>
        <input type="number" id="editQuantity" name="editQuantity" min="1" required><br>
        <span id="quantityError" class="error-message"></span><br>

        <label for="editUnitPrice">New Unit Price:</label>
        <input type="number" id="editUnitPrice" name="editUnitPrice" min="0" step="0.01" required><br>
        <span id="priceError" class="error-message"></span><br>

        <input type="submit" name="editSubmit" value="Edit Product">
    </form> <br>
    
    <!-- Delete product form -->
    <form id="deleteForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" id="deleteProductName" name="editProductName">
        <button type="submit" name="deleteSubmit">Delete Product</button>
    </form>
</div>

<script>
    // JavaScript for form validation
    document.getElementById('editForm').addEventListener('submit', function(event) {
        const quantity = document.getElementById('editQuantity').value;
        const unitPrice = document.getElementById('editUnitPrice').value;

        // Validation for quantity
        if (isNaN(quantity) || quantity <= 0) {
            event.preventDefault();
            document.getElementById('quantityError').textContent = 'Please enter a valid quantity.';
        } else {
            document.getElementById('quantityError').textContent = '';
        }

        // Validation for unit price
        if (isNaN(unitPrice) || unitPrice < 0) {
            event.preventDefault();
            document.getElementById('priceError').textContent = 'Please enter a valid unit price.';
        } else {
            document.getElementById('priceError').textContent = '';
        }
    });

    // Function to set product name for deletion
    function setProductNameForDeletion(productName) {
        document.getElementById('deleteProductName').value = productName;
    }
</script>
<footer>
        <p>&copy; 2024 Tailoring Project</p>
    </footer>
</body>
</html>

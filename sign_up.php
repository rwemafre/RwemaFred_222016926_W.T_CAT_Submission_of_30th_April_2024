<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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

        input[type="email"],
        input[type="password"] {
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
        <h2>User Registration</h2>
        <form action="sign_up.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Sign Up">
        </form>

         <?php
        // Check if the form is submitted
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

            // Retrieve form data
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Hash the password for security (if needed)
            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the users table
            $sql = "INSERT INTO users (email, password) 
                    VALUES ('$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                echo "User registered successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close database connection
            $conn->close();
        }
        ?>
    </div>
     <footer>
        <p>&copy; 2024 Tailoring Project</p>
    </footer>
        <script type="text/javascript">
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Simple validation for empty fields
            if (email.trim() === "" || password.trim() === "") {
                alert("Email and password are required");
                return false;
            }

            return true; // Form submission will proceed if all validations pass
        }
    </script>

</body>
</html>

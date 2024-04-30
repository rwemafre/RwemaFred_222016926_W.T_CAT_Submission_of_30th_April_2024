<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            background-image: url('product_image.jpg');
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: chocolate;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;

        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            height: 150px;
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
            width: fit-content;
            align-self: flex-end;
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
                    <a href="sign_up.php">Sign Up</a>
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
        <h2>Contact Us</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <input type="submit" name="submit" value="Submit">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            // Validate and sanitize input (you can add more validation as needed)
            $name = htmlspecialchars($name);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $subject = htmlspecialchars($subject);
            $message = htmlspecialchars($message);

            // Connect to MySQL database (replace the credentials with your own)
            include('dbConfig.php');

            // Prepare SQL statement to insert data into database
            $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $subject, $message);

            // Execute SQL statement
            if ($stmt->execute()) {
                // Data inserted successfully
                echo "<p>Thank you! Your message has been submitted.</p>";
            } else {
                // Error in SQL execution
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }

            // Close database connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
     <footer>
        <p>&copy; 2024 Tailoring Project</p>
    </footer>
    <script type="text/javascript">
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var subject = document.getElementById("subject").value;
            var message = document.getElementById("message").value;

            // Simple validation for empty fields
            if (name.trim() === "" || email.trim() === "" || subject.trim() === "" || message.trim() === "") {
                alert("All fields are required");
                return false;
            }

            // Additional validation for email format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address");
                return false;
            }

            return true; // Form submission will proceed if all validations pass
        }
    </script>
</body>

</html>

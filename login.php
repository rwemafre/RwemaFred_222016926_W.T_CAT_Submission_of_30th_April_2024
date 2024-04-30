<?php
// PHP code for login
session_start();

include('dbConfig.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_email = $_POST['email'];
    $login_password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$login_email' AND password='$login_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Set session variables
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $login_email;
        $_SESSION["role"] = $user["role"];

        // Redirect to home page after successful login
        header("Location: home.html");
        exit();
    } else {
        echo "Login failed. Invalid email or password.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
            margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Login">
            <p>If you don't have account <a href="register.php">register here</a></p>
        </form>
    </div>
     <script type="text/javascript">
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Simple validation for empty fields
            if (email.trim() === "" || password.trim() === "") {
                alert("Email and password are required");
                return false;
            }

            // Additional validation can be added here if needed

            return true; // Form submission will proceed if all validations pass
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php
        // admin_login.php

        // Include the database connection file
        require_once "db_connection.php";

        // Function to start a session
        function start_session() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        // Check if the admin is already logged in
        start_session();
        if (isset($_SESSION["admin_id"])) {
            header("Location: admin_dashboard.php");
            exit();
        }

        // Check if the login form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get the submitted username and password
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Prepare and execute the SQL query to fetch admin information from the database
            $sql = "SELECT * FROM admin_info WHERE admin_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $admin_info = $result->fetch_assoc();
                // Verify the password
                if (password_verify($password, $admin_info["admin_password"])) {
                    // Admin login successful, set session variable and redirect to the dashboard
                    $_SESSION["admin_id"] = $admin_info["admin_id"];
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    // Admin login failed, display error message (for security reasons, avoid revealing the exact error)
                    $error_message = "Invalid username or password.";
                }
            } else {
                // Admin login failed, display error message (for security reasons, avoid revealing the exact error)
                $error_message = "Invalid username or password.";
            }
        }
        ?>

        <?php
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

        <form action="admin_login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
        <div class="form-footer">
            <p>Don't have an account? <a href="admin_register.php">Register</a></p>
            <p><a href="forgot_password.php">Forgot Password?</a></p>
        </div>
       
    </div>
</body>
</html>

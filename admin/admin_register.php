<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="registration-container">
        <h2>Admin Registration</h2>
        <?php
        // admin_registration.php

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

        // Check if the registration form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get the submitted form data
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            // Verify that the passwords match
            if ($password !== $confirm_password) {
                echo "<p class='error-message'>Passwords do not match. Please enter the same password in both fields.</p>";
            } else {
                // Check if the username is available (not already registered)
                $sql_check_username = "SELECT admin_id FROM admin_info WHERE admin_username = ?";
                $stmt_check_username = $conn->prepare($sql_check_username);
                $stmt_check_username->bind_param("s", $username);
                $stmt_check_username->execute();
                $stmt_check_username->store_result();

                if ($stmt_check_username->num_rows === 0) {
                    // Hash the password for security before storing in the database
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Prepare and execute the SQL query to insert admin information into the database
                    $sql_insert_admin = "INSERT INTO admin_info (first_name, last_name, admin_username, admin_password) VALUES (?, ?, ?, ?)";
                    $stmt_insert_admin = $conn->prepare($sql_insert_admin);
                    $stmt_insert_admin->bind_param("ssss", $first_name, $last_name, $username, $hashed_password);

                    if ($stmt_insert_admin->execute()) {
                        // Admin registration successful, redirect to login page
                        header("Location: admin_login.php");
                        exit();
                    } else {
                        // Admin registration failed
                        echo "<p class='error-message'>Error occurred during registration. Please try again later.</p>";
                    }
                } else {
                    // Username is already registered
                    echo "<p class='error-message'>Username already exists. Please choose a different username.</p>";
                }
            }
        }
        ?>
        <form action="admin_register.php" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br>

            <input type="submit" value="Register">
        </form>

        <p>Already registered? <a href="admin_login.php">Login here</a></p>
    </div>
</body>
</html>

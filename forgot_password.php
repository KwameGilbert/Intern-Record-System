<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Forgot Password</h2>
        </div>
        <form action="forgot_password.php" method="post">
            <label for="index">Enter Your Index Number:</label>
            <input type="text" id="index" name="index" required>

            <input type="submit" value="Reset Password">
        </form>
        <div class="form-footer">
            <p>Remember your password? <a href="login.php">Login</a></p>
        </div>
    </div>

    <?php
    // Include the database connection file
    require_once "db_connection.php";

    // Function to sanitize form input
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Sanitize the form data
        $index = sanitize_input($_POST["index"]);

        // Check if the user exists in the database
        $sql = "SELECT id FROM users WHERE index_number = '$index'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            // User found, generate a random temporary password
            $temporary_password = substr(md5(uniqid(rand(), true)), 0, 10);

            // Hash the temporary password before updating the database
            $hashed_password = password_hash($temporary_password, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $update_sql = "UPDATE users SET password = '$hashed_password' WHERE index_number = '$index'";
            if ($conn->query($update_sql) === TRUE) {
                // Password reset successful, send the temporary password to the user's email (you can implement this part)

                // Display a message to the user
                echo "Your password has been reset. Please check your email for the temporary password.";
            } else {
                echo "Error resetting password: " . $conn->error;
            }
        } else {
            echo "User not found. Please check your index number.";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

</body>
</html>

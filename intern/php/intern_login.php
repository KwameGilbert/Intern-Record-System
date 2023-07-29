<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="../styles/style.css"> <!-- Link to your CSS file -->
</head>
    <body>
        <div class="form-container">
            <div class="form-header">
                <h2>Intern Login</h2>
            </div>
            <form action="./intern_login.php" method="post">
                <label for="index">Index Number:</label>
                <input type="text" id="index" name="index" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Login">
            </form>
            <div class="form-footer">
                <p>Don't have an account? <a href="./intern_register.php">Register</a></p>
                <p><a href="forgot_password.php">Forgot Password?</a></p>
            </div>
        </div>

        <?php
        // Include the database connection file
        require_once "../../db_connection/db_connection.php";

        // Function to sanitize form input
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Function to start a session
        function start_session() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Sanitize the form data
            $index = sanitize_input($_POST["index"]);
            $password = sanitize_input($_POST["password"]);

            // Prepare and execute the SQL query to retrieve intern data from the database
            $sql = "SELECT intern_id, intern_password FROM intern_credentials WHERE intern_index_number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $index);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                // Verify the password
                if (password_verify($password, $user["intern_password"])) {
                    // Password is correct, start the user session
                    start_session();
                    $_SESSION["intern_id"] = $user["intern_id"];
                    header("Location: ./intern_dashboard.php"); // Redirect to the dashboard after successful login
                    exit();
                } else {
                    echo "Invalid credentials. Please try again.";
                }
            } else {
                echo "User not found. Please register an account.";
            }

            // Close the database connection
            $conn->close();
        }
        ?>
    </body>
</html>
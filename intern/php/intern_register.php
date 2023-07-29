
<!DOCTYPE html>
<html>
<head>
    <title>Intern Registration</title>
    <link rel="stylesheet" href="../styles/style.css"> <!-- Link to your CSS file -->
    <style>
                
        .cancel-button {
            background-color: #ccc;
            color: #333;
            border: none;
            margin-left: 10px;
        }

        .cancel-button:hover {
            background-color: #ddd;
        }

        /* Existing styles for the form page (form.php) go here */

        /* CSS for the pop-up modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal {
            background-color: #fff; /* White background for the modal */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .modal-message {
            font-size: 18px;
            color: #333; /* Text color */
        }

        .modal-button {
            display: block;
            width: 100px;
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            background-color: #4CAF50; /* Green button color */
            color: #fff; /* Text color */
            text-decoration: none;
            border-radius: 5px;
        }

        .modal-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <h2>Intern Registration</h2>
        </div>
        <form action="./intern_register.php" method="post">
            <label for="index">Index Number:</label>
            <input type="text" id="index" name="index" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Register">
        </form>
        <div class="form-footer">
            <p>Already have an account? <a href="./intern_login.php">Log in</a></p>
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

    
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize the form data
    $index = sanitize_input($_POST["index"]);
    $password = sanitize_input($_POST["password"]);
    $confirm_password = sanitize_input($_POST["confirm_password"]);

    // Verify that the passwords match
    if ($password !== $confirm_password) {
        echo "<p class='error-message'>Passwords do not match. Please enter the same password in both fields.</p>";
    } else {
        // Check if the username is available (not already registered)
        $sql_check_index = "SELECT intern_id FROM intern_credentials WHERE intern_index_number = ?";
        $stmt_check_index = $conn->prepare($sql_check_index);
        $stmt_check_index->bind_param("s", $index);
        $stmt_check_index->execute();
        $stmt_check_index->store_result();

        if ($stmt_check_index->num_rows === 0) {
            // Hash the password for security before storing in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and execute the SQL query to insert intern credentials into the database
            $sql_insert_credentials = "INSERT INTO intern_credentials (intern_index_number, intern_password) VALUES (?, ?)";
            $stmt_insert_credentials = $conn->prepare($sql_insert_credentials);
            $stmt_insert_credentials->bind_param("ss", $index, $hashed_password);

            if ($stmt_insert_credentials->execute()) {
                // Intern registration successful
                echo '<div class="modal-overlay">';
                echo '<div class="modal">';
                echo '<p class="modal-message">' .  'Your information has been recorded successfully!</p>';
                echo '<a href="intern_login.php" class="modal-button">Close</a>';
                echo '</div>';
                echo '</div>';
            } else {
                // Intern Registration failed
                echo '<div class="modal-overlay">';
                echo '<div class="modal">';
                echo '<p class="modal-message">Error occurred during registration. Please try again later.</p>';
                echo '<a href="./intern_register.php" class="modal-button">Close</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="modal-overlay">';
            echo '<div class="modal">';
            echo '<p class="modal-message">Intern Index Number Already Exists, Please choose a correct index number or contact admins if the problem persists.</p>';
            echo '<a href="./intern_register.php" class="modal-button">Close</a>';
            echo '</div>';
            echo '</div>';
        }
    }

    // Close the database connection
    $conn->close();
}
?>


</body>
</html>


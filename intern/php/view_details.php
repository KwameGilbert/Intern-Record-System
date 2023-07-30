<!DOCTYPE html>
<html>
<head>
    <title>View Personal Details</title>
    <link rel="stylesheet" href="../view_details.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="view-details-container">
        <h2>Personal Details</h2>

        <?php
        // Include the database connection file
        require_once "../../db_connection/db_connection.php";

        // Function to start a session
        function start_session() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        // Check if the user is logged in
        start_session();
        if (!isset($_SESSION["intern_id"])) {
            header("Location: ./intern_login.php");
            exit();
        }

        // Retrieve the user's submitted details (if any)
        $user_id = $_SESSION["user_id"];
        $sql = "SELECT * FROM intern_details WHERE intern_id = $intern_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user_details = $result->fetch_assoc();
            // Display the user's details here (customize based on your form fields)
            echo "<p><strong>Name:</strong> " . $user_details["name"] . "</p>";
            echo "<p><strong>Index Number:</strong> " . $user_details["index_number"] . "</p>";
            echo "<p><strong>Programme of Study:</strong> " . $user_details["programme_of_study"] . "</p>";
            echo "<p><strong>School of Practice:</strong> " . $user_details["school_of_practice"] . "</p>";
            echo "<p><strong>Town:</strong> " . $user_details["town"] . "</p>";
            echo "<p><strong>District:</strong> " . $user_details["district"] . "</p>";
            echo "<p><strong>Class Assigned:</strong> " . $user_details["class_assigned"] . "</p>";
            echo "<p><strong>Subject(s) Taught:</strong> " . $user_details["subjects_taught"] . "</p>";
            echo "<p><strong>Year of Internship:</strong> " . $user_details["year_of_internship"] . "</p>";
            echo "<p><strong>Mentor ID:</strong> " .$user_details["mentor_id"] . "</p>";
            echo "<p><strong>Headmaster:</strong> " . $user_details["headmaster_name"] . "</p>";
        } else {
            echo "<h3>No details found.</h3>";
        }

        // ...

        ?>
        <br>
        <a href="./intern_form.php" class="edit-button">Edit Details</a>
        <a href="./intern_dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>

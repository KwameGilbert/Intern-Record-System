<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard_style.css">
</head>
<body>
    <div class="dashboard-container">
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

        // Check if the user has submitted details previously
        $intern_id = $_SESSION["intern_id"];
        $sql = "SELECT * FROM intern_details WHERE intern_id = $intern_id";
        $result = $conn->query($sql);

        // Fetch the intern's name
        $name = "Guest"; // Default name if not found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row["first_name"];
        }
        ?>
        <h2>Dashboard</h2>
        <p>Welcome <?php echo $name; ?></p>

        <?php
        if ($result->num_rows > 0) {
            // The user has submitted details before
            // Provide the option to edit the previously submitted details
            echo "<div class='dashboard-options'>";
            echo "<div class='dashboard-option'>";
            echo "<a href='./intern_form.php'>Edit Details</a>";
            echo "</div>";

            // Provide the option to view the details on a separate page
            echo "<div class='dashboard-option'>";
            echo "<a href='./view_details.php'>View Details</a>";
            echo "</div>";
            echo "</div>";
        } else {
            // The user has not submitted details yet
            echo "<div class='dashboard-options'>";
            // Provide the option to fill the internship form for the first time
            echo "<div class='dashboard-option'>";
            echo "<a href='./intern_form.php'>Fill Intern Particulars</a>";
            echo "</div>";
            echo "</div>";
        }

        // Add other dashboard options or user-specific functionalities as needed
        // ...

        ?>
        <br>
        <div class="dashboard-logout">
            <a href="./intern_logout.php">Logout</a>
        </div>
    </div>
</body>
</html>

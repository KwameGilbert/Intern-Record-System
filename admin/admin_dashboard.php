<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>
    <div class="dashboard-container">
        <?php
        // Include the database connection file
        require_once "db_connection.php";

        // Function to start a session
        function start_session() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        // Check if the admin is logged in
        start_session();
        if (!isset($_SESSION["admin_id"])) {
            header("Location: admin_login.php");
            exit();
        }

        // Fetch the admin's name
        $admin_id = $_SESSION["admin_id"];
        $sql = "SELECT * FROM admin_info WHERE admin_id = $admin_id";
        $result = $conn->query($sql);
        $first_name = "Admin"; // Default name if not found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $first_name = $row["first_name"];
        }
        ?>
        <h2>Admin Dashboard</h2>
        <p>Welcome, <?php echo $first_name; ?></p>

        <div class="dashboard-options">
            <div class="dashboard-option">
                <a href="admin_manage_interns.php">Manage Interns</a>
            </div>
            <div class="dashboard-option">
                <a href="admin_create_questions.php">Create Questions</a>
            </div>
            <div class="dashboard-option">
                <a href="admin_view_responses.php">View Responses</a>
            </div>
        </div>

        <br>
        <div class="dashboard-logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>

<?php
// Start the session
session_start();

// Check if the user is logged in (if the intern_id session variable is not set)
if (!isset($_SESSION["intern_id"])) {
    header("Location: ./intern_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ISB FORMS</title>
    <link rel="stylesheet" href="../styles/isb_forms.css"> <!-- Add your CSS file here (if any) -->
</head>
<body>
    <div class="header">
        <h1>ISB FORMS</h1>
        <p>Internship Forms</p>
    </div>

    <div class="form-links-container">
        <ul class="form-links">
            <li><a href="./ISB/isb1.php">ISB 1 - FAMILIARSATION WITH SCHOOL ENVIRONMENT & RECORDS</a></li>
            <li><a href="./ISB/isb2.php">ISB 2 - OBSERVATION OF MENTOR'S LESSONS
            </a></li>
            <li><a href="isb3.php">ISB 3 - SELECTION OF TOPICS TO BE TAUGHT</a></li>
            <li><a href="isb4.php">ISB 4 - PLANNING A LESSON WITH THE MENTOR</a></li>
            <li><a href="isb5.php">ISB 5 - TEACHING A LEESON WITH THE MENTOR</a></li>
            <li><a href="isb6.php">ISB 6 - INDIVIDUAL TEACHING</a></li>
            <li><a href="isb7.php">ISB 7 - INTERN TEACHING EVALUATION FORM</a></li>
            <li><a href="isb8.php">ISB 8 - TEACHING EVALUATION COMMENTS FORM</a></li>
            <li><a href="isb9.php">ISB 9 - OVERALL REFLECTION</a></li>
            <li><a href="isb10.php">ISB 10 - MENTOR'S EVALUATION FORM</a></li>
            <li><a href="isb11.php">ISB 11 - HEAD OF SCHOOL'S EVALUATION</a></li>

            <!-- Add more form links as needed -->
        </ul>
    </div>

    <!-- Add other sections or content here if required -->
   
    <div class="footer">
    <a href="./intern_dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>

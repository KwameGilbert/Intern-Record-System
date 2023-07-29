<?php
// Include the database connection file
require_once "db_connection.php";
// Include the functions file
require_once "functions.php";

// Function to start a session
function start_session() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Check if the user is logged in
start_session();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize the form data
    $user_id = $_SESSION["user_id"];
    $name = sanitize_input($_POST["name"]);
    $index = sanitize_input($_POST["index"]);
    $programme = sanitize_input($_POST["programme"]);
    $school = sanitize_input($_POST["school"]);
    $town = sanitize_input($_POST["town"]);
    $district = sanitize_input($_POST["district"]);
    $class = sanitize_input($_POST["class"]);
    $subjects = sanitize_input($_POST["subjects"]);
    $year = sanitize_input($_POST["year"]);
    $mentor = sanitize_input($_POST["mentor"]);
    $headmaster = sanitize_input($_POST["headmaster"]);

    // Prepare and execute the SQL query to update user data in the database
    $sql = "UPDATE intern_details SET name = '$name', index_number = '$index', programme_of_study = '$programme', school_of_practice = '$school', town = '$town', district = '$district', class_assigned = '$class', subjects_taught = '$subjects', year_of_internship = '$year', mentor_name = '$mentor', headmaster_name = '$headmaster' WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "Details updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Retrieve the user's submitted details (if any) to pre-fill the form fields
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM intern_details WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user_details = $result->fetch_assoc();
    } else {
        // Redirect to the dashboard if no details found to edit
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Internship Form</title>
    <link rel="stylesheet" href="form_style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Edit Internship Form</h2>
        </div>

        <!-- Edit form with pre-filled values -->
        <form action="update_form.php" method="post">
            <label for="name">Name of Intern:</label>
            <input type="text" id="name" name="name" value="<?php echo $user_details['name']; ?>" required><br><br>

            <label for="index">Index Number:</label>
            <input type="text" id="index" name="index" value="<?php echo $user_details['index_number']; ?>" required><br><br>

            <label for="programme">Programme of Study:</label>
            <input type="text" id="programme" name="programme" value="<?php echo $user_details['programme_of_study']; ?>" required><br><br>

            <label for="school">Name of School of Practice:</label>
            <input type="text" id="school" name="school" value="<?php echo $user_details['school_of_practice']; ?>" required><br><br>

            <label for="town">Town:</label>
            <input type="text" id="town" name="town" value="<?php echo $user_details['town']; ?>" required><br><br>

            <label for="district">District:</label>
            <input type="text" id="district" name="district" value="<?php echo $user_details['district']; ?>" required><br><br>

            <label for="class">Class Assigned:</label>
            <input type="text" id="class" name="class" value="<?php echo $user_details['class_assigned']; ?>" required><br><br>

            <label for="subjects">Subject(s) Taught:</label>
            <input type="text" id="subjects" name="subjects" value="<?php echo $user_details['subjects_taught']; ?>" required><br><br>

            <label for="year">Year of Internship:</label>
            <input type="number" id="year" name="year" value="<?php echo $user_details['year_of_internship']; ?>" required><br><br>

            <label for="mentor">Name of Mentor:</label>
            <input type="text" id="mentor" name="mentor" value="<?php echo $user_details['mentor_name']; ?>" required><br><br>

            <label for="headmaster">Name of Headmaster:</label>
            <input type="text" id="headmaster" name="headmaster" value="<?php echo $user_details['headmaster_name']; ?>" required><br><br>

            <div class="form-buttons">
                <input type="submit" value="Update">
                <a href="dashboard.php" class="cancel-button">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
// Include the database connection file
require_once "../../db_connection/db_connection.php";
// Include the functions file
require_once "../../db_connection/sanitize_input.php";

// Function to start a session
function start_session() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}



// Check if the user is logged in
start_session();
if (!isset($_SESSION["intern_id"])) {
    header("Location: ../styles/intern_login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize the form data
    $intern_id = $_SESSION["intern_id"];
    $index = sanitize_input($_POST["index"]);

    // Check if the index number is present (user filled the index field)
    if (!empty($index)) {
        // Fetch intern details from the database based on the intern_id
        $sql_get_details = "SELECT * FROM intern_details WHERE intern_id = $intern_id";
        $result_details = $conn->query($sql_get_details);

        if ($result_details->num_rows === 1) {
            // The user is updating their existing details, perform the update operation
            $first_name = sanitize_input($_POST["first_name"]);
            $last_name = sanitize_input($_POST["last_name"]);
            $name = $first_name . " " . $last_name;
            $programme = sanitize_input($_POST["programme"]);
            $school = sanitize_input($_POST["school"]);
            $town = sanitize_input($_POST["town"]);
            $district = sanitize_input($_POST["district"]);
            $class = sanitize_input($_POST["class"]);
            $subjects = sanitize_input($_POST["subjects"]);
            $year = sanitize_input($_POST["year"]);
            $mentor_id = sanitize_input($_POST["mentor_id"]);
            $headmaster = sanitize_input($_POST["headmaster"]);

            // Prepare and execute the SQL query to update user data in the database
            $sql = "UPDATE intern_details SET first_name = '$first_name', last_name = '$last_name', name = '$name', index_number = '$index', programme_of_study = '$programme', school_of_practice = '$school', town = '$town', district = '$district', class_assigned = '$class', subjects_taught = '$subjects', year_of_internship = '$year', mentor_id = '$mentor_id', headmaster_name = '$headmaster' WHERE intern_id = $intern_id";

            if ($conn->query($sql) === TRUE) {
                // Display the pop-up modal using HTML and CSS
                echo '<div class="modal-overlay">';
                echo '<div class="modal">';
                echo '<p class="modal-message">' . $name . ', your information has been updated successfully!</p>';
                echo '<a href="./intern_dashboard.php" class="modal-button">Close</a>';
                echo '</div>';
                echo '</div>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // The user is filling the form for the first time, perform the insert operation
            $first_name = sanitize_input($_POST["first_name"]);
            $last_name = sanitize_input($_POST["last_name"]);
            $name = $first_name . " " . $last_name;
            $programme = sanitize_input($_POST["programme"]);
            $school = sanitize_input($_POST["school"]);
            $town = sanitize_input($_POST["town"]);
            $district = sanitize_input($_POST["district"]);
            $class = sanitize_input($_POST["class"]);
            $subjects = sanitize_input($_POST["subjects"]);
            $year = sanitize_input($_POST["year"]);
            $mentor_id = sanitize_input($_POST["mentor_id"]);
            $headmaster = sanitize_input($_POST["headmaster"]);

            // Prepare and execute the SQL query to insert user data into the database
            $sql = "INSERT INTO intern_details (
                intern_id, first_name, last_name, name, index_number, programme_of_study, school_of_practice, town, district, class_assigned, subjects_taught, year_of_internship, mentor_id, headmaster_name) VALUES ('$intern_id', '$first_name', '$last_name', '$name', '$index', '$programme', '$school', '$town', '$district', '$class', '$subjects', '$year', '$mentor_id', '$headmaster')";

            if ($conn->query($sql) === TRUE) {
                // Display the pop-up modal using HTML and CSS
                echo '<div class="modal-overlay">';
                echo '<div class="modal">';
                echo '<p class="modal-message">' . $name . ', your information has been submitted successfully!</p>';
                echo '<a href="./intern_dashboard.php" class="modal-button">Close</a>';
                echo '</div>';
                echo '</div>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the database connection
        $conn->close();
        exit(); // Exit here to prevent displaying the form again after successful submission
    }
} else {
    // Retrieve the user's index number (if any) to pre-fill the form fields
    $intern_id = $_SESSION["intern_id"];
    $sql_get_index = "SELECT intern_index_number FROM intern_credentials WHERE intern_id = $intern_id";
    $result_index = $conn->query($sql_get_index);

    if ($result_index->num_rows === 1) {
        $index_row = $result_index->fetch_assoc();
        $index = $index_row["intern_index_number"];
    } else {
        // Handle the case where the index number is not found (you can set a default value or display an error)
        $index = "";
    }

    // Fetch intern details from the database based on the intern_id
    $sql_get_details = "SELECT * FROM intern_details WHERE intern_id = $intern_id";
    $result_details = $conn->query($sql_get_details);

    if ($result_details->num_rows === 1) {
        $intern_details = $result_details->fetch_assoc();
        $pageTitle = 'Edit Intern Particulars';
    } else {
        $pageTitle = 'Fill Intern Particulars';
        // Handle the case where the user's details are not found (you can set default values or display an error)
        // Example of setting default values:
        $intern_details = array(
            'first_name' => '',
            'last_name' => '',
            'programme_of_study' => '',
            'school_of_practice' => '',
            'town' => '',
            'district' => '',
            'class_assigned' => '',
            'subjects_taught' => '',
            'year_of_internship' => '',
            'mentor_id' => '',
            'headmaster_name' => ''
        );
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="../styles/form_style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2><?php echo $pageTitle; ?></h2>
        </div>

        <!-- Display appropriate form based on whether intern_details is set or not -->
        <?php if (isset($intern_details)) { ?>
           
        <!-- Edit form with pre-filled values -->
        <form action="./intern_form.php" method="post">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo isset($intern_details) ? $intern_details['first_name'] : ''; ?>" required><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo isset($intern_details) ? $intern_details['last_name'] : ''; ?>" required><br><br>

    <label for="index">Index Number:</label>
    <input type="text" id="index" name="index" value="<?php echo $index; ?>" required><br><br>

    <label for="programme">Programme of Study:</label>
    <input type="text" id="programme" name="programme" value="<?php echo isset($intern_details) ? $intern_details['programme_of_study'] : ''; ?>" required><br><br>

    <label for="school">Name of School of Practice:</label>
    <input type="text" id="school" name="school" value="<?php echo isset($intern_details) ? $intern_details['school_of_practice'] : ''; ?>" required><br><br>

    <label for="town">Town:</label>
    <input type="text" id="town" name="town" value="<?php echo isset($intern_details) ? $intern_details['town'] : ''; ?>" required><br><br>

    <label for="district">District:</label>
    <input type="text" id="district" name="district" value="<?php echo isset($intern_details) ? $intern_details['district'] : ''; ?>" required><br><br>

    <label for="class">Class Assigned:</label>
    <input type="text" id="class" name="class" value="<?php echo isset($intern_details) ? $intern_details['class_assigned'] : ''; ?>" required><br><br>

    <label for="subjects">Subject(s) Taught:</label>
    <input type="text" id="subjects" name="subjects" value="<?php echo isset($intern_details) ? $intern_details['subjects_taught'] : ''; ?>" required><br><br>

    <label for="year">Year of Internship:</label>
    <input type="number" id="year" name="year" value="<?php echo isset($intern_details) ? $intern_details['year_of_internship'] : ''; ?>" required><br><br>

    <label for="mentor_id">Mentor ID:</label>
    <input type="text" id="mentor_id" name="mentor_id" value="<?php echo isset($intern_details) ? $intern_details['mentor_id'] : ''; ?>" required><br><br>

    <label for="headmaster">Name of Headmaster:</label>
    <input type="text" id="headmaster" name="headmaster" value="<?php echo isset($intern_details) ? $intern_details['headmaster_name'] : ''; ?>" required><br><br>

    <div class="form-buttons">
        <input type="submit" value="Update">
        <a href="./intern_dashboard.php" class="cancel-button">Cancel</a>
    </div>
</form>

        <?php } else { ?>
            <!-- Form for filling internship details for the first time -->
            <form action="./intern_form.php" method="post">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required><br><br>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required><br><br>

                <label for="index">Index Number:</label>
                <input type="text" id="index" name="index" value="<?php echo $index; ?>" required><br><br>

                <label for="programme">Programme of Study:</label>
                <input type="text" id="programme" name="programme" required><br><br>

                <label for="school">Name of School of Practice:</label>
                <input type="text" id="school" name="school" required><br><br>

                <label for="town">Town:</label>
                <input type="text" id="town" name="town" required><br><br>

                <label for="district">District:</label>
                <input type="text" id="district" name="district" required><br><br>

                <label for="class">Class Assigned:</label>
                <input type="text" id="class" name="class" required><br><br>

                <label for="subjects">Subject(s) Taught:</label>
                <input type="text" id="subjects" name="subjects" required><br><br>

                <label for="year">Year of Internship:</label>
                <input type="number" id="year" name="year" required><br><br>

                <label for="mentor_id">Mentor ID:</label>
                <input type="text" id="mentor_id" name="mentor_id" required><br><br>

                <label for="headmaster">Name of Headmaster:</label>
                <input type="text" id="headmaster" name="headmaster" required><br><br>

                <div class="form-buttons">
                    <input type="submit" value="Submit">
                    <a href="./intern_dashboard.php" class="cancel-button">Cancel</a>
                </div>
            </form>
        <?php } ?>
    </div>
</body>
</html>

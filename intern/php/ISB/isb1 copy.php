s<?php
//PHP to handle the isb_forms
// Include the database connection file
require_once "../../../db_connection/db_connection.php";
// Include the functions file
require_once "../../../db_connection/sanitize_input.php";

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

// Get the intern_id from the session
$intern_id = $_SESSION["intern_id"];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the user's index number
    $intern_id = $_SESSION["intern_id"];

    // Collect the form data
    
    $established_year = $_POST["established_year"];
    $total_students = $_POST["total_students"];
    $boys_students = $_POST["boys_students"];
    $girls_students = $_POST["girls_students"];
    $female_teachers = $_POST["female_teachers"];
    $male_teachers = $_POST["male_teachers"];
    $male_non_teaching_staff = $_POST["male_non_teaching_staff"];
    $female_non_teaching_staff = $_POST["female_non_teaching_staff"];
    $classrooms = $_POST["classrooms"];
    $reporting_time = $_POST["reporting_time"];
    $closing_time = $_POST["closing_time"];
    $sexual_harassment_policy = $_POST["sexual_harassment_policy"];
    $national_gender_policy = $_POST["national_gender_policy"];
    $equity_inclusive_policy = $_POST["equity_inclusive_policy"];
    $ict_laboratory = $_POST["ict_laboratory"];
    $filling_date = $_POST["filling_date"];

    // Prepare and execute the SQL query to insert data into the "isb1" table
    $sql = "INSERT INTO isb1 (
        intern_id, index_number, established_year, total_students, boys_students, girls_students, female_teachers, male_teachers, male_non_teaching_staff, female_non_teaching_staff, classrooms, reporting_time, closing_time, sexual_harassment_policy, national_gender_policy, equity_inclusive_policy, ict_laboratory, filling_date
    ) VALUES (
        '$intern_id', '$index', '$established_year', '$total_students', '$boys_students', '$girls_students', '$female_teachers', '$male_teachers', '$male_non_teaching_staff', '$female_non_teaching_staff', '$classrooms', '$reporting_time', '$closing_time', '$sexual_harassment_policy', '$national_gender_policy', '$equity_inclusive_policy', '$ict_laboratory', '$filling_date'
    )";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Display the pop-up modal using HTML and CSS
        echo '<div class="modal-overlay">';
        echo '<div class="modal">';
        echo '<p class="modal-message">' . $fname . ', ISB 1 has been submitted successfully!</p>';
        echo '<a href="./intern_dashboard.php" class="modal-button">Close</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
} ?>

<!DOCTYPE html>
<html>
<head>
    <title>IRB 1 - Familiarisation with the School Environment and Documents/Records</title>
    <link rel="stylesheet" href="../../styles/isb.css"> <!-- Link to CSS file -->
</head>
<body>
    <h1>IRB 1</h1>
    <h2>Familiarisation with the School Environment and Documents/Records</h2>
    <?php //Fetch intern details from the database based on the intern_id
    
    $sql_get_details = "SELECT * FROM isb1 WHERE intern_id = $intern_id";
    $result_details = $conn->query($sql_get_details);

    if ($result_details->num_rows === 1) {
        $isb1 = $result_details->fetch_assoc();
       
    }  ?>

        <!-- Display appropriate form based on whether intern_details is set or not -->
        <?php if (isset($isb1)) { ?>
           
           
    <h3>Instruction: Complete this observation guide with your mentor. <br>IRB 1 should be completed first week of the internship</h3>
    <form>
        <label class="isb_view" >When was the school established?  :    <span class="isb_view_ans"><?php echo isset($isb1) ? $isb1['established_year'] : ''; ?></span></label>
       

        <label class="isb_view" >What is the total number of students in the school?    :
        <span class="isb_view_ans"><?php echo isset($isb1) ? $isb1['total_students'] : ''; ?></span></label>


        <label class="isb_view" >How many are boys?</label>
        <input type="number" name="boys_students" value="<?php echo isset($isb1) ? $isb1['boys_students'] : ''; ?>" required><br>

        <label class="isb_view" >How many are girls?</label>
        <input type="number" name="girls_students" value="<?php echo isset($isb1) ? $isb1['established_year'] : ''; ?>" required><br>

        <label class="isb_view" >What is the number of female teachers in the school?</label>
        <input type="number" name="female_teachers" value="<?php echo isset($isb1) ? $isb1['female_teachers'] : ''; ?>" required><br>

        <label class="isb_view" >What is the number of male teachers in the school?</label>
        <input type="number" name="male_teachers" value="<?php echo isset($isb1) ? $isb1['male_teachers'] : ''; ?>" required><br>

        <label class="isb_view" >How many non-teaching staff (if any) are males?</label>
        <input type="number" name="male_non_teaching_staff" value="<?php echo isset($isb1) ? $isb1['male_non_teaching_staff'] : ''; ?>" required><br>

        <label class="isb_view" >How many non-teaching staff (if any) are females?</label>
        <input type="number" name="female_non_teaching_staff"  value="<?php echo isset($isb1) ? $isb1['female_non_teaching_staff'] : ''; ?>" required><br>

        <label class="isb_view" >What is the number of classrooms in the school?</label>
        <input type="number" name="classrooms" value="<?php echo isset($isb1) ? $isb1['female_non_teaching_staff'] : ''; ?>" required><br>

        <label class="isb_view" >What is the reporting time of the school?</label>
        <input type="time" name="reporting_time"  value="<?php echo isset($isb1) ? $isb1['female_non_teaching_staff'] : ''; ?>" required><br>

        <label class="isb_view" >What is the closing time of the school?</label>
        <input type="time" name="closing_time"  value="<?php echo isset($isb1) ? $isb1['female_non_teaching_staff'] : ''; ?>" required><br>


        <h3>Complete the checklist of the following items <br> (Available, Not Available)</h3>
        <hr>
        <div class="radio_q">
            <label  class="isb_view" >Sexual Harassment Policy</label>
            <input type="radio" name="sexual_harassment_policy" value="Available" required> Available
            <input type="radio" name="sexual_harassment_policy" value="Not Available" required> Not Available<br>
        </div>
        <hr>
        <div class="radio_q">
            <label  class="isb_view" >National Gender Policy</label>
            <input type="radio" name="national_gender_policy" value="Available" required> Available
            <input type="radio" name="national_gender_policy" value="Not Available" required> Not Available<br>
        </div>
        <hr>
        <div class="radio_q">
            <label  class="isb_view" >Equity and Inclusive Education Policy</label>
            <input type="radio" name="equity_inclusive_policy" value="Available" required> Available
            <input type="radio" name="equity_inclusive_policy" value="Not Available" required> Not Available<br>
        </div>
        <hr>
        <!-- Add more checklist items as needed -->
        <div class="radio_q">
            <label  class="isb_view" >ICT Laboratory</label>
            <input type="radio" name="ict_laboratory" value="Available" required> Available
            <input type="radio" name="ict_laboratory" value="Not Available" required> Not Available<br>
        </div>
        <hr>
        <label>Date of Filling form:</label>
        <input type="date" name="filling_date" value="<?php echo date('Y-m-d'); ?>" required readonly><br>

    
        <div class="form-buttons">
            <input type="submit" value="Submit">
            <a href="../isb_forms.php" class="cancel-button">Cancel</a>
        </div>
    </form>

   
           <?php } else { ?>
               <!-- Form for filling internship details for the first time -->
               
    <form action="" method="post">
    <h3>Instruction: Complete this observation guide with your mentor. <br>IRB 1 should be completed first week of the internship</h3>
        <label>When was the school established?</label>
        <input type="year" name="established_year" required><br>

        <label>What is the total number of students in the school?</label>
        <input type="number" name="total_students" required><br>

        <label>How many are boys?</label>
        <input type="number" name="boys_students" required><br>

        <label>How many are girls?</label>
        <input type="number" name="girls_students" required><br>

        <label>What is the number of female teachers in the school?</label>
        <input type="number" name="female_teachers" required><br>

        <label>What is the number of male teachers in the school?</label>
        <input type="number" name="male_teachers" required><br>

        <label>How many non-teaching staff (if any) are males?</label>
        <input type="number" name="male_non_teaching_staff" required><br>

        <label>How many non-teaching staff (if any) are females?</label>
        <input type="number" name="female_non_teaching_staff" required><br>

        <label>What is the number of classrooms in the school?</label>
        <input type="number" name="classrooms" required><br>

        <label>What is the reporting time of the school?</label>
        <input type="time" name="reporting_time" required><br>

        <label>What is the closing time of the school?</label>
        <input type="time" name="closing_time" required><br>


        <h3>Complete the checklist of the following items <br> (Available, Not Available)</h3>
        <hr>
        <div class="radio_q">
            <label >Sexual Harassment Policy</label>
            <input type="radio" name="sexual_harassment_policy" value="Available" required> Available
            <input type="radio" name="sexual_harassment_policy" value="Not Available" required> Not Available<br>
        </div>
        <hr>
        <div class="radio_q">
            <label >National Gender Policy</label>
            <input type="radio" name="national_gender_policy" value="Available" required> Available
            <input type="radio" name="national_gender_policy" value="Not Available" required> Not Available<br>
        </div>
        <hr>
        <div class="radio_q">
            <label >Equity and Inclusive Education Policy</label>
            <input type="radio" name="equity_inclusive_policy" value="Available" required> Available
            <input type="radio" name="equity_inclusive_policy" value="Not Available" required> Not Available<br>
        </div>
        <hr>
        <!-- Add more checklist items as needed -->
        <div class="radio_q">
            <label >ICT Laboratory</label>
            <input type="radio" name="ict_laboratory" value="Available" required> Available
            <input type="radio" name="ict_laboratory" value="Not Available" required> Not Available<br>
        </div>
        <hr>
        <label>Date of Filling form:</label>
        <input type="date" name="filling_date" value="<?php echo date('Y-m-d'); ?>" required readonly><br>

    
        <div class="form-buttons">
            <input type="submit" value="Submit">
            <a href="../isb_forms.php" class="cancel-button">Cancel</a>
        </div>
    </form>

           <?php } ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>IRB 1 - Familiarisation with the School Environment and Documents/Records</title>
    <link rel="stylesheet" href="../../styles/isb.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>IRB 1</h1>
    <h2>Familiarisation with the School Environment and Documents/Records</h2>
    
    <form action="" method="post">
    <h4>Instruction: Complete this observation guide with your mentor. <br>IRB 1 should be completed first week of the internship</h4>
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

        <h4>Complete the checklist of the following items (Available, Not Available)</h4>
        <label>Sexual Harassment Policy</label>
        <input type="radio" name="sexual_harassment_policy" value="Available" required> Available
        <input type="radio" name="sexual_harassment_policy" value="Not Available" required> Not Available<br>

        <label>14. National Gender Policy</label>
        <input type="radio" name="national_gender_policy" value="Available" required> Available
        <input type="radio" name="national_gender_policy" value="Not Available" required> Not Available<br>

        <label>15. Equity and Inclusive Education Policy</label>
        <input type="radio" name="equity_inclusive_policy" value="Available" required> Available
        <input type="radio" name="equity_inclusive_policy" value="Not Available" required> Not Available<br>

        <!-- Add more checklist items as needed -->

        <label>20. ICT Laboratory</label>
        <input type="radio" name="ict_laboratory" value="Available" required> Available
        <input type="radio" name="ict_laboratory" value="Not Available" required> Not Available<br>

        <label>Date of Filling form:</label>
        <input type="date" name="filling_date" value="<?php echo date('Y-m-d'); ?>" required><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

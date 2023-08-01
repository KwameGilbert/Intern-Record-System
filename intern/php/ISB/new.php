
// Fetch intern details from the database based on the intern_id
    $sql_get_details = "SELECT * FROM isb1 WHERE intern_id = $intern_id";
    $result_details = $conn->query($sql_get_details);

    if ($result_details->num_rows === 1) {
        $isb1 = $result_details->fetch_assoc();
       
    } 

        <!-- Display appropriate form based on whether intern_details is set or not -->
        <?php if (isset($isb1)) { ?>
           
           <!-- Edit form with pre-filled values -->
          
    <form action="isb1.php" method="post">
    <h3>Instruction: Complete this observation guide with your mentor. <br>IRB 1 should be completed first week of the internship</h3>
        <label>When was the school established?</label>
        <input type="year" name="established_year" value="<?php echo isset($isb1) ? $isb1['established_year'] : ''; ?>" required><br>

        <label>What is the total number of students in the school?</label>
        <input type="number" name="total_students" value="<?php echo isset($isb1) ? $isb1['total_students'] : ''; ?>" required><br>

        <label>How many are boys?</label>
        <input type="number" name="boys_students" value="<?php echo isset($isb1) ? $isb1['boys_students'] : ''; ?>" required><br>

        <label>How many are girls?</label>
        <input type="number" name="girls_students" value="<?php echo isset($isb1) ? $isb1['established_year'] : ''; ?>" required><br>

        <label>What is the number of female teachers in the school?</label>
        <input type="number" name="female_teachers" value="<?php echo isset($isb1) ? $isb1['female_teachers'] : ''; ?>" required><br>

        <label>What is the number of male teachers in the school?</label>
        <input type="number" name="male_teachers" value="<?php echo isset($isb1) ? $isb1['male_teachers'] : ''; ?>" required><br>

        <label>How many non-teaching staff (if any) are males?</label>
        <input type="number" name="male_non_teaching_staff" value="<?php echo isset($isb1) ? $isb1['$male_non_teaching_staff'] : ''; ?>" required><br>

        <label>How many non-teaching staff (if any) are females?</label>
        <input type="number" name="female_non_teaching_staff"  value="<?php echo isset($isb1) ? $isb1['female_non_teaching_staff'] : ''; ?>" required><br>

        <label>What is the number of classrooms in the school?</label>
        <input type="number" name="classrooms" value="<?php echo isset($isb1) ? $isb1['female_non_teaching_staff'] : ''; ?>" required><br>

        <label>What is the reporting time of the school?</label>
        <input type="time" name="reporting_time"  value="<?php echo isset($isb1) ? $isb1['female_non_teaching_staff'] : ''; ?>" required><br>

        <label>What is the closing time of the school?</label>
        <input type="time" name="closing_time"  value="<?php echo isset($isb1) ? $isb1['female_non_teaching_staff'] : ''; ?>" required><br>


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
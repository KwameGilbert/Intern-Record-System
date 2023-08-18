<?php
session_start();

// Function to check if the form is editable (not submitted or saved as draft)
function isFormEditable() {
    return !isset($_SESSION["form_submitted"]) && !isset($_SESSION["form_saved"]);
}

// Function to check if the form is in draft state (saved as draft but not submitted)
function isFormDraft() {
    return isset($_SESSION["form_saved"]) && !isset($_SESSION["form_submitted"]);
}

// Function to check if the form is read-only (submitted)
function isFormReadOnly() {
    return isset($_SESSION["form_submitted"]);
}

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intern_details";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];

    if (isset($_POST["save_as_draft"])) {
        // Save the form data as a draft
        $_SESSION["form_data"] = [
            "name" => $name,
        ];
        $_SESSION["form_saved"] = true;
        unset($_SESSION["form_submitted"]);

        // Save the draft data to the database (you can create a table "drafts" to store this data)
        // Sample query: INSERT INTO drafts (name) VALUES ('$name')

        // Redirect to prevent form resubmission on page refresh
        header("Location: index.html");
        exit();
    } elseif (isset($_POST["submit"])) {
        // Submit the form data
        $_SESSION["form_data"] = [
            "name" => $name,
        ];
        $_SESSION["form_submitted"] = true;
        unset($_SESSION["form_saved"]);

        // Save the submitted data to the database (you can create a table "submissions" to store this data)
        // Sample query: INSERT INTO submissions (name) VALUES ('$name')

        // Redirect to prevent form resubmission on page refresh
        header("Location: index.html");
        exit();
    } elseif (isset($_POST["delete_draft"])) {
        // Delete the draft data and start fresh
        unset($_SESSION["form_data"]);
        unset($_SESSION["form_saved"]);

        // Redirect to prevent form resubmission on page refresh
        header("Location: index.html");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Example</title>
</head>
<body>
    <h1>Form Example</h1>
    <form action="form_handler.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : ''; ?>" <?php echo isset($_SESSION['form_submitted']) ? 'readonly' : ''; ?>>
        <br>

        <?php if (!isset($_SESSION['form_submitted'])) { ?>
            <input type="submit" value="Save as Draft" name="save_as_draft">
            <input type="submit" value="Submit" name="submit">
        <?php } ?>

        <?php if (isset($_SESSION['form_saved'])) { ?>
            <input type="submit" value="Delete Draft" name="delete_draft">
        <?php } ?>
    </form>
</body>
</html>

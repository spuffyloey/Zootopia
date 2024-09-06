<?php
// Start session
session_start();

// Include the database connection file
include 'dbconn.php';

$emailErr = $passwordErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check if the email exists in the database
    $sql = "SELECT * FROM account WHERE email='$email'";
    $result = $dbconn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists, now check if the password matches
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Set session variables
            $_SESSION['email'] = $email;
            $_SESSION['accountID'] = $row['accountID'];
            $_SESSION['category'] = $row['category'];

            if ($_SESSION['category'] == 'visitor') {
                $visitorQuery = "SELECT visitor_id, firstName FROM visitor WHERE accountID = ".$_SESSION['accountID'];
                $visitorResult = $dbconn->query($visitorQuery);
                if ($visitorResult->num_rows > 0) {
                    $visitorRow = $visitorResult->fetch_assoc();
                    
                    $_SESSION['firstName'] = $visitorRow['firstName'];
                    $_SESSION['visitor_id'] = $visitorRow['visitor_id'];

                    // Redirect to visitorindex.php
                    echo "<script>window.location.href='visitorindex.php';</script>";
                }
            } else {
                // Redirect to adminindex.php
                echo "<script>window.location.href='adminindex.php';</script>";
            }
            exit;
        } else {
            // If password does not match, show error message
            $passwordErr = "Password does not match. Please try again.";
        }
    } else {
        // If email does not exist, show error message
        $emailErr = "Email does not exist. Please try again.";
    }

    // Store error messages in session
    $_SESSION['emailErr'] = $emailErr;
    $_SESSION['passwordErr'] = $passwordErr;

    // Redirect back to the login page
    header("Location: loginindex.php");
    exit();
}
?>


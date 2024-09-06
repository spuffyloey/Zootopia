<?php
include 'dbconn.php'; // Include the database connection file

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$email = $password = $firstName = $lastName = $phone = ""; // Changed variable name to $phone
$emailErr = $passwordErr = $phoneErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = sanitizeInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            // Check if email already exists
            $stmt = $dbconn->prepare("SELECT email FROM account WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $emailErr = "Email already exists";
            }
            $stmt->close();
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = sanitizeInput($_POST["password"]);
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters long";
        }
    }

    // Validate phone number
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = sanitizeInput($_POST["phone"]);
        if (!is_numeric($phone)) {
            $phoneErr = "Phone number must be numeric";
        }
    }

    // Check if there are no errors before inserting into the database
    if (empty($emailErr) && empty($passwordErr) && empty($phoneErr)) {
        // Prepare and bind for inserting into account table
        $stmt = $dbconn->prepare("INSERT INTO account (email, password, category) VALUES (?, ?, 'visitor')");
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            // Retrieve the newly inserted accountID
            $accountID = $stmt->insert_id;

            // Insert additional user details into visitor table
            $firstName = sanitizeInput($_POST["firstName"]);
            $lastName = sanitizeInput($_POST["lastName"]);
            $phone = sanitizeInput($_POST["phone"]); // Changed variable name to $phone

            $stmt_visitor = $dbconn->prepare("INSERT INTO visitor (accountID, firstName, lastName, phone) VALUES (?, ?, ?, ?)");
            $stmt_visitor->bind_param("isss", $accountID, $firstName, $lastName, $phone);
            $stmt_visitor->execute();

            // Close the statement
            $stmt_visitor->close();

            // Redirect to login page with success message
            header("Location: loginindex.php?success=1");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Store error messages in session
        session_start();
        $_SESSION['emailErr'] = $emailErr;
        $_SESSION['passwordErr'] = $passwordErr;
        $_SESSION['phoneErr'] = $phoneErr;

        // Redirect back to the signup page
        header("Location: signupindex.php");
        exit();
    }
}

// Close the database connection
mysqli_close($dbconn);
?>

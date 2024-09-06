<?php
session_start();

// Include dbconn.php to establish database connection
require_once 'dbconn.php';

$phoneErr = "";

if (isset($_SESSION['accountID'])) {
    // Fetch visitor's details from the database based on the account ID
    $account_id = $_SESSION['accountID'];
    $sql = "SELECT v.*, a.email FROM visitor v JOIN account a ON v.accountID = a.accountID WHERE a.accountID = $account_id";
    $result = $dbconn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $phone = $row['Phone'];
        $address = $row['address'];
        $email = $row['email'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Update visitor's details in the database based on user input
            $newFirstName = $_POST['firstName'];
            $newLastName = $_POST['lastName'];
            $newPhone = $_POST['phone'];
            $newAddress = $_POST['address'];

            // Validate phone number
            if (!is_numeric($newPhone)) {
                $phoneErr = "Phone number must be numeric";
                session_start();
                $_SESSION['phoneErr'] = $phoneErr;
                header("Location: profileindex.php?success=2");
                exit();
            }

            // Begin transaction
            $dbconn->begin_transaction();

            try {
                $updateVisitorSql = "UPDATE visitor 
                                     SET firstName = '$newFirstName', 
                                         lastName = '$newLastName', 
                                         Phone = '$newPhone', 
                                         address = '$newAddress' 
                                     WHERE accountID = $account_id";

                if ($dbconn->query($updateVisitorSql) === TRUE) {
                    // Update all session variables with the new values
                    $_SESSION['firstName'] = $newFirstName;
                    $_SESSION['lastName'] = $newLastName;
                    $_SESSION['phone'] = $newPhone;
                    $_SESSION['address'] = $newAddress;

                    // Commit transaction
                    $dbconn->commit();

                    // Redirect to profileindex.php with a success message
                    header("Location: profileindex.php?success=1");
                    exit();
                } else {
                    throw new Exception("Error updating record: " . $dbconn->error);
                }
            } catch (Exception $e) {
                // Rollback transaction
                $dbconn->rollback();
                echo $e->getMessage();
            }
        }
    } else {
        echo "Visitor details not found.";
    }
} else {
    header("Location: loginindex.php");
    exit();
}
?>

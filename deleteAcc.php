<?php
session_start();
require_once 'dbconn.php'; // Include dbconn.php to establish database connection

if (isset($_SESSION['accountID'])) {
    $account_id = $_SESSION['accountID'];

    // Set the accountID to NULL in the visitor table
    $sql_update_visitor = "UPDATE visitor SET accountID = NULL WHERE accountID = $account_id";
    $result_update_visitor = $dbconn->query($sql_update_visitor);

    // Delete account from the database
    $sql_account = "DELETE FROM account WHERE accountID = $account_id";
    $result_account = $dbconn->query($sql_account);

    if ($result_account) {
        // Destroy the session
        session_destroy();
        header("Location: goodbye.php"); // Redirect to a goodbye page or a confirmation page
        exit();
    } else {
        echo "Error: Unable to delete account.";
    }
} else {
    header("Location: loginindex.php");
    exit();
}
?>

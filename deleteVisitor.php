<?php
include("dbconn.php");

if (isset($_GET['v_id'])) {
    $visitor_id = $_GET['v_id'];

    // Retrieve accountID and email associated with the visitor_id
    $sql = "SELECT v.accountID, a.email FROM visitor v LEFT JOIN account a ON v.accountID = a.accountID WHERE v.visitor_id = $visitor_id";
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
    $row = mysqli_fetch_assoc($query);
    $accountID = $row['accountID'];
    $email = $row['email'];

    // Delete referencing records in the ticket table
    $sql = "DELETE FROM ticket WHERE visitor_id = $visitor_id";
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

    // Delete the record from the visitor table
    $sql = "DELETE FROM visitor WHERE visitor_id = $visitor_id";
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

    // Check if the email exists and delete the record from the account table if it does
    if (!empty($email)) {
        $sql = "DELETE FROM account WHERE accountID = $accountID";
        $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
    }

    // Display a success message
    echo "<script>alert('Data has been deleted successfully!');</script>";

    // Redirect to visitordetails.php
    echo "<script>window.location.href='visitordetails.php';</script>";
}
?>

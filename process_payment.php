<?php
include('dbconn.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_type = $_POST['payment_type'];
    
    // Ensure visitor is logged in
    if (!isset($_SESSION['visitor_id'])) {
        die("Error: Visitor not logged in.");
    }

    $visitor_id = $_SESSION['visitor_id']; // Get visitor ID from session

    // Retrieve session variables
    $total_price = $_SESSION['total_price'];
    $visit_date = $_SESSION['visit_date'];
    $child_tickets = $_SESSION['child_tickets'];
    $adult_tickets = $_SESSION['adult_tickets'];
    $senior_tickets = $_SESSION['senior_tickets'];
    $package_no = isset($_SESSION['package_no']) ? $_SESSION['package_no'] : null;

    // Insert payment details
    $query = "INSERT INTO payment (payment_type, payment_date) VALUES ('$payment_type', NOW())";
    
    if (mysqli_query($dbconn, $query)) {
        // Get the last inserted payment_no
        $payment_no = mysqli_insert_id($dbconn);

        // Insert child tickets
        for ($i = 0; $i < $child_tickets; $i++) {
            $query = "INSERT INTO ticket (ticket_price, ticket_type, ticket_date, visitor_id, package_no, payment_no) VALUES (31.00, 'Child', '$visit_date', '$visitor_id', " . ($package_no ? "'$package_no'" : "NULL") . ", '$payment_no')";
            mysqli_query($dbconn, $query);
        }

        // Insert adult tickets
        for ($i = 0; $i < $adult_tickets; $i++) {
            $query = "INSERT INTO ticket (ticket_price, ticket_type, ticket_date, visitor_id, package_no, payment_no) VALUES (38.00, 'Adult', '$visit_date', '$visitor_id', " . ($package_no ? "'$package_no'" : "NULL") . ", '$payment_no')";
            mysqli_query($dbconn, $query);
        }

        // Insert senior tickets
        for ($i = 0; $i < $senior_tickets; $i++) {
            $query = "INSERT INTO ticket (ticket_price, ticket_type, ticket_date, visitor_id, package_no, payment_no) VALUES (31.00, 'Senior', '$visit_date', '$visitor_id', " . ($package_no ? "'$package_no'" : "NULL") . ", '$payment_no')";
            mysqli_query($dbconn, $query);
        }

        echo "<script>alert('Payment successful!'); window.location.href='receipt.php';</script>";
    } else {
        echo "<script>alert('Payment failed! Please try again.'); window.location.href='payment.php';</script>";
    }
}
?>

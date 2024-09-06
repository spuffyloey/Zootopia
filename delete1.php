<?php
include("dbconn.php");

if(isset($_GET['v_id'])) {
    $visitor_id = $_GET['v_id'];

    // Delete referencing records in table5
    $sql = "DELETE FROM ticket WHERE visitor_id = $visitor_id";
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());

    // Delete the record from the visitor table
    $sql = "DELETE FROM visitor WHERE visitor_id = $visitor_id";
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());

    // Display a success message
    echo "<script>alert('Data has been deleted successfully!');</script>";

    // Redirect to visitordetails.php
    echo "<script>window.location.href='visitordetails.php';</script>";
}
?>
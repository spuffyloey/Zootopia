<?php
// deletePack.php

// Include the database connection file
include("dbconn.php");

// Check if the package no is set in the URL
if (isset($_GET['v_id'])) {
    $package_no = $_GET['v_id'];

    // SQL query to check if there are any tickets referencing this package
    $checkSql = "SELECT COUNT(*) as count FROM ticket WHERE package_no = '$package_no'";
    $checkQuery = mysqli_query($dbconn, $checkSql) or die("Error: " . mysqli_error($dbconn));
    $checkResult = mysqli_fetch_assoc($checkQuery);

    // If there are tickets referencing the package, notify the user
    if ($checkResult['count'] > 0) {
        echo "<script>alert('This package cannot be deleted as it has been selected by customers for their bookings.');</script>";
        echo "<script>window.location.href='packageInfo.php';</script>";
    } else {
        // SQL query to delete the package
        $sql = "DELETE FROM package WHERE package_no = '$package_no'";

        // Execute the query
        $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));

        // Check if the query was successful
        if ($query) {
            echo "<script>alert('Package deleted successfully!');</script>";
            echo "<script>window.location.href='packageInfo.php';</script>";
        } else {
            echo "<script>alert('Error deleting package!');</script>";
            echo "<script>window.location.href='packageInfo.php';</script>";
        }
    }
} else {
    echo "<script>alert('Invalid package no!');</script>";
    echo "<script>window.location.href='packageInfo.php';</script>";
}

// Close the database connection
mysqli_close($dbconn);
?>

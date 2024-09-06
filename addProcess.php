<?php
include("dbconn.php");

$p_name = $_REQUEST['package_name'];
$p_desc = $_REQUEST['package_desc'];
$p_price = $_REQUEST['package_price'];

$sqlInsert = "INSERT INTO package VALUES ('$p_no', '$p_name', '$p_desc', '$p_price')";
if (mysqli_query($dbconn, $sqlInsert)) {
    echo "<script>alert(' Data has been add succesfully " . mysqli_error($dbconn) . "');</script>";
    echo "<script>window.location.href='packageInfo.php';</script>";
}
    

?>
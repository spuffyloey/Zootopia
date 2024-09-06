<?php
include("dbconn.php");

if (isset($_GET['v_id'])) {
    $visitor_id = $_GET['v_id'];
    $sql = "SELECT * FROM visitor WHERE visitor_id = $visitor_id";
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
    $row = mysqli_fetch_array($query);
}

if (isset($_POST['submit'])) {
    $visitor_id = $_POST['visitor_id'];
    $accountID = $_POST['accountID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $Phone = $_POST['Phone'];

    $sql = "UPDATE visitor SET firstName = '$firstName', lastName = '$lastName', Phone = '$Phone' WHERE visitor_id = $visitor_id";
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
    
    // Display a success message
    echo "<script>alert('Data has been updated successfully!');</script>";
    
    // Redirect to visitor_details.php
    echo "<script>window.location.href='visitordetails.php';</script>";
}
?>

<html>
<head>
    <title>Update Visitor Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
            background-color: #000; /* Hex color code for consistency */
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 200px; /* Adjust padding as needed */
        }
        .Logo {
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 1.8em;
        }
        .nav {
            display: flex;
        }
        .nav a {
            color: rgb(255, 255, 255);
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5em;
            padding-left: 32px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #F0F8FF;
            margin-top: 80px;
        }
        h1 {
            color: #333;
            text-align: center;
            padding: 20px;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="hidden"], input[readonly] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #153448;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
    <header>
        <a href="adminindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="visitordetails.php">BACK</a>
            <a href="adminindex.php"> HOME </a>
        </nav>
    </header>
    <h1>Update Visitor Details</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="visitor_id" value="<?php echo $row['visitor_id']; ?>">
        Account ID: <input type="text" name="accountID" value="<?php echo $row['accountID']; ?>" readonly><br>
        <input type="hidden" name="accountID" value="<?php echo $row['accountID']; ?>"> <!-- Hidden input for accountID -->
        First Name: <input type="text" name="firstName" value="<?php echo $row['firstName']; ?>" required><br>
        Last Name: <input type="text" name="lastName" value="<?php echo $row['lastName']; ?>" required><br>
        Phone: <input type="text" name="Phone" value="<?php echo $row['Phone']; ?>" required><br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Update Package Details</title>
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding-top: 100px; /* Prevent content from hiding behind the fixed header */
            background-color: #F0F8FF;
        }

        form {
            width: 500px; /* Increased width */
            margin: 0 auto;
            padding: 30px; /* Adjusted padding */
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
            background-color: #fff; /* Ensure a white background */
        }

        /* Form Styles */
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
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5em;
            padding-left: 32px;
        }
        .nav a:hover {
            color: blue;
        }

        label {
            display: block;
            margin-top: 15px; /* Increased margin */
            font-size: 1.1em; /* Increased font size */
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px; /* Increased padding */
            margin-top: 5px; /* Added margin for better spacing */
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 0px 2px rgba(0,0,0,0.1);
            font-size: 1.1em; /* Increased font size */
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 1.1em; /* Increased font size */
        }

        input[type="submit"]:hover {
            background-color: #0d2533;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .show-popup {
            display: block;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px; /* Added margin for better spacing */
        }
    </style>
</head>
<body>
<header>
    <a href="adminindex.php" class="Logo">Zootopia &Co</a>
    <nav class="nav">
      <a href="packageInfo.php">BACK</a>
      <a href="adminindex.php">HOME</a>
    </nav>
  </header>
    <h1>Update Package Details</h1>
    <?php
        // include database connection file
        include("dbconn.php");

        // get the package no from the URL parameter
        $package_no = $_GET['v_id'];

        // retrieve the package details from the database
        $sql = "SELECT * FROM package WHERE package_no = '$package_no'";
        $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
        $row = mysqli_fetch_array($query);
    ?>
    <form action="updatePack.php" method="post">
        <input type="hidden" name="package_no" value="<?php echo $row["package_no"]; ?>">
        <label for="package_name">Package Name:</label>
        <input type="text" name="package_name" value="<?php echo $row["package_name"]; ?>">
        <label for="package_desc">Package Description:</label>
        <textarea name="package_desc"><?php echo $row["package_desc"]; ?></textarea>
        <label for="package_price">Package Price:</label>
        <input type="text" name="package_price" value="<?php echo $row["package_price"]; ?>">
        <input type="submit" name="update" value="Update">
    </form>

    <?php
        if (isset($_POST['update'])) {
            $package_no = $_POST['package_no'];
            $package_name = $_POST['package_name'];
            $package_desc = $_POST['package_desc'];
            $package_price = $_POST['package_price'];

            $sql = "UPDATE package SET package_name = '$package_name', package_desc = '$package_desc', package_price = '$package_price' WHERE package_no = '$package_no'";
            $query = mysqli_query($dbconn, $sql) or die ("Error:" . mysqli_error());

            if ($query) {
                echo "<script>alert('Package has been updated successfully!');</script>";
                echo "<script>window.location.href='packageInfo.php';</script>";
            }
        }
    ?>
</body>
</html>
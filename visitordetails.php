<?php
session_start(); // Start the session at the beginning of your PHP script
include("dbconn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visitor Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url(img/bg3.jpg) no-repeat center center/cover;
            height: 100vh;
            margin-top: 80px;
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

        .table-wrapper {
            margin-left: 20px; 
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin-right: auto;
            margin-left: auto;
        }

        h1 {
            color: black;
            margin-bottom: 10px;
            margin-left: 225px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        tr:nth-child(odd) {
            background-color: rgba(255, 255, 255, 0.8); 
        }

        tr:nth-child(even) {
            background-color: white;
        }

        th {
            background-color: #153448;
            color: white;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container form {
            display: flex;
            align-items: center;
            margin-left: 225px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            width: 300px;
        }

        .search-container button {
            padding: 10px;
            font-size: 16px;
            background-color: #153448;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .search-container button:hover {
            background-color: #0056b3;
        }

        .totals {
            font-size: 16px;
            margin-right: 225px;
        }

        .wide-column {
            width: 200px; /* Increased width for email and phone columns */
        }

        .black-text {
            color: black;
            font-weight: 700;
            font-size: 1.5em;
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

        .btn {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 400;
            color: white;
            background-color: #153448;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            header {
                padding: 10px 20px; /* Adjust padding for mobile view */
                flex-direction: column;
                align-items: flex-start;
            }

            .Logo {
                font-size: 1.5em; /* Reduce font size */
            }
        }
    </style>
    <script>
        function confirmDelete(visitor_id) {
            if (confirm('Are you sure you want to delete this visitor? This action will delete all visitor information, including account details and ticket reservations.')) {
                window.location.href = 'deleteVisitor.php?v_id=' + visitor_id;
            }
        }
    </script>
</head>
<body>
    <header>
        <a href="adminindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="adminindex.php">HOME</a>
        </nav>
    </header>
    <div class="table-wrapper">
        <h1>Visitor Details</h1>

        <div class="search-container">
            <form action="visitordetails.php" method="get">
                <input type="text" name="search" placeholder="Search by email...">
                <button type="submit">Search</button>
            </form>
            <div class="totals">
                <?php
                // Calculate total visitors
                $totalVisitorsResult = mysqli_query($dbconn, "SELECT COUNT(*) AS totalVisitors FROM visitor");
                $totalVisitorsRow = mysqli_fetch_assoc($totalVisitorsResult);
                $totalVisitors = $totalVisitorsRow['totalVisitors'];

                echo "<span class='black-text'>Total Visitors: " . $totalVisitors . "</span>";
                ?>
            </div>
        </div>

        <tbody>
        <?php
        // Check if a search query is set
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

        // Modify SQL query to join visitor and account tables using LEFT JOIN and add search functionality
        $sql = "SELECT v.*, a.email FROM visitor v LEFT JOIN account a ON v.accountID = a.accountID";
        if ($searchQuery) {
            $sql .= " WHERE a.email LIKE '%" . mysqli_real_escape_string($dbconn, $searchQuery) . "%' OR a.email IS NULL";
        }

        $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
        $row = mysqli_num_rows($query);

        if ($row == 0) {
            echo "No record found";
        } else {
            echo "<table>";
            echo "<tr>";
            echo "<th>VISITOR ID</th>";
            echo "<th>ACCOUNT ID</th>";
            echo "<th class='wide-column'>VISITOR EMAIL</th>";
            echo "<th>VISITOR FIRSTNAME</th>";
            echo "<th>VISITOR LASTNAME</th>";
            echo "<th class='wide-column'>VISITOR PHONE</th>";
            echo "<th colspan='3'>OPTIONS</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $row["visitor_id"] . "</td>";
                echo "<td>" . $row["accountID"] . "</td>";
                echo "<td class='wide-column'>" . ($row["email"] ? $row["email"] : 'null') . "</td>";
                echo "<td>" . $row["firstName"] . "</td>";
                echo "<td>" . $row["lastName"] . "</td>";
                echo "<td class='wide-column'>" . $row["Phone"] . "</td>";
                echo "<td><button class='btn' onclick='confirmDelete( " . $row["visitor_id"] . " )'>Delete</button></td>";
                echo "<td><a class='btn' href='update.php?v_id=" . $row["visitor_id"] . "'>Update</a></td>";
                echo "<td><a class='btn' href='individuticket.php?visitor_id=" . $row["visitor_id"] . "'>View Tickets</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
        </tbody>
    </div>
</body>
</html>

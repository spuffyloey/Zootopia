<!DOCTYPE html>
<html>
<head>
    <title>Ticket Details</title>
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: url(img/bg3.jpg) no-repeat center center/cover;
            font-family: Arial, sans-serif;
            margin-top: 90px;
            height: 100vh;
        }

        header {
            background-color: #000;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 200px;
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

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 20px 10px 20px;
        }

        h1 {
            margin-left: 210px;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin-right: auto;
            margin-left: auto;
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

        .totals {
            background-color: white;
            text-align: right;
            font-weight: 100;
            font-size: 0.9em;
            margin-right: 210px;
            opacity: 80%;
        }
    </style>
</head>
<body>
    <header>
        <a href="adminindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="adminindex.php">HOME</a>
        </nav>
    </header>

    <?php
    include("dbconn.php");

    $sql = "SELECT t.ticket_no, t.ticket_price, t.ticket_type, t.ticket_date, t.visitor_id, t.package_no, p.payment_no, p.payment_type, pk.package_price
            FROM ticket t
            JOIN visitor v ON t.visitor_id = v.visitor_id
            JOIN payment p ON t.payment_no = p.payment_no
            LEFT JOIN package pk ON t.package_no = pk.package_no";
    
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
    
    $totalTicketSales = 0;
    $totalPackageSales = 0;
    $rows = [];

    while ($row = mysqli_fetch_array($query)) {
        $rows[] = $row;
        $totalTicketSales += $row["ticket_price"];
        if ($row["package_price"]) {
            $totalPackageSales += $row["package_price"];
        }
    }
    $totalSales = $totalTicketSales + $totalPackageSales;
    ?>

    <div class="content-header">
        <h1>Ticket Details</h1>
        <div class="totals">
            <h2>Total Ticket Sales: RM<?php echo $totalTicketSales; ?></h2>
            <h2>Total Package Sales: RM<?php echo $totalPackageSales; ?></h2>
            <h2>Total Sales: RM<?php echo $totalSales; ?></h2>
        </div>
    </div>
    <table border=1>
    <thead>
        <tr>
            <th>TICKET NO</th>
            <th>TICKET PRICE</th>
            <th>TICKET TYPE</th>
            <th>TICKET DATE</th>
            <th>VISITOR ID</th>
            <th>PACKAGE NO</th>
            <th>PAYMENT NO</th>
            <th>PAYMENT TYPE</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if (count($rows) == 0) {
        echo "<tr><td colspan='8'>No record found</td></tr>";
    } else {
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>".$row["ticket_no"]."</td>";
            echo "<td>".$row["ticket_price"]."</td>";
            echo "<td>".$row["ticket_type"]."</td>";
            echo "<td>".$row["ticket_date"]."</td>";
            echo "<td>".$row["visitor_id"]."</td>";
            echo "<td>".$row["package_no"]."</td>";
            echo "<td>".$row["payment_no"]."</td>";
            echo "<td>".$row["payment_type"]."</td>";
            echo "</tr>";
        }
    }
    ?>
    </tbody>
    </table>
</body>
</html>

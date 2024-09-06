<!DOCTYPE html>
<html>
<head>
    <title>Visitor Tickets</title>
    <style>
        * {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background: #F0F8FF;
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
        h1 {
			color: black;
			margin-bottom: 10px;
            margin-left: 150px;
		}
        .table-wrapper {
			margin-left: 20px; 

		}
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-right: auto;
            margin-left: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        tr:nth-child(odd) {
			background-color: #ececec; /* Adjust the opacity as needed */
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
            margin-left: 150px;
        }
        .search-container form {
            display: flex;
            align-items: center;
        }
        .search-container input[type="text"],
        .search-container input[type="date"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        .search-container button {
            padding: 10px;
            font-size: 16px;
            background-color: #153448;
            color: white;
            border: none;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: #0056b3;
        }
        .totals {
            margin-top: 20px;
            color: black;
			font-weight: 700;
			font-size: 1.5em;
            margin-left: 150px;
        }
        .black-text {
			color: black;
			font-weight: 400;
			font-size: 1em;
		}
    </style>
</head>
<body>
<header>
        <a href="adminindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="visitordetails.php"> BACK </a>
            <a href="adminindex.php"> HOME </a>
        </nav>
    </header>
    <div class="table-wrapper">
        <h1>Visitor Tickets</h1>

        <div class="search-container">
            <form action="individuticket.php" method="get">
                <input type="text" name="visitor_id" placeholder="Search by Visitor ID..." value="<?php echo htmlspecialchars(isset($_GET['visitor_id']) ? $_GET['visitor_id'] : ''); ?>">
                <label for="start_date" class='black-text'>Start Date:</label>
                <input type="date" name="start_date" id="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                <label for="end_date" class='black-text'>End Date:</label>
                <input type="date" name="end_date" id="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="totals">
            <?php
            include("dbconn.php");

            // Get the visitor ID and dates from the URL
            $visitor_id = isset($_GET['visitor_id']) ? $_GET['visitor_id'] : '';
            $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
            $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

            if ($visitor_id) {
                // Query to get the total number of tickets for the visitor within the date range
                $sqlTotal = "SELECT COUNT(t.ticket_no) AS totalTickets
                            FROM ticket t
                            WHERE t.visitor_id = '" . mysqli_real_escape_string($dbconn, $visitor_id) . "'";
                if ($start_date && $end_date) {
                    $sqlTotal .= " AND t.ticket_date BETWEEN '" . mysqli_real_escape_string($dbconn, $start_date) . "' AND '" . mysqli_real_escape_string($dbconn, $end_date) . "'";
                }
                $totalTicketsResult = mysqli_query($dbconn, $sqlTotal) or die("Error: " . mysqli_error($dbconn));
                $totalTicketsRow = mysqli_fetch_assoc($totalTicketsResult);
                $totalTickets = $totalTicketsRow['totalTickets'];

                echo "Total Tickets: " . $totalTickets;
            }
            ?>
        </div>

        <div>
            <?php
            if ($visitor_id) {
                // Query to get tickets based on visitor ID and date range
                $sql = "SELECT t.ticket_no, t.ticket_price, t.ticket_type, t.ticket_date, t.visitor_id, t.package_no, p.payment_type
                        FROM ticket t
                        JOIN payment p ON t.payment_no = p.payment_no
                        WHERE t.visitor_id = '" . mysqli_real_escape_string($dbconn, $visitor_id) . "'";
                if ($start_date && $end_date) {
                    $sql .= " AND t.ticket_date BETWEEN '" . mysqli_real_escape_string($dbconn, $start_date) . "' AND '" . mysqli_real_escape_string($dbconn, $end_date) . "'";
                }
                $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
                $row = mysqli_num_rows($query);

                if ($row == 0) {
                    echo "<span class='white-text'>No tickets found for this visitor ID and date range.</span>";
                } else {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>TICKET NO</th>";
                    echo "<th>TICKET PRICE</th>";
                    echo "<th>TICKET TYPE</th>";
                    echo "<th>TICKET DATE</th>";
                    echo "<th>VISITOR ID</th>";
                    echo "<th>PACKAGE NO</th>";
                    echo "<th>PAYMENT TYPE</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $row["ticket_no"] . "</td>";
                        echo "<td>" . $row["ticket_price"] . "</td>";
                        echo "<td>" . $row["ticket_type"] . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row["ticket_date"])) . "</td>"; // Format the ticket_date as yyyy-mm-dd
                        echo "<td>" . $row["visitor_id"] . "</td>";
                        echo "<td>" . $row["package_no"] . "</td>";
                        echo "<td>" . $row["payment_type"] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                }
            } else {
                echo "No visitor ID specified.";
            }
            ?>
        </div>
    </div>
</body>
</html>
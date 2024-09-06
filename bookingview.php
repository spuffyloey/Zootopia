<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Zoo Booking Details</title>
    <link rel="stylesheet" href="booking-style.css">
</head>
<body>
    <header>
        <a href="adminindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="visitorindex.php">HOME</a>
        </nav>
    </header>
    <in>
    <div class="flex-container">
    <div class="container">
        <h1>Booking Details</h1>
        <form action="" method="get">
            <label for="booking-date">Enter Date:</label>
            <input type="date" id="booking-date" name="end_date">
            <button type="submit">Check Booking</button>
        </form>
        <div class="result">
            <?php
            include("dbconn.php");
            session_start();

            if (isset($_SESSION['accountID'])) {
                $accountID = $_SESSION['accountID'];
                $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                // Base SQL query
                $sql = "SELECT t.ticket_date, t.ticket_type, COUNT(t.ticket_type) as ticket_count, p.package_name
                        FROM ticket t
                        JOIN visitor v ON t.visitor_id = v.visitor_id
                        JOIN account a ON v.accountID = a.accountID
                        LEFT JOIN package p ON t.package_no = p.package_no
                        WHERE a.accountID = ?";

                // Add date filter if provided
                if (!empty($end_date)) {
                    $sql .= " AND t.ticket_date = ?";
                }

                $sql .= " GROUP BY t.ticket_date, t.ticket_type, p.package_name";

                // Prepare the statement
                $stmt = mysqli_prepare($dbconn, $sql);

                // Bind parameters
                if (!empty($end_date)) {
                    mysqli_stmt_bind_param($stmt, 'ss', $accountID, $end_date);
                } else {
                    mysqli_stmt_bind_param($stmt, 's', $accountID);
                }

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                // Flag to check if tickets were found
                $tickets_found = false;

                // Fetch and process the results
                while ($row = mysqli_fetch_assoc($result)) {
                    $tickets_found = true;
                    echo 'Ticket Date: ' . $row['ticket_date'] . '<br>';
                    echo 'Ticket Type: ' . $row['ticket_type'] . ' x' . $row['ticket_count'] . '<br>';
                    echo 'Package Name: ' . ($row['package_name'] ?? 'None') . '<br><br>';
                }

                if (!$tickets_found) {
                    if (!empty($end_date)) {
                        echo 'No tickets found for the date: ' . htmlspecialchars($end_date) . '.';
                        echo '<br>';
                        echo 'Click Check Booking to go back to ticket list.';
                    } else {
                        echo 'No tickets found.';
                    }
                }

                // Close the statement and connection
                mysqli_stmt_close($stmt);
                mysqli_close($dbconn);
            } else {
                echo "Please log in to view your bookings.";
            }
            ?>
        </div>
    </div>
    </div>
</body>

</html>

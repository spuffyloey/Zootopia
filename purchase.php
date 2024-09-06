<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="Style-Main.css">
    <title>Purchase Tickets - ZOOTOPIA &CO</title>
    <style>
        .container {
            text-align: center;
            padding: 100px;
            background: #F0F8FF;
        }

        .ticket-summary {
            margin-top: 20px;
            padding: 50px;
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: inline-block;
        }

        .ticket-summary h2 {
            margin-bottom: 20px;
        }

        .ticket-summary p {
            margin: 10px 0;
        }

        .back-btn {
            color: azure;
            background-color: rgb(0, 0, 0);
            text-decoration: none;
            font-size: 1.0em;
            font-weight: 600;
            margin: 20px auto;
            display: block;
            padding: 0.9375em 2.1875em;
            width: fit-content;
            letter-spacing: 1px;
            border-radius: 15px;
            margin-top: 20px;
            transition: 0.7s ease;
        }
        .main-btn {
            color: azure;
            background-color: rgb(0, 0, 0);
            text-decoration: none;
            font-size: 1.0em;
            font-weight: 600;
            margin: 20px auto;
            display: block;
            padding: 0.9375em 2.1875em;
            width: fit-content;
            letter-spacing: 1px;
            border-radius: 15px;
            margin-top: 20px;
            transition: 0.7s ease;
        }

        .back-btn:hover {
            background-color: #323268;
            transform: scale(1.1);
        }
        @media (max-width: 600px) {
        .container {
            padding: 20px; /* Reduce padding for mobile view */
            width: 90%; /* Set the width to 90% for mobile view */
            margin: 0 auto; /* Center the container */
            padding-top: 80px;
        }

        .back-btn, .main-btn {
            margin: 20px auto; /* Center the buttons */
        }
    }
    </style>
</head>
<body>
    <header>
        <a href="visitorindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="visitorindex.php">HOME</a>
        </nav>
    </header>

    <div class="container">
    <?php
    include('dbconn.php');
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_SESSION['visitor_id'])) {
            die("Error: Visitor not logged in.");
        }

        $visitor_id = $_SESSION['visitor_id']; // Get visitor ID from session

        $child_tickets = isset($_POST['child_tickets']) ? (int)$_POST['child_tickets'] : 0;
        $adult_tickets = isset($_POST['adult_tickets']) ? (int)$_POST['adult_tickets'] : 0;
        $senior_tickets = isset($_POST['senior_tickets']) ? (int)$_POST['senior_tickets'] : 0;
        $visit_date = isset($_POST['visit_date']) ? $_POST['visit_date'] : '';
        
        // Calculate total price
        $total = ($child_tickets * 31.00) + ($adult_tickets * 38.00) + ($senior_tickets * 31.00);
        
        // Check if a package is selected
        $package_no = isset($_POST['package']) ? (int)$_POST['package'] : null;
        
        // Fetch package details if a package is selected
        $package_details = [];
        if ($package_no) {
            $query = "SELECT package_name, package_price FROM package WHERE package_no = '$package_no'";
            $result = mysqli_query($dbconn, $query);
            if ($result && $package_data = mysqli_fetch_assoc($result)) {
                $package_details = $package_data;
                $total += $package_data['package_price'];
            }
        }

        // Display ticket purchase summary
        echo "<div class='ticket-summary'>";
        echo "<h2>Ticket Purchase Summary</h2>";

        if ($child_tickets > 0) {
            echo "<p>Child Tickets: $child_tickets x RM 31.00 = RM " . number_format($child_tickets * 31.00, 2) . "</p>";
        }
        if ($adult_tickets > 0) {
            echo "<p>Adult Tickets: $adult_tickets x RM 38.00 = RM " . number_format($adult_tickets * 38.00, 2) . "</p>";
        }
        if ($senior_tickets > 0) {
            echo "<p>Senior Tickets: $senior_tickets x RM 31.00 = RM " . number_format($senior_tickets * 31.00, 2) . "</p>";
        }
        
        if ($package_no && $package_details) {
            echo "<p>{$package_details['package_name']} = RM " . number_format($package_details['package_price'], 2) . "</p>";
        }

        echo "<p>Total Price: RM " . number_format($total, 2) . "</p>";
        echo "<p>Visit Date: $visit_date</p>";
        echo "</div>";

        // Select Again button
        echo "<a href='ticketBuying.php' class='back-btn'>Back</a>";

        // Payment button
        echo "<form action='payment.php' method='POST'>";
        echo "<input type='hidden' name='total_price' value='$total'>";
        echo "<input type='hidden' name='visit_date' value='$visit_date'>";
        echo "<input type='hidden' name='child_tickets' value='$child_tickets'>";
        echo "<input type='hidden' name='adult_tickets' value='$adult_tickets'>";
        echo "<input type='hidden' name='senior_tickets' value='$senior_tickets'>";
        if ($package_no && $package_details) {
            echo "<input type='hidden' name='package_no' value='$package_no'>";
        }
        echo "<input type='submit' class='main-btn' value='Proceed To Payment'>";
        echo "</form>";
    }
    ?>
</div>


</body>
</html>
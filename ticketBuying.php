<?php include('dbconn.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="ticketBuy-Style.css">
    <title>Purchase Tickets - ZOOTOPIA &CO</title>
    <style>
        .hidden-package {
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <a href="visitorindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="visitorIndex.php">HOME</a>
        </nav>
    </header>

    <div class="container">
        <h2>PURCHASE YOUR TICKETS</h2>
        <h3>Choose your ticket type, package, and visit date.</h3>
        <form action="purchase.php" method="post" class="ticket-form">

            <div class="ticket-category">
                <h4>Tickets</h4>
                <label>
                    Child Ticket (RM 31.00): 
                    <input type="number" name="child_tickets" min="0" value="0">
                </label>
                <label>
                    Adult Ticket (RM 38.00): 
                    <input type="number" name="adult_tickets" min="0" value="0">
                </label>
                <label>
                    Senior Ticket (RM 31.00): 
                    <input type="number" name="senior_tickets" min="0" value="0">
                </label>
            </div>

            <div class="ticket-category">
            <h4>Packages</h4>
            <?php
            $query = "SELECT * FROM package";
            $result = mysqli_query($dbconn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $packageNo = $row['package_no'];
                $packageName = $row['package_name'];
                $packagePrice = $row['package_price'];

                // Check if the package should be hidden
                $hidden = false;
                if (isset($_COOKIE['hiddenPackages'])) {
                    $hiddenPackages = json_decode($_COOKIE['hiddenPackages'], true);
                    if (in_array($packageNo, $hiddenPackages)) {
                        $hidden = true;
                    }
                }

                if (!$hidden) { // Only echo the label if the package is not hidden
                    echo '<label class="package-label" data-package-no="'. $packageNo. '">';
                    echo '<input type="radio" name="package" value="'. $packageNo. '">';
                    echo $packageName. ' (+RM '. number_format($packagePrice, 2). ')';
                    echo '</label>';
                }
            }
            ?>
        </div>

            <label for="visit-date">Select Date:</label>
            <input type="date" id="visit-date" name="visit_date" required min="<?php echo date('Y-m-d'); ?>"><br>
            <input type="submit" value="Buy Tickets" class="main-btn">
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const packageLabels = document.querySelectorAll('.package-label');
            packageLabels.forEach(label => {
                const packageNo = label.dataset.packageNo;
                const isHidden = localStorage.getItem('hiddenPackage-' + packageNo);
                console.log('Package ' + packageNo + ' hidden status: ' + isHidden);
                if (isHidden) {
                    label.style.display = 'none'; // Hide the package label
                }
            });
        });
    </script>
</body>
</html>

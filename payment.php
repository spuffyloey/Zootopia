<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['total_price'] = $_POST['total_price'];
    $_SESSION['visit_date'] = $_POST['visit_date'];
    $_SESSION['child_tickets'] = $_POST['child_tickets'];
    $_SESSION['adult_tickets'] = $_POST['adult_tickets'];
    $_SESSION['senior_tickets'] = $_POST['senior_tickets'];
    $_SESSION['package_no'] = isset($_POST['package_no']) ? $_POST['package_no'] : null;

    $package_no = isset($_SESSION['package_no']) ? $_SESSION['package_no'] : null;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="Style-Main.css">
    <title>Zoo Ticket Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F0F8FF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        header {
            top: 0;
            background-color: rgb(0, 0, 0);
            width: 100%;
            position: fixed;
            z-index: 999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 200px;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            display: none; /* Initially hide all containers */
        }

        .container.active {
            display: block; /* Only the active container will be displayed */
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .btn {
            background-color: rgb(0, 0, 0);
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #323268;
        }

        .modal {
            display: none; /* Ensure the modal is hidden initially */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close-btn {
            margin-top: 20px;
            background-color: #d9534f;
        }

        .close-btn:hover {
            background-color: #c9302c;
        }

        .return-btn {
            margin-top: 5px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: block;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .return-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <a href="#" class="Logo">Zootopia &Co</a>
        <nav class="nav">
        </nav>
    </header>

    <div id="selection-container" class="container active">
        <h2>Select Payment Method</h2>
        <div class="form-group">
            <form id="credit-card-form" onsubmit="event.preventDefault(); showCardContainer();">
                <input type="hidden" name="payment_type" value="Credit Card">
                <button type="submit" class="btn">Credit/Debit Card</button>
            </form>
        </div>
        <div class="form-group">
            <form id="online-banking-form" onsubmit="event.preventDefault(); showBankContainer();">
                <input type="hidden" name="payment_type" value="Online Banking">
                <button type="submit" class="btn">Online Banking</button>
            </form>
        </div>
    </div>

    <div id="card-container" class="container">
        <h2>Pay with Card</h2>
        <form id="card-payment-form" method="POST" onsubmit="event.preventDefault(); processPayment('card-payment-form')">
            <div class="form-group">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9012 3456">
            </div>
            <div class="form-group">
                <label for="card-expiry">Expiry Date</label>
                <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/YY">
            </div>
            <div class="form-group">
                <label for="card-cvc">CVC</label>
                <input type="text" id="card-cvc" name="card_cvc" placeholder="123">
            </div>
            <input type="hidden" name="payment_type" value="Credit Card">
            <button type="submit" class="btn">Pay Now</button>
        </form>
    </div>

    <div id="bank-container" class="container">
        <h2>Pay with Online Banking</h2>
        <form id="bank-payment-form" method="POST" onsubmit="event.preventDefault(); processPayment('bank-payment-form')">
            <div class="form-group">
                <label for="bank-name">Bank Name</label>
                <select id="bank-name" name="bank_name">
                    <option value="">Select your bank</option>
                    <option value="Maybank2u">Maybank2u</option>
                    <option value="CIMB Clicks">CIMB Clicks</option>
                    <option value="RHB Now">RHB Now</option>
                    <option value="Bank Islam">Bank Islam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bank-account">Bank Account Number</label>
                <input type="text" id="bank-account" name="bank_account" placeholder="Enter your bank account number">
            </div>
            <input type="hidden" name="payment_type" value="Online Banking">
            <button type="submit" class="btn">Pay Now</button>
        </form>
    </div>

    <div id="success-modal" class="modal">
        <div class="modal-content">
            <h2>Payment Successful</h2>
            <p>Thank you for your payment. Your transaction has been completed.</p>
            <button class="btn close-btn" onclick="redirectAfterPayment('bookingview.php')">Close</button>
            <button class="btn return-btn" onclick="redirectAfterPayment('visitorindex.php')">Return to Home</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Show the selection container first when the page loads
            document.getElementById('selection-container').classList.add('active');
        });

        function showCardContainer() {
            document.getElementById('selection-container').classList.remove('active');
            document.getElementById('card-container').classList.add('active');
        }

        function showBankContainer() {
            document.getElementById('selection-container').classList.remove('active');
            document.getElementById('bank-container').classList.add('active');
        }

        function processPayment(formId) {
            const form = document.getElementById(formId);
            const formData = new FormData(form);

            fetch('process_payment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    showModal();
                } else {
                    alert('Payment failed! Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }

        function showModal() {
            document.getElementById('success-modal').style.display = 'flex';
        }

        function redirectAfterPayment(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
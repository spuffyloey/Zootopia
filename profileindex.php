<?php
session_start();
require_once 'dbconn.php'; // Include dbconn.php to establish database connection

$phoneErr = isset($_SESSION['phoneErr']) ? $_SESSION['phoneErr'] : "";

// Clear error messages from session
unset($_SESSION['phoneErr']);

if (isset($_SESSION['accountID'])) {
    // Fetch visitor's details from the database based on the account ID
    $account_id = $_SESSION['accountID'];
    $sql = "SELECT v.*, a.email FROM visitor v JOIN account a ON v.accountID = a.accountID WHERE a.accountID = $account_id";
    $result = $dbconn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $phone = $row['Phone'];
        $address = $row['address'];
        $email = $row['email'];
    } else {
        echo "Visitor details not found.";
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="Profile-Style.css">
    <title>User Profile</title>
</head>
<body>
    <header>
        <a href="visitorindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="visitorindex.php">HOME</a>
            <a onclick="confirmLogOut()">LOG OUT</a>
        </nav>
    </header>

    <div class="login-container-wrapper">
        <section class="login-container">
            <h2>PROFILE</h2>

            <?php
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo '<p class="success-message">Profile updated successfully!</p>';
            }
            if ($phoneErr) echo '<p class="error-message"> ' . $phoneErr .' </p>' ;
            ?>

            <form id="profile-form" action="profile.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <span><?php echo htmlspecialchars($email); ?></span>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>">
                    <button type="button" class="clear-address-btn" onclick="clearAddress()"><i class="fa fa-trash"></i></button>
                </div>
                
                <button type="submit" class="profile-btn" >Save Changes</button>
                
            </form>
             <!-- Delete Account Button -->
             <button type="submit" class="delete-btn" onclick="confirmDelete()">Delete Account</button>
        </section>
    </div>

    <script>
        function clearAddress() {
            document.getElementById('address').value = '';
        }

        function confirmDelete() {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                window.location.href = 'deleteAcc.php';
            }
        }
        function confirmLogOut() {
            if (confirm('Are you sure you want to Log Out')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</body>
</html>

<?php 
} else {
    header("Location: loginindex.php");
    exit();
}
?>

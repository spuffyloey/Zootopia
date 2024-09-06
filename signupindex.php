<?php
// Start session to retrieve error messages
session_start();

// Retrieve error messages from session
$emailErr = isset($_SESSION['emailErr']) ? $_SESSION['emailErr'] : "";
$passwordErr = isset($_SESSION['passwordErr']) ? $_SESSION['passwordErr'] : "";
$phoneErr = isset($_SESSION['phoneErr']) ? $_SESSION['phoneErr'] : "";

// Clear error messages from session
unset($_SESSION['emailErr']);
unset($_SESSION['passwordErr']);
unset($_SESSION['phoneErr']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="Login-Style.css"> <!-- Reuse the same CSS file -->
    <title>ZOOTOPIA &CO - Sign Up</title>
</head>
<body>
    
    <header>
        <a href="index.php" class="Logo">Zootopia &Co</a>
    </header>

    <div class="login-container-wrapper">
        <section class="login-container">
            <h2>SIGN UP</h2>
            <?php if ($emailErr || $passwordErr || $phoneErr): ?>
                <div class="error-message">
                    <?php if ($emailErr) echo $emailErr . "<br>"; ?>
                    <?php if ($passwordErr) echo $passwordErr . "<br>"; ?>
                    <?php if ($phoneErr) echo $phoneErr; ?>
                </div>
            <?php endif; ?>
            <form id="signupForm" action="signup.php" method="POST">
                <div class="form-group">
                    <input type="text" id="email" name="email" placeholder="Email (xxx@xxx.com) " required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password (8 characters)" required>
                </div>
                <div class="form-group">
                    <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="text" id="phone" name="phone" placeholder="Contact No (xxx-xxxx-xxxx)" required>
                </div>
                <button type="submit" name="submit" class="login-btn">Sign Up</button>
            </form>
            <div class="links">
                <div class="sign-up">
                    <p>Already have an account? <a href="loginindex.php">Login</a></p>
                </div>
            </div>
        </section>
    </div>
    
</body>
</html>

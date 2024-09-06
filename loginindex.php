<?php
// Start session
session_start();

// Retrieve error messages from session
$emailErr = isset($_SESSION['emailErr']) ? $_SESSION['emailErr'] : "";
$passwordErr = isset($_SESSION['passwordErr']) ? $_SESSION['passwordErr'] : "";
$successMsg = isset($_GET['success']) && $_GET['success'] == 1 ? "Account successfully created. Please log in." : "";

// Clear error messages from session
unset($_SESSION['emailErr']);
unset($_SESSION['passwordErr']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="Login-Style.css"> <!-- Link to your login page CSS file -->
    <title>ZOOTOPIA &CO - Login</title>
</head>
<body>
    
    <header>
        <a href="index.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="index.php"> HOME </a>
        </nav>
    </header>

    <div class="login-container-wrapper">
        <section class="login-container">
            <h2>LOGIN</h2>
            <?php if ($successMsg): ?>
                <div class="success-message"><?php echo $successMsg; ?></div>
            <?php endif; ?>
            <?php if ($emailErr || $passwordErr): ?>
                <div class="error-message">
                    <?php if ($emailErr) echo $emailErr . "<br>"; ?>
                    <?php if ($passwordErr) echo $passwordErr; ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="POST"> <!-- Adjust action attribute as needed -->
                <div class="form-group">
                    <input type="text" id="email" name="email"  placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password"  required>
                </div>
                <button type="submit" name="submit" class="login-btn">Login</button>
            </form>
            <div class="links">
                <div class="sign-up">
                    <p>Don't have an account? <a href="signupindex.php">Sign up</a></p>
                </div>
            </div>
        </section>
    </div>

</body>
</html>

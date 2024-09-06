<?php
session_start();
if(isset($_SESSION['accountID'])){
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="Style-Main.css">
    <title>ZOOTOPIA &CO</title>
</head>
<body>
    
    <header>
        <a href="#" class="Logo">Zootopia &Co</a>
        <div class="dropdown">
            <button class="dropbtn">Menu</button>
            <div class="dropdown-content">
            <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
                <a href="visitordetails.php"><i class="fa fa-fw fa-user-circle"></i>  Visitor</a>
                <a href="ticketview.php"><i class="fa fa-fw fa-ticket"></i> Ticket</a>
                <a href="packageInfo.php"><i class="fa fa-fw fa-gift"></i> Package</a>
                <a href="#con"><i class="fa fa-fw fa-info-circle"></i> About us</a>
                <a onclick="confirmLogOut()"><i class="fa fa-fw fa-sign-out"></i> Log Out</a>
            </div>
        </div>
    </header>

    <section class="main">
        <div>
            <h2>Hi, Administrator</h2><br>
            <h2>WELCOME TO OUR ZOO, A PLACE OF NATURE!</h2>
            <h3>Discover and <br> get to know.</h3>
            <a href="ticketview.php" class="main-btn">ticket sold details</a>
            <a href="visitordetails.php" class="main-btn">visitor details</a>
            <a href="packageInfo.php" class="main-btn">package details</a>
        </div>
    </section>

    <section id="con">
    <h2 class="titleabout">ABOUT US</h2>
    <div class="aboutcontainer">
        <img src="img/zootopialogo.jpg" alt="zoologo" class="zoologo">
        <div class="aboutsection">
        <h1>ZOOTOPIA & CO</h1>
            <p>Zootopia & Co is a premier zoo located in the heart of Kuantan, Pahang, Malaysia.<br> 
            We are dedicated to the conservation of wildlife and offer an engaging experience<br>
            for visitors of all ages.</p>
            <div class="footer-container">
    <div class="footer-section contact-info">
        <h3>Contact Information</h3>
        <p>Jalan Teluk Sisek, Taman Teruntum , 25050<br>
           Kuantan, Pahang, Malaysia.</p>
        <p>Tel: +605 - 808 6577 | +605 - 804 1045<br>
           WhatsApp: +6019- 481 5351</p>
    </div>

        <div class="footer-section help-follow">
        <h3>Need help?</h3>
        <ul>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <h3>Follow Us</h3>
        <ul class="social-links">
            <li><a href="#"><i class="fa-brands fa-instagram"></i>  Instagram</a></li>
            <li><a href="#"><i class="fab fa-facebook-f"></i>  Facebook</a></li>
            <li><a href="#"><i class="fa-brands fa-twitter"></i> Twitter</a></li>
        </ul>
    </div>
</div>
</section>
    <script>
        
    function confirmLogOut() {
        if (confirm('Are you sure you want to Log Out')) {
            window.location.href = 'logout.php';
        }
    }
    </script>
</body>
</html>
<?php 
}
else{
	header("Location: loginindex.php");
}
?>
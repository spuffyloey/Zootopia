<?php
session_start();

if(isset($_SESSION['accountID'])){
	// store session in var
	$fname= $_SESSION['firstName'];
?>
<!DOCTYPE html>
<html lang="en">
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
                <a href="#animals"><i class="fa-solid fa-paw"></i> Our animal</a>
                <a href="ticketBuying.php"><i class="fa fa-fw fa-ticket"></i> Buy Ticket</a>
                <a href="bookingview.php"><i class="fa fa-fw fa-calendar"></i> Your Booking</a>
                <a href="profileindex.php"><i class="fa fa-fw fa-user"></i> profile</a>
                <a href="#con"><i class="fa fa-fw fa-info-circle"></i> About us</a>
                <a onclick="confirmLogOut()"><i class="fa fa-fw fa-sign-out"></i> Log Out</a>
            </div>
        </div>
    </header>


    <section class="main">
        <div>
            <h2>Hi, <?php echo $_SESSION['firstName']; ?></h2><br>
            <h2>WELCOME TO OUR ZOO, A PLACE OF NATURE!</h2>
            <h3>Discover and <br> get to know.</h3>
            <a href="#animals" class="main-btn">View our animals</a>
        </div>

    </section>

    <section class="cards" id="animals">
        <h2 class="title">Our Animals</h2>
        <div class="content">
            <div class="card">
                <div class="icon">
                    <img src="img/otter.jpg" alt="otter" style="width: 270px; height: 270px;">
                </div>
                <div class="info">
                    <h3>OTTER</h3>
                </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="icon">
                     <img src="img/panda1.jpg" alt="panda1" style="width: 270px; height: 270px;">
                </div>
                <div class="info">
                    <h3>PANDA</h3>
                </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="icon">
                    <img src="img/koala2.jpg" alt="koala2" style="width: 270px; height: 270px;">
                </div>
                <div class="info">
                    <h3>KOALA</h3>
                </div>
           
        </div>
        
    </section>
	<div class="center">
			<a href="animal.php" class="animal-btn">More Animals</a>
	</div>
	
    <section class="tickets" id="tickt">
         <h2 class="title2">Buy Ticket and Visit Our Animals</h2>
        <div class="content">
            <div class="card">
                <div class="info">
                    <h3>Child</h3>
                    <p>3 to 12 Years Old</p>
					<p>Price: RM 31.00</p>
                </div>
           
        </div>
        <div class="content">
            <div class="card">
                <div class="info">
                    <h3>Adult</h3>
                    <p>13 Years Old to 59 Years Old</p>
                    <p>Price: RM 38.00</p>
                </div>
           
        </div>
        <div class="content">
            <div class="card">
                <div class="info">
                    <h3>Senior</h3>
                    <p>60 Years Old and Above</p>
                    <p>Price: RM 31.00</p>
                </div>
           
        </div>

        </section>
	<div class="center">
			<a href="ticketBuying.php" class="ticket-btn">Buy Now</a>
	</div>

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
<?php 
}
else{
	header("Location: loginindex.php");
}
?>
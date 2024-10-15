<?php
session_start();
ob_start();

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"];
include 'db_con.php';

// Retrieve the downpayment and due date from session variables
$downpayment = $_SESSION['downpayment'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/confirm.css">
    <link rel="icon" type="image/x-icon" href="smartpress.png">
    <title>Order Confirmation | Smartpress</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- font styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/smartpress.png" type="image/x-icon">
</head>
<body>
    <!-- navigation bar -->
    <div class="navbar">
        <nav>
            <div class="nav-logo"><a href="../php/home.php"><img src="../images/smartpress.png" alt=""></a></div>
            <div class="printing-services"><a href="../php/orderform.php">Printing Services</a></div>
            <div class="community">
                <select id="community-dropdown" onchange="location = this.value">
                    <option value="" disabled selected>Community</option>
                    <option value="../php/About_Us.php">About Us</option>
                    <option value="../php/Contact_Us.php">Contact Us</option>
                    <option value="../php/FAQs.php">FAQs</option>
                </select>
            </div>
            <div class="profile"><a href="../php/profile-page.php"><i class="fa-regular fa-user"></i></a></div>        
        </nav>
    </div>
    <div class="container">
        <div class="form-container">
            <h1>Order Confirmed</h1>
            <p>Thank you for your order! Your order has been confirmed.</p>
            <p>Please wait <strong class="downpayment">1-2 business days</strong> for us to verify your payment and process your order.</p>
            <p>Please proceed to the <a href="../php/home.php">homepage</a>.</p>
        </div>
    </div>
    <!-- footer -->
    <div class="footer-container">
        <div class="socials">
            <div class="footer-logo">
                <img src="../images/smartpress.png" alt="">
            </div>
            <div class="social-media-links">
                <div class="fb">
                    <i class="fa-brands fa-facebook fa-2x"></i>
                </div>
                <div class="twitter">
                    <i class="fa-brands fa-square-twitter fa-2x"></i>
                </div>
                <div class="instagram">
                    <i class="fa-brands fa-square-instagram fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="footer-help">
            <h4 id="footer-help-title">Help</h4>
            <a href="../php/Contact_Us.php">Contact Us</a>
            <a href="../php/FAQs.php">FAQs</a>
        </div>
        <div class="footer-about">
            <h4 id="footer-about-title">About</h4>
            <a href="../php/About_Us.php">Our Story</a>
        </

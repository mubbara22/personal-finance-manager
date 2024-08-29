<?php
    include('db.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Personal Finance Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <header>
        <div class="logo">Finance Manager</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <button onclick="redirectTo('login.php')">Login</button>
            <button onclick="redirectTo('signup.php')">Sign Up</button>
        </div>
    </header>

    <main>
        <section class="about">
            <h2>About Us</h2>
            <p>We are dedicated to helping individuals manage their personal finances effectively. Our goal is to provide easy-to-use tools and resources that empower users to achieve their financial goals.</p>
            <p>Founded in 2019, Finance Manager has grown to become a trusted platform for budgeting, expense tracking, and financial planning.</p>
            <p>Join us on our journey to financial wellness!</p>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>

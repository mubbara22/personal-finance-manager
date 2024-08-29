<?php
    session_start();

    include("db.php");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $name = $_POST['name'];
        $gmail = $_POST['gmail'];
        $password = $_POST['password'];
        if(!empty($gmail) && !empty($password) && !is_numeric($gmail)){
            $query = "insert into form(name,gmail,password) values ('$name','$gmail','$password')";

            mysqli_query($con, $query);
            echo "<script type='text/javascript'> alert('Sucessfully Register')</script>";
        }
        else{
            echo "<script type='text/javascript'> alert('Please Enter some Valid Information')</script>";

        }

    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Personal Finance Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">Finance Manager</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </nav>
    
    </header>

    <main>
        <section class="signup-form">
            <h2>Sign Up</h2>
            <form method="POST">
                <label for="name">Name:</label>
                <div>
                <input type="text" id="name" name="name" required>
               </div>
                <label for="gmail">Email:</label>
                <div>
                <input type="gmail" id="gmail" name="gmail" required>
              </div>
                <label for="password">Password:</label>
                <div>
                <input type="password" id="password" name="password" required>
            </div>
                <button type="submit">Sign Up</button>
            </form>
            <p>By clicking the Sign Up button, you agree to our<br>
            <a href="terms.html">Terms and condition</a>and<a href="">Policy Privacy</a></p>
            <p>Already have an account?<a href="login.php">Login here</a></p>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>

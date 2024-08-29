<?php
    session_start();


    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $gmail = $_POST['gmail'];
        $password = $_POST['password'];
        if(!empty($gmail) && !empty($password) && !is_numeric($gmail))
        {
            $query ="select * from form where gmail ='$gmail' limit 1";
            $result = mysqli_query($con, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result)>0)
                {
                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['password'] == $password)
                    {
                        header("location: about.php");
                        die;
                    }
                }
            }
            echo "<script type='text/javascript'> alert('Wrong username or password')</script>";
        }
        else{
            echo "<script type='text/javascript'> alert('Wrong username or password')</script>";
        }
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Personal Finance Manager</title>
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
        <section class="login-form">
            <h2>Login</h2>
            <form method="POST" >
                <label for="gmail">Gmail:</label>
                <div>
                <input type="gmail" id="gmail" name="gmail" required>
            </div>   
                <label for="password">Password:</label>
                <div>
                <input type="password" id="password" name="password" required>
              </div>
                <button type="submit">Login</button>
            </form>
            <p>Not have an account?<a href="signup.php">Sign up here</a></p>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>

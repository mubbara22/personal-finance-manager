<?php       
    include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <header>
        <div class="background">
    <h1>
                <img src="Finance.webg.png" height="80" width="80">Personal Finance manager</h1>
              
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <button class="animated-button" onclick="redirectTo('login.php')">Login</button>
                <button  class="animated-button"onclick="redirectTo('signup.php')">Signup</button>
            </div>
        </div>
    </div>
   
    </header>

    <main>
        <section class="get-started">
            <h1>Manage Your Finances Effortlessly</h1>
            <p>Sign up now and take control of your finances. Track expenses, set budgets, and plan for the future.</p>
            <button class="animated-button get-started-button" onclick="redirectTo('signup.php')">Get Started for Free</button>
        </section>
    </main>
    
   

    <section class="features">
     
        <section class="actions">
            <button class="animated-button action-button" onclick="redirectTo('dashboard.html')">Dashboard</button>
            <button class="animated-button action-button" onclick="redirectTo('transaction.php')">Transactions</button>
            <button class="animated-button action-button" onclick="redirectTo('budget.php')">Budget</button>
            <button class="animated-button action-button" onclick="redirectTo('reports.php')">Reports</button>
        </section>
           
            <h2>Our Features</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <img src="budget-tracking.png" alt="Budget Tracking">
                    <h3>Budget Tracking</h3>
                    <p>Keep track of your spending and stay within your budget.</p>
                </div>
                <div class="feature-item">
                    <img src="expense-management.png" alt="Expense Management">
                    <h3>Expense Management</h3>
                    <p>Record and categorize your expenses effortlessly.</p>
                </div>
                <div class="feature-item">
                    <img src="financial-goals.png" alt="Financial Goals">
                    <h3>Financial Goals</h3>
                    <p>Set and achieve your financial goals with ease.</p>
                </div>
                <div class="feature-item">
                    <img src="reports-analytics.png" alt="Reports & Analytics">
                    <h3>Reports & Analytics</h3>
                    <p>Get detailed insights into your finances.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="testimonials">
        <div class="container">
            <h2>What Our Users Say</h2>
            <div class="testimonials-carousel">
                <div class="testimonial-item">
                    <p>"This app has completely changed how I manage my finances. Highly recommend!"</p>
                    <p>- Alex Johnson</p>
                </div>
                <div class="testimonial-item">
                    <p>"Easy to use and has helped me save so much money!"</p>
                    <p>- Sarah Williams</p>
                </div>
                <div class="testimonial-item">
                    <p>"A must-have tool for anyone looking to take control of their finances."</p>
                    <p>- Mark Smith</p>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Finance Manager. All rights reserved.</p>
            <ul>
                <li><a href="policy.html">Privacy Policy</a></li>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </footer>
    
    <script src="script.js"></script>
</body>
</html>

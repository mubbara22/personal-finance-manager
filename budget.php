<?php
session_start();
include("db.php");

// Fetch budgets
$budget = array();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, category, amount, spent_amount, (amount - spent_amount) AS remaining_amount FROM budget";
    $result = $con->query($sql);

    // Check if the query was successful
    if ($result === false) {
        echo "Error: " . $con->error;
        exit;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $budget[] = $row;
        }
    }
}

// Add a new budget
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO budget (category, amount, spent_amount) VALUES ('$category', '$amount', 0)";

    if ($con->query($sql) === TRUE) {
        header("Location: budget.php"); // Redirect to refresh the page and show the new budget
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget | Personal Finance Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">Finance Manager</div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="dashboard.html">Dashboard</a></li>
                    <li><a href="transaction.php">Transactions</a></li>
                    <li><a href="reports.php">Reports</a></li>
                </ul>
            </nav>
          
        </div>
    </header>
    
    <main>
        <section class="budget">
            <div class="container">
                <h2>Budget</h2>
                <div class="budget-controls">
                    <button onclick="showAddBudgetForm()">Add Budget</button>
                    <input type="text" id="search" placeholder="Search budget..." onkeyup="searchBudget()">
                </div>
                <div id="addBudgetForm" class="form-popup">
                    <form method ="POST" class="form-container">
                        <h2>Add Budget</h2>
                        <label for="category"><b>Category</b></label>
                        <input type="text" id="category" name="category" required>
                        <label for="amount"><b>Amount</b></label>
                        <input type="number" id="amount" name="amount" required>
                        <button type="button" class="btn" onclick="addBudget()">Add</button>
                        <button type="button" class="btn cancel" onclick="closeAddBudgetForm()">Close</button>
                    </form>
                </div>
                <table id="budgetTable">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Budgeted Amount</th>
                            <th>Spent Amount</th>
                            <th>Remaining Amount</th>
                        </tr>
                        </thead>
                    <tbody>
                        <?php foreach ($budget as $budget): ?>
                        <tr>
                           
                            <td><?php echo htmlspecialchars($budget['category']); ?></td>
                            <td><?php echo htmlspecialchars($budget['amount']); ?></td>
                            <td><?php echo htmlspecialchars($budget['spent_amount']); ?></td>
                            <td><?php echo htmlspecialchars($budget['remaining_amount']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Finance Manager. All rights reserved.</p>
            <ul>
                <li><a href="Privacy.html">Privacy Policy</a></li>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </footer>
    
    <script src="script.js"></script>
</body>
</html>

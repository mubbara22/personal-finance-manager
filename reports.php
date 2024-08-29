<?php
session_start();
include("db.php");

// Fetch budget report data
$budgetReport = array();
$transactionReport = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch budget report
    $sql = "SELECT category, amount, spent_amount, (amount - spent_amount) AS remaining_amount FROM budget";
    $result = $con->query($sql);

    if ($result === false) {
        echo "Error: " . $con->error;
        exit;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $budgetReport[] = $row;
        }
    }

    // Fetch transaction report
    $sql = "select description, amount,date from transaction ORDER by date DESC";
    $result = $con->query($sql);

    if ($result === false) {
        echo "Error: " . $con->error;
        exit;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $transactionReport[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | Personal Finance Manager</title>
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
                    <li><a href="budget.php">Budget</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        <section class="reports">
            <div class="container">
                <h2>Reports</h2>
                
                <!-- Budget Report Section -->
                <div class="report-section">
                    <h3>Budget Report</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Budgeted Amount</th>
                                <th>Spent Amount</th>
                                <th>Remaining Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($budgetReport as $budget): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($budget['category']); ?></td>
                                <td>$<?php echo number_format($budget['amount'], 2); ?></td>
                                <td>$<?php echo number_format($budget['spent_amount'], 2); ?></td>
                                <td>$<?php echo number_format($budget['remaining_amount'], 2); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Transaction Report Section -->
                <div class="report-section">
                    <h3>Transaction Report</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactionReport as $transaction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                                <td>$<?php echo number_format($transaction['amount'], 2); ?></td>
                                <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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

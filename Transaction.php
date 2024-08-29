<?php
session_start();

include("db.php"); // Ensure db.php establishes a connection in $con

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add a new transaction
    $date = $_POST['date'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    // Using prepared statements for security (to prevent SQL injection)
    $stmt = $con->prepare("Insert INTO transaction (date, category, description, amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $date, $category, $description, $amount);

    if ($stmt->execute() === TRUE) {
        echo "New transaction added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
    exit;
}

// Fetch all transactions
$query = "Select * FROM transaction ORDER BY date DESC";
$result = mysqli_query($con, $query);

$transactions = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}

if (isset($con) && $con) {
    $con->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions | Personal Finance Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <div class="container">
    <div class="logo">Finance Manager</div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
</div>
    </header>
    
    <main>
        <section class="transactions">
            <div class="container">
                <h2>Transactions</h2>
                <div class="transaction-controls">
                    <button onclick="showAddTransactionForm()">Add Transaction</button>
                    <input type="text" id="search" placeholder="Search transactions..." onkeyup="searchTransactions()">
                </div>
                <div id="addTransactionForm" class="form-popup">
                    <form action="transaction.php" method="POST" class="form-container">
                        <h2>Add Transaction</h2>
                        <label for="date"><b>Date</b></label>
                        <input type="date" id="date" name="date" required>
                        <label for="category"><b>Category</b></label>
                        <input type="text" id="category" name="category" required>
                        <label for="description"><b>Description</b></label>
                        <input type="text" id="description" name="description" required>
                        <label for="amount"><b>Amount</b></label>
                        <input type="number" id="amount" name="amount" required>
                        <button type="submit" class="btn">Add</button>
                        <button type="button" class="btn cancel" onclick="closeAddTransactionForm()">Close</button>
                    </form>
                </div>
                <table id="transactionsTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Amount</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['category']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['amount']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>

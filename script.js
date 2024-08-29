// Redirect to a specific page
function redirectTo(page) {
    window.location.href = page;
}

// Toggle profile dropdown menu
function toggleDropdown() {
    document.getElementById("dropdownMenu").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.addEventListener('click', function(event) {
    if (!event.target.matches('.profile-dropdown button')) {
        document.querySelectorAll(".dropdown-content.show").forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});

// Render budget chart using Chart.js
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('budgetChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Housing', 'Food', 'Transportation', 'Entertainment', 'Others'],
            datasets: [{
                label: 'Budget',
                data: [40, 20, 15, 10, 15],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});

// Show and hide transaction form
function showAddTransactionForm() {
    document.getElementById("addTransactionForm").style.display = "block";
}

function closeAddTransactionForm() {
    document.getElementById("addTransactionForm").style.display = "none";
}

// Search transactions
function searchTransactions() {
    const input = document.getElementById('search').value.toLowerCase();
    document.querySelectorAll('#transactionsTable tbody tr').forEach(row => {
        const cells = Array.from(row.getElementsByTagName('td'));
        const match = cells.some(cell => cell.innerHTML.toLowerCase().includes(input));
        row.style.display = match ? '' : 'none';
    });
}

// Fetch and display budgets
function fetchBudgets() {
    fetch('budget.php')
        .then(response => response.json())
        .then(data => {
            const budgetTable = document.querySelector("#budgetTable tbody");
            budgetTable.innerHTML = data.map(budget => `
                <tr>
                    <td>${budget.category}</td>
                    <td>$${budget.amount}</td>
                    <td>$${budget.spent_amount}</td>
                    <td>$${budget.remaining_amount}</td>
                </tr>
            `).join('');
        });
}

// Add a new budget
function addBudget() {
    const category = document.querySelector("#category").value;
    const amount = document.querySelector("#amount").value;

    fetch('budget.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            category: category,
            amount: amount
        })
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        fetchBudgets();
        closeAddBudgetForm();
    });
}

// Show and hide budget form
function showAddBudgetForm() {
    document.getElementById("addBudgetForm").style.display = "block";
}

function closeAddBudgetForm() {
    document.getElementById("addBudgetForm").style.display = "none";
}

// Generate report based on selected report type
function generateReport() {
    const reportType = document.getElementById("reportType").value;
    const reportContent = document.getElementById("reportContent");

    switch (reportType) {
        case "summary":
            reportContent.innerHTML = generateSummaryReport();
            break;
        case "incomeVsExpense":
            reportContent.innerHTML = generateIncomeVsExpenseReport();
            break;
        case "categoryWise":
            reportContent.innerHTML = generateCategoryWiseReport();
            break;
        default:
            reportContent.innerHTML = "";
    }
}

function generateSummaryReport() {
    return `
        <h3>Summary Report</h3>
        <p>Total Income: $3000.00</p>
        <p>Total Expenses: $1500.00</p>
        <p>Savings: $1500.00</p>
    `;
}

function generateIncomeVsExpenseReport() {
    return `
        <h3>Income vs Expense Report</h3>
        <p>Income: $3000.00</p>
        <p>Expenses: $1500.00</p>
        <div class="chart">
            <canvas id="incomeVsExpenseChart"></canvas>
        </div>
    `;
}

function generateCategoryWiseReport() {
    return `
        <h3>Category-wise Report</h3>
        <p>Groceries: $500.00</p>
        <p>Entertainment: $200.00</p>
        <p>Utilities: $300.00</p>
        <div class="chart">
            <canvas id="categoryWiseChart"></canvas>
        </div>
    `;
}

// Validate contact form
function validateForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    let errorMessage = '';

    if (!name) errorMessage += 'Name is required.<br>';
    if (!email) {
        errorMessage += 'Email is required.<br>';
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errorMessage += 'Invalid email format.<br>';
    }
    if (!message) errorMessage += 'Message is required.<br>';

    if (errorMessage) {
        document.getElementById('error-message').innerHTML = errorMessage;
        return false;
    }

    console.log('Submitting form:', { name, email, message });
    document.getElementById('contactForm').reset();
    alert('Form submitted successfully!');
    return false; // Prevent form submission
}

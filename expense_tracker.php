<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get logged-in user's ID
$user_id = $_SESSION['user_id'];
// Database Connection
$conn = new mysqli('localhost', 'root', '', 'ezfinance');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for charts
$categoryData = [];
$sql = "SELECT expense_category, SUM(expense_amount) AS total FROM expenses WHERE user_id = ? GROUP BY expense_category";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $categoryData[$row['expense_category']] = $row['total'];
}

$stmt->close();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EZfinance: Expense Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
         .chart-container {
        max-width: 350px;
        margin: 20px auto;
    }
    canvas {
        width: 100% !important;
        height: 200px !important;
    }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .calculator-container {
            background-color: #1B263B;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: white;
        }
        .calculator-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .calculator-input, select, textarea {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #415A77;
            background-color: #0D1B2A;
            color: white;
            width: 100%;
        }
        .calculator-button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background-color: #415A77;
            color: white;
            cursor: pointer;
        }
        table {
            width: 100%;
            margin-top: 20px;
            color: white;
        }
        table, th, td {
            border: 1px solid #415A77;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.html">
            <b class="EZ">EZ</b><i>f</i>inance
        </a>
    </nav>

    <div class="container">
        <div class="calculator-container">
            <div class="calculator-header">
                <h2><b class="EZ">EZ</b><i>f</i>inance Expense Tracker</h2>
                <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! Track your daily expenses easily.</p>
            </div>
            <form id="expense-form" action="save_expense.php" method="POST">
                <input type="text" name="expense_name" class="calculator-input" placeholder="Expense Name" required>
                <input type="number" name="expense_amount" class="calculator-input" placeholder="Amount (₹)" required>
                <input type="date" name="expense_date" class="calculator-input" required>
                <select name="expense_category" class="calculator-input" required>
                    <option value="">Select Category</option>
                    <option>Food</option>
                    <option>Transport</option>
                    <option>Shopping</option>
                    <option>Health</option>
                    <option>Other</option>
                </select>
                <textarea name="expense_note" class="calculator-input" placeholder="Notes (Optional)"></textarea>
                <button type="submit" class="calculator-button">Add Expense</button>
            </form>

            <h3>Your Expenses</h3>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Category</th>
            <th>Amount (₹)</th>
            <th>Note</th>
            <th>Action</th> <!-- New column for delete button -->
        </tr>
    </thead>
    <tbody id="expense-list">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'ezfinance');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $user_id = $_SESSION['user_id'];  // Ensure user is logged in
        $sql = "SELECT * FROM expenses WHERE user_id = ? ORDER BY expense_date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $total_expense = 0;  // Initialize total expense

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $total_expense += $row['expense_amount'];  // Add to total expense
                echo "<tr>
                        <td>" . $row['expense_date'] . "</td>
                        <td>" . $row['expense_name'] . "</td>
                        <td>" . $row['expense_category'] . "</td>
                        <td>₹" . $row['expense_amount'] . "</td>
                        <td>" . $row['expense_note'] . "</td>
                        <td><a href='delete_expense.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No expenses added yet.</td></tr>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </tbody>
</table>

<!-- Display Total Expense -->
<h4 class="text-center mt-3">Total Expense: ₹<?php echo number_format($total_expense, 2); ?></h4>

        </div><br><br><br>
    </div><br>
    
    
    <!-- Expense Summary Graphs -->
    <center><h3>Expense Summary</h3></center>
            <div class="chart-container">
                <canvas id="expenseBarChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="expensePieChart"></canvas>
            </div>
        </div>

        
    </div>
    <br><br>
    
    <br><br>


    <footer>
        <p>&copy; 2025 EZfinance. All Rights Reserved. | <a href="feedback.html">Give Feedback</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const expenseData = <?php echo json_encode($categoryData); ?>;
        const labels = Object.keys(expenseData);
        const amounts = Object.values(expenseData);

        const ctxBar = document.getElementById('expenseBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Expenses (₹)',
                    data: amounts,
                    backgroundColor: ['#4CAF50', '#FFC107', '#2196F3', '#FF5722', '#9C27B0']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        const ctxPie = document.getElementById('expensePieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: amounts,
                    backgroundColor: ['#4CAF50', '#FFC107', '#2196F3', '#FF5722', '#9C27B0']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
    <script src="toast.js"></script>

</body>
</html>

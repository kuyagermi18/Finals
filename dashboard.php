<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

/* ================= COUNTS ================= */
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM employees");
$totalRow = mysqli_fetch_assoc($totalQuery);
$totalEmployees = $totalRow['total'];

$activeQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM employees WHERE employee_status='Active'");
$activeRow = mysqli_fetch_assoc($activeQuery);
$activeEmployees = $activeRow['total'];

$inactiveQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM employees WHERE employee_status='Inactive'");
$inactiveRow = mysqli_fetch_assoc($inactiveQuery);
$inactiveEmployees = $inactiveRow['total'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | HR Employee Record System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>

    <div class="logo">
        <h2>HR Employee Record System</h2>
    </div>

    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="employees.php">Employees</a></li>
            <li><a href="add_employee.php">Add Employee</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

</header>

<section class="hero">

    <div class="overlay">

        <h1>Welcome, <?php echo $_SESSION['fullname']; ?></h1>

        <p><?php echo $_SESSION['role']; ?></p>

    </div>

</section>

<main>

    <!-- CARDS -->
    <section class="cards">

        <div class="card">
            <h2>Total Employees</h2>
            <h1><?php echo $totalEmployees; ?></h1>
        </div>

        <div class="card">
            <h2>Active Employees</h2>
            <h1><?php echo $activeEmployees; ?></h1>
        </div>

        <div class="card">
            <h2>Inactive Employees</h2>
            <h1><?php echo $inactiveEmployees; ?></h1>
        </div>

    </section>

    <!-- GRAPH -->
    <section class="graph-section">

        <h2>Employee Statistics</h2>

        <div class="graph-placeholder">
            <p>Employee Analytics Graph (future chart here)</p>
        </div>

    </section>

    <!-- INFO -->
    <section class="graph-section">

        <h2>System Overview</h2>

        <p>
            Welcome to the HR Employee Record System.
            This dashboard provides real-time employee tracking,
            including active and inactive workforce monitoring.
        </p>

    </section>

</main>

<footer>

    <p>
        © 2026 HR Employee Record System |
        Developed by Germi James Nacu,
        Archi Clemenz Lantan,
        Anthony Gabrielle Hermoso,
        Albert Andrei Reyes,
        Clark Jacob Llamoso
    </p>

</footer>

</body>

</html>
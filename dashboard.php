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

<!-- ===== HEADER ===== -->
<header>
    <div class="logo">
        <!-- Replace 'images/logo.png' with your actual logo once available -->
        <!-- <img src="images/logo.png" alt="Company Logo"> -->
        <h2>HR Employee Record System</h2>
    </div>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="employees.php">Employees</a>
        <a href="inactive_employees.php">Inactive Employees</a>
        <a href="departments.php">Departments</a>
        <a href="reports.php">Reports</a>
    </nav>

    <div>
        Welcome, <b><?php echo $_SESSION['username']; ?></b> |
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</header>

<!-- ===== HERO ===== -->
<section class="hero">
    <div class="overlay">
        <h1>Welcome, <?php echo $_SESSION['fullname'] ?? $_SESSION['username']; ?></h1>
        <p><?php echo $_SESSION['role'] ?? 'HR Administrator'; ?></p>
    </div>
</section>

<main>

    <!-- ===== STAT CARDS ===== -->
    <section class="cards">

        <div class="card">
            <div class="card-icon">&#128101;</div>
            <h2>Total Employees</h2>
            <h1><?php echo $totalEmployees; ?></h1>
        </div>

        <div class="card">
            <div class="card-icon">&#9989;</div>
            <h2>Active Employees</h2>
            <h1><?php echo $activeEmployees; ?></h1>
        </div>

        <div class="card">
            <div class="card-icon">&#10060;</div>
            <h2>Inactive Employees</h2>
            <h1><?php echo $inactiveEmployees; ?></h1>
        </div>

    </section>

    <!-- ===== TWO COLUMN SECTION ===== -->
    <div class="dashboard-row">

        <!-- ANNOUNCEMENTS -->
        <section class="dashboard-box">
            <h2>&#128226; Announcements</h2>
            <ul class="announcement-list">
                <li>
                    <span class="badge">New</span>
                    <div>
                        <p class="ann-title">Performance Review Season</p>
                        <p class="ann-date">June 30, 2026</p>
                        <p class="ann-desc">Annual performance reviews will begin next week. Please prepare your self-evaluation forms.</p>
                    </div>
                </li>
                <li>
                    <span class="badge">Reminder</span>
                    <div>
                        <p class="ann-title">Payroll Cutoff</p>
                        <p class="ann-date">June 25, 2026</p>
                        <p class="ann-desc">Payroll cutoff is on June 25. Please submit DTR and overtime reports before the deadline.</p>
                    </div>
                </li>
                <li>
                    <span class="badge">Info</span>
                    <div>
                        <p class="ann-title">New HR Policy Update</p>
                        <p class="ann-date">June 20, 2026</p>
                        <p class="ann-desc">Updated leave policies are now in effect. Check the HR handbook for details.</p>
                    </div>
                </li>
            </ul>
        </section>

        <!-- UPCOMING EVENTS -->
        <section class="dashboard-box">
            <h2>&#128197; Upcoming Events</h2>
            <ul class="event-list">
                <li>
                    <div class="event-date">
                        <span class="event-month">JUL</span>
                        <span class="event-day">4</span>
                    </div>
                    <div class="event-info">
                        <p class="event-title">Team Building Activity</p>
                        <p class="event-loc">&#128205; Company Grounds</p>
                    </div>
                </li>
                <li>
                    <div class="event-date">
                        <span class="event-month">JUL</span>
                        <span class="event-day">10</span>
                    </div>
                    <div class="event-info">
                        <p class="event-title">HR Orientation for New Hires</p>
                        <p class="event-loc">&#128205; Conference Room A</p>
                    </div>
                </li>
                <li>
                    <div class="event-date">
                        <span class="event-month">JUL</span>
                        <span class="event-day">15</span>
                    </div>
                    <div class="event-info">
                        <p class="event-title">Safety Training Seminar</p>
                        <p class="event-loc">&#128205; Training Hall</p>
                    </div>
                </li>
                <li>
                    <div class="event-date">
                        <span class="event-month">AUG</span>
                        <span class="event-day">1</span>
                    </div>
                    <div class="event-info">
                        <p class="event-title">Mid-Year Assessment</p>
                        <p class="event-loc">&#128205; HR Office</p>
                    </div>
                </li>
            </ul>
        </section>

    </div>

    <!-- ===== QUICK LINKS ===== -->
    <section class="graph-section">
        <h2>&#9889; Quick Links</h2>
        <div class="quick-links">
            <a href="employees.php" class="quick-link">
                <div class="ql-icon">&#128101;</div>
                <p>Employees</p>
            </a>
            <a href="inactive_employees.php" class="quick-link">
                <div class="ql-icon">&#128683;</div>
                <p>Inactive Employees</p>
            </a>
            <a href="departments.php" class="quick-link">
                <div class="ql-icon">&#127970;</div>
                <p>Departments</p>
            </a>
            <a href="reports.php" class="quick-link">
                <div class="ql-icon">&#128202;</div>
                <p>Reports</p>
            </a>
        </div>
    </section>

    <!-- ===== REPORTS SUMMARY ===== -->
    <section class="graph-section">
        <h2>&#128202; Reports Summary</h2>
        <div class="report-grid">
            <div class="report-item">
                <p class="report-label">Total Headcount</p>
                <p class="report-value"><?php echo $totalEmployees; ?></p>
            </div>
            <div class="report-item">
                <p class="report-label">Active Rate</p>
                <p class="report-value">
                    <?php echo $totalEmployees > 0 ? round(($activeEmployees / $totalEmployees) * 100) : 0; ?>%
                </p>
            </div>
            <div class="report-item">
                <p class="report-label">Inactive Rate</p>
                <p class="report-value">
                    <?php echo $totalEmployees > 0 ? round(($inactiveEmployees / $totalEmployees) * 100) : 0; ?>%
                </p>
            </div>
            <div class="report-item">
                <p class="report-label">System Status</p>
                <p class="report-value" style="color:#2E8B57;">Online</p>
            </div>
        </div>
    </section>

</main>

<!-- ===== FOOTER ===== -->
<footer>
    <p>
        &copy; <?php echo date('Y'); ?> HR Employee Record System |
        Developed by Germi James Nacu,
        Archi Clemenz Lantan,
        Anthony Gabrielle Hermoso,
        Albert Andrei Reyes,
        Clark Jacob Llamoso
    </p>
</footer>

</body>
</html>
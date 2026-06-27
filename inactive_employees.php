<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inactive Employees</title>

<link rel="stylesheet" href="css/inactive_employees.css">

<style>

</style>

</head>

<body>

<header>
    <h2>HR Employee Record System</h2>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="employees.php">Employees</a>
        <a href="inactive_employees.php">Inactive Employees</a>
        <a href="departments.php">Departments</a>
        <a href="reports.php">Reports</a>
    </nav>
</header>

<div class="banner">
    <h1>Inactive Employees</h1>
    <p>List of employees marked as inactive</p>
</div>

<div class="container">

<table>

<thead>
<tr>
    <th>No</th>
    <th>Name</th>
    <th>Department</th>
    <th>Position</th>
    <th>Level</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

<?php
$sql = "SELECT * FROM employees WHERE employee_status='Inactive'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
?>

<tr>

<td><?php echo $row['employee_number']; ?></td>

<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>

<td><?php echo $row['department']; ?></td>
<td><?php echo $row['position']; ?></td>
<td><?php echo $row['employee_level']; ?></td>
<td><?php echo $row['employee_status']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> HR System</p>
</footer>

</body>
</html>
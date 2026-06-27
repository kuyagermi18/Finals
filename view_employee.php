<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "No employee selected.";
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM employees WHERE employee_id = $id";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
    echo "Employee not found.";
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="css/employees.css">
</head>

<body>

<header>

    <div class="logo">
        <h2>HR Employee Record System</h2>
    </div>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="employees.php">Employees</a>
        <a href="logout.php">Logout</a>
    </nav>

</header>

<div class="container">

    <h1>Employee Details</h1>

    <div class="profile-card">

        <p><b>Employee Number:</b> <?php echo $row['employee_number']; ?></p>
        <p><b>Name:</b> <?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']; ?></p>
        <p><b>Gender:</b> <?php echo $row['gender']; ?></p>
        <p><b>Birth Date:</b> <?php echo $row['birth_date']; ?></p>
        <p><b>Email:</b> <?php echo $row['email']; ?></p>
        <p><b>Contact:</b> <?php echo $row['contact_number']; ?></p>
        <p><b>Address:</b> <?php echo $row['address']; ?></p>
        <p><b>Civil Status:</b> <?php echo $row['civil_status']; ?></p>
        <p><b>Emergency Contact:</b> <?php echo $row['emergency_contact']; ?></p>
        <p><b>Department:</b> <?php echo $row['department']; ?></p>
        <p><b>Position:</b> <?php echo $row['position']; ?></p>
        <p><b>Employee Level:</b> <?php echo $row['employee_level']; ?></p>
        <p><b>Hire Date:</b> <?php echo $row['hire_date']; ?></p>
        <p><b>Status:</b> <?php echo $row['employee_status']; ?></p>
        <p><b>Remarks:</b> <?php echo $row['remarks']; ?></p>

    </div>

    <br>

    <a href="employees.php">← Back</a>

</div>

</body>
</html>
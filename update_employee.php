<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $employee_id     = $_POST['employee_id'];
    $employee_number = $_POST['employee_number'];
    $first_name      = $_POST['first_name'];
    $middle_name     = $_POST['middle_name'];
    $last_name       = $_POST['last_name'];
    $gender          = $_POST['gender'];
    $birth_date      = $_POST['birth_date'];
    $email           = $_POST['email'];
    $contact_number  = $_POST['contact_number'];
    $address         = $_POST['address'];
    $department      = $_POST['department'];
    $position        = $_POST['position'];
    $employee_level  = $_POST['employee_level'];
    $employee_status = $_POST['employee_status'];

    $sql = "UPDATE employees SET employee_number='$employee_number', first_name='$first_name', middle_name='$middle_name', last_name='$last_name', gender='$gender', birth_date='$birth_date', email='$email', contact_number='$contact_number', address='$address', department='$department', position='$position', employee_level='$employee_level', employee_status='$employee_status' WHERE employee_id='$employee_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: employees.php?msg=updated");
    } else {
        header("Location: employees.php?msg=error");
    }

    exit();
}
?>
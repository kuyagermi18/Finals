<?php

include("db_connect.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $employee_number  = $_POST['employee_number'];
    $first_name       = $_POST['first_name'];
    $middle_name      = $_POST['middle_name'];
    $last_name        = $_POST['last_name'];
    $gender           = $_POST['gender'];
    $birth_date       = $_POST['birth_date'];
    $email            = $_POST['email'];
    $contact_number   = $_POST['contact_number'];
    $department       = $_POST['department'];
    $position         = $_POST['position'];
    $employee_level   = $_POST['employee_level'];
    $employee_status  = $_POST['employee_status'];
    $address          = $_POST['address'];

    $sql = "INSERT INTO employees
    (
        employee_number,
        first_name,
        middle_name,
        last_name,
        gender,
        birth_date,
        email,
        contact_number,
        department,
        position,
        employee_level,
        employee_status,
        address
    )
    VALUES
    (
        '$employee_number',
        '$first_name',
        '$middle_name',
        '$last_name',
        '$gender',
        '$birth_date',
        '$email',
        '$contact_number',
        '$department',
        '$position',
        '$employee_level',
        '$employee_status',
        '$address'
    )";

    if(mysqli_query($conn, $sql))
    {
        if($employee_status == 'Inactive')
        {
            echo "<script>
                    alert('Employee added successfully!');
                    window.location='inactive_employees.php';
                  </script>";
        }
        else
        {
            echo "<script>
                    alert('Employee added successfully!');
                    window.location='employees.php';
                  </script>";
        }
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
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
<title>Employees</title>
<link rel="stylesheet" href="css/employees.css">
</head>

<body>

<!-- ===== HEADER ===== -->
<header>
    <div class="logo">
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
        <a href="logout.php" style="color:red; text-decoration:none; font-weight:bold;">Logout</a>
    </div>
</header>

<!-- ===== BANNER ===== -->
<div class="banner">
    <h1>Employee Management</h1>
    <p>Manage your company's employee records</p>
</div>

<div class="container">

<!-- TOP BAR -->
<div class="top-bar">

    <div class="search-area">
        <input type="text" placeholder="Search Employee">
        <button>Search</button>
    </div>

    <button id="openAdd">Add</button>

</div>

<!-- TABLE -->
<table>
<thead>
<tr>
    <th>No</th>
    <th>Name</th>
    <th>Dept</th>
    <th>Position</th>
    <th>Level</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

<?php
$sql = "SELECT * FROM employees";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
?>

<tr>

<td><?php echo $row['employee_number']; ?></td>

<td>
<a class="emp-link"
   href="javascript:void(0)"
   onclick="openView(this)"

   data-id="<?php echo $row['employee_id']; ?>"
   data-number="<?php echo $row['employee_number']; ?>"
   data-fname="<?php echo htmlspecialchars($row['first_name']); ?>"
   data-mname="<?php echo htmlspecialchars($row['middle_name']); ?>"
   data-lname="<?php echo htmlspecialchars($row['last_name']); ?>"
   data-name="<?php echo htmlspecialchars($row['first_name'].' '.$row['middle_name'].' '.$row['last_name']); ?>"
   data-gender="<?php echo $row['gender']; ?>"
   data-birth="<?php echo $row['birth_date']; ?>"
   data-email="<?php echo htmlspecialchars($row['email']); ?>"
   data-contact="<?php echo $row['contact_number']; ?>"
   data-address="<?php echo htmlspecialchars($row['address']); ?>"
   data-dept="<?php echo htmlspecialchars($row['department']); ?>"
   data-pos="<?php echo htmlspecialchars($row['position']); ?>"
   data-level="<?php echo $row['employee_level']; ?>"
   data-status="<?php echo $row['employee_status']; ?>">

   <?php echo htmlspecialchars($row['first_name']." ".$row['last_name']); ?>

</a>
</td>

<td><?php echo $row['department']; ?></td>
<td><?php echo $row['position']; ?></td>
<td><?php echo $row['employee_level']; ?></td>
<td><?php echo $row['employee_status']; ?></td>

</tr>

<?php } ?>

</tbody>
</table>

</div>

<!-- ================= VIEW MODAL ================= -->
<div id="viewModal" class="modal">
<div class="modal-content">

<h2>Employee Details</h2>

<p><b>No:</b> <span id="v_number"></span></p>
<p><b>Name:</b> <span id="v_name"></span></p>
<p><b>Gender:</b> <span id="v_gender"></span></p>
<p><b>Birth:</b> <span id="v_birth"></span></p>
<p><b>Email:</b> <span id="v_email"></span></p>
<p><b>Contact:</b> <span id="v_contact"></span></p>
<p><b>Address:</b> <span id="v_address"></span></p>
<p><b>Department:</b> <span id="v_dept"></span></p>
<p><b>Position:</b> <span id="v_pos"></span></p>
<p><b>Level:</b> <span id="v_level"></span></p>
<p><b>Status:</b> <span id="v_status"></span></p>

<button onclick="switchToUpdate()">Update</button>
<button onclick="closeView()">Close</button>

</div>
</div>

<!-- ================= ADD MODAL ================= -->
<div id="addModal" class="modal">
<div class="modal-content">

<h2>Add Employee</h2>

<form action="save_employee.php" method="POST">

<label>Employee No</label><br>
<input type="text" name="employee_number"><br><br>

<label>First Name</label><br>
<input type="text" name="first_name"><br><br>

<label>Middle Name</label><br>
<input type="text" name="middle_name"><br><br>

<label>Last Name</label><br>
<input type="text" name="last_name"><br><br>

<label>Gender</label><br>
<select name="gender">
<option>Male</option>
<option>Female</option>
</select><br><br>

<label>Birth Date</label><br>
<input type="date" name="birth_date"><br><br>

<label>Email</label><br>
<input type="email" name="email"><br><br>

<label>Contact Number</label><br>
<input type="text" name="contact_number"><br><br>

<label>Address</label><br>
<input type="text" name="address"><br><br>

<label>Department</label><br>
<input type="text" name="department"><br><br>

<label>Position</label><br>
<input type="text" name="position"><br><br>

<label>Employee Level</label><br>
<input type="text" name="employee_level"><br><br>

<label>Status</label><br>
<select name="employee_status">
<option>Active</option>
<option>Inactive</option>
</select><br><br>

<button type="submit">Save</button>
<button type="button" onclick="closeAdd()">Cancel</button>

</form>

</div>
</div>

<!-- ================= UPDATE MODAL ================= -->
<div id="updateModal" class="modal">
<div class="modal-content">

<h2>Update Employee</h2>

<form action="update_employee.php" method="POST">

<input type="hidden" id="u_id" name="employee_id">

<label>Employee No</label><br>
<input type="text" id="u_number" name="employee_number"><br><br>

<label>First Name</label><br>
<input type="text" id="u_fname" name="first_name"><br><br>

<label>Middle Name</label><br>
<input type="text" id="u_mname" name="middle_name"><br><br>

<label>Last Name</label><br>
<input type="text" id="u_lname" name="last_name"><br><br>

<label>Gender</label><br>
<select id="u_gender" name="gender">
<option>Male</option>
<option>Female</option>
</select><br><br>

<label>Birth Date</label><br>
<input type="date" id="u_birth" name="birth_date"><br><br>

<label>Email</label><br>
<input type="email" id="u_email" name="email"><br><br>

<label>Contact Number</label><br>
<input type="text" id="u_contact" name="contact_number"><br><br>

<label>Address</label><br>
<input type="text" id="u_address" name="address"><br><br>

<label>Department</label><br>
<input type="text" id="u_dept" name="department"><br><br>

<label>Position</label><br>
<input type="text" id="u_pos" name="position"><br><br>

<label>Employee Level</label><br>
<input type="text" id="u_level" name="employee_level"><br><br>

<label>Status</label><br>
<select id="u_status" name="employee_status">
<option>Active</option>
<option>Inactive</option>
</select><br><br>

<button type="submit">Update</button>
<button type="button" onclick="closeUpdate()">Cancel</button>

</form>

</div>
</div>

<!-- ===== FOOTER ===== -->
<footer>
    <p>&copy; <?php echo date('Y'); ?> HR Employee Record System. All rights reserved.</p>
</footer>

<script>

let currentEmpData = {};

function openView(el){
    document.getElementById("viewModal").style.display = "block";

    document.getElementById("v_number").innerText = el.dataset.number;
    document.getElementById("v_name").innerText = el.dataset.name;
    document.getElementById("v_gender").innerText = el.dataset.gender;
    document.getElementById("v_birth").innerText = el.dataset.birth;
    document.getElementById("v_email").innerText = el.dataset.email;
    document.getElementById("v_contact").innerText = el.dataset.contact;
    document.getElementById("v_address").innerText = el.dataset.address;
    document.getElementById("v_dept").innerText = el.dataset.dept;
    document.getElementById("v_pos").innerText = el.dataset.pos;
    document.getElementById("v_level").innerText = el.dataset.level;
    document.getElementById("v_status").innerText = el.dataset.status;

    currentEmpData = el.dataset;
}

function closeView(){
    document.getElementById("viewModal").style.display = "none";
}

function switchToUpdate(){
    closeView();

    document.getElementById("updateModal").style.display = "block";

    document.getElementById("u_id").value       = currentEmpData.id;
    document.getElementById("u_number").value   = currentEmpData.number;
    document.getElementById("u_fname").value    = currentEmpData.fname;
    document.getElementById("u_mname").value    = currentEmpData.mname;
    document.getElementById("u_lname").value    = currentEmpData.lname;
    document.getElementById("u_gender").value   = currentEmpData.gender;
    document.getElementById("u_birth").value    = currentEmpData.birth;
    document.getElementById("u_email").value    = currentEmpData.email;
    document.getElementById("u_contact").value  = currentEmpData.contact;
    document.getElementById("u_address").value  = currentEmpData.address;
    document.getElementById("u_dept").value     = currentEmpData.dept;
    document.getElementById("u_pos").value      = currentEmpData.pos;
    document.getElementById("u_level").value    = currentEmpData.level;
    document.getElementById("u_status").value   = currentEmpData.status;
}

document.getElementById("openAdd").onclick = function(){
    document.getElementById("addModal").style.display = "block";
}

function closeAdd(){
    document.getElementById("addModal").style.display = "none";
}

function closeUpdate(){
    document.getElementById("updateModal").style.display = "none";
}

window.onclick = function(event){
    if(event.target.classList.contains("modal")){
        event.target.style.display = "none";
    }
}

</script>

</body>
</html>
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
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</header>

<!-- ===== BANNER ===== -->
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

<td>
<a class="emp-link"
   href="javascript:void(0)"
   onclick="openView(this)"
   data-number="<?php echo $row['employee_number']; ?>"
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

<!-- ===== VIEW MODAL ===== -->
<div id="viewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; overflow:auto;">
<div style="background:#fff; width:500px; margin:60px auto; padding:30px; border-radius:10px; box-shadow:0 0 20px rgba(0,0,0,.3); max-height:85vh; overflow-y:auto;">
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
<br>
<button class="btn-close" onclick="closeView()">Close</button>
</div>
</div>

<!-- ===== FOOTER ===== -->
<footer>
    <p>&copy; <?php echo date('Y'); ?> HR Employee Record System. All rights reserved.</p>
</footer>

<script>
function openView(el){
    document.getElementById("viewModal").style.display = "block";
    document.getElementById("v_number").innerText  = el.dataset.number;
    document.getElementById("v_name").innerText    = el.dataset.name;
    document.getElementById("v_gender").innerText  = el.dataset.gender;
    document.getElementById("v_birth").innerText   = el.dataset.birth;
    document.getElementById("v_email").innerText   = el.dataset.email;
    document.getElementById("v_contact").innerText = el.dataset.contact;
    document.getElementById("v_address").innerText = el.dataset.address;
    document.getElementById("v_dept").innerText    = el.dataset.dept;
    document.getElementById("v_pos").innerText     = el.dataset.pos;
    document.getElementById("v_level").innerText   = el.dataset.level;
    document.getElementById("v_status").innerText  = el.dataset.status;
}

function closeView(){
    document.getElementById("viewModal").style.display = "none";
}

window.onclick = function(event){
    if(event.target.classList.contains("modal")){
        event.target.style.display = "none";
    }
}
</script>

</body>
</html>
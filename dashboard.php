<?php
include 'session.php';
include 'db.php';

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">

<div class="card shadow p-4">

<h2 class="mb-4">
Welcome <?php echo $_SESSION['name']; ?>
</h2>

<?php
if($_SESSION['role']=="admin"){
?>

<a href="add_user.php"
class="btn btn-primary mb-3">

Add User

</a>

<?php } ?>

<input type="text"
id="search"
class="form-control mb-3"
placeholder="Search User">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>

</tr>

</thead>

<tbody id="tableBody">

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<?php if($row['profile_pic']){ ?>

<img
src="uploads/<?php echo $row['profile_pic']; ?>"
width="50"
height="50"
class="profile-img">

<?php } ?>

</td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['role']; ?></td>

<td>

<a href="edit_user.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<?php
if($_SESSION['role']=="admin"){
?>

<a href="delete_user.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete User?')">

Delete

</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<script>

document.getElementById("search")
.addEventListener("keyup", function(){

let value = this.value.toLowerCase();

let rows =
document.querySelectorAll("#tableBody tr");

rows.forEach(row => {

row.style.display =
row.innerText.toLowerCase()
.includes(value)
? ""
: "none";

});

});

</script>

</body>
</html>
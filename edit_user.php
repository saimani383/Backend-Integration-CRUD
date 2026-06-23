<?php
include 'session.php';
include 'db.php';
$id = $_GET['id'];

$stmt = $conn->prepare(
"SELECT * FROM users WHERE id=?");

$stmt->bind_param("i",$id);

$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

if(isset($_POST['update'])){

$name = $_POST['name'];
$email = $_POST['email'];

$update = $conn->prepare(
"UPDATE users SET name=?,email=? WHERE id=?");

$update->bind_param(
"ssi",$name,$email,$id);

if($update->execute()){
header("Location: dashboard.php");
}
}
?>

<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card p-4 shadow">

<h2>Edit User</h2>

<form method="POST">

<input type="text"
name="name"
value="<?php echo $user['name']; ?>"
class="form-control mb-3">

<input type="email"
name="email"
value="<?php echo $user['email']; ?>"
class="form-control mb-3">

<button class="btn btn-success"
name="update">

Update

</button>

</form>

</div>

</div>

</body>
</html>
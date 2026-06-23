<?php
include 'session.php';
include 'db.php';

if($_SESSION['role']!="admin"){
    die("Access Denied");
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];

    $password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
    "INSERT INTO users(name,email,password)
    VALUES(?,?,?)");

    $stmt->bind_param(
    "sss",$name,$email,$password);

    if($stmt->execute()){
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

<h2>Add User</h2>

<form method="POST">

<input type="text"
name="name"
class="form-control mb-3"
placeholder="Name"
required>

<input type="email"
name="email"
class="form-control mb-3"
placeholder="Email"
required>

<input type="password"
name="password"
class="form-control mb-3"
placeholder="Password"
required>

<button class="btn btn-primary"
name="submit">

Add User

</button>

</form>

</div>

</div>

</body>
</html>
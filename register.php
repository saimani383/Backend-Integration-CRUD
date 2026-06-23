<?php
include 'db.php';

$message = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],
    PASSWORD_DEFAULT);

    $role = $_POST['role'];

    $stmt = $conn->prepare(
    "INSERT INTO users(name,email,password,role)
    VALUES(?,?,?,?)");

    $stmt->bind_param(
    "ssss",$name,$email,$password,$role);

    if($stmt->execute()){
        $message = "Registration Successful";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow p-4">

<h2 class="text-center mb-4">
Register
</h2>

<?php if($message){ ?>

<div class="alert alert-success">
<?php echo $message; ?>
</div>

<?php } ?>

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

<select name="role"
class="form-control mb-3">

<option value="user">User</option>
<option value="admin">Admin</option>

</select>

<button class="btn btn-primary w-100"
name="register">

Register

</button>

</form>

<div class="text-center mt-3">

<a href="login.php">
Already have account?
</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>
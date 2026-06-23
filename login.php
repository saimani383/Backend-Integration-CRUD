<?php
session_start();

include 'db.php';

$error = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(
    "SELECT * FROM users WHERE email=?");

    $stmt->bind_param("s",$email);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify(
        $password,
        $user['password'])){

            $_SESSION['user_id'] =
            $user['id'];

            $_SESSION['name'] =
            $user['name'];

            $_SESSION['role'] =
            $user['role'];

            header("Location: dashboard.php");

        } else {
            $error = "Invalid Password";
        }

    } else {
        $error = "User Not Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow p-4">

<h2 class="text-center mb-4">
Login
</h2>

<?php if($error){ ?>

<div class="alert alert-danger">
<?php echo $error; ?>
</div>

<?php } ?>

<form method="POST">

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

<button class="btn btn-success w-100"
name="login">

Login

</button>

</form>

<div class="text-center mt-3">

<a href="register.php">
Create Account
</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>
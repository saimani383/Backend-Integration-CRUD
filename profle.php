<?php
include 'session.php';
include 'db.php';

$id = $_SESSION['user_id'];

if(isset($_POST['update'])){

$name = $_POST['name'];

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

$allowed = ['jpg','jpeg','png'];

$ext = strtolower(
pathinfo($image, PATHINFO_EXTENSION));

if(in_array($ext,$allowed)){

move_uploaded_file(
$tmp,
"uploads/".$image);

$stmt = $conn->prepare(
"UPDATE users SET name=?, profile_pic=? WHERE id=?");

$stmt->bind_param(
"ssi",$name,$image,$id);

$stmt->execute();
}
}

$stmt = $conn->prepare(
"SELECT * FROM users WHERE id=?");

$stmt->bind_param("i",$id);

$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<div class="card shadow p-4">

<h2>Profile</h2>

<form method="POST"
enctype="multipart/form-data">

<input type="text"
name="name"
value="<?php echo $user['name']; ?>"
class="form-control mb-3">

<input type="file"
name="image"
class="form-control mb-3">

<button class="btn btn-primary"
name="update">

Update Profile

</button>

</form>

<br>

<?php if($user['profile_pic']){ ?>

<img
src="uploads/<?php echo $user['profile_pic']; ?>"
width="120"
height="120"
class="profile-img">

<?php } ?>

</div>

</div>

</body>
</html>
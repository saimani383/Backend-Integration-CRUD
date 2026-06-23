<?php
include 'session.php';
include 'db.php';

if($_SESSION['role']!="admin"){
    die("Access Denied");
}

$id = $_GET['id'];

$stmt = $conn->prepare(
"DELETE FROM users WHERE id=?");

$stmt->bind_param("i",$id);

if($stmt->execute()){
    header("Location: dashboard.php");
}
?>
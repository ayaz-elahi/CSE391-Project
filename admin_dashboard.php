<?php 
session_start(); 
if($_SESSION["role"]!="admin") header("Location: login.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Admin Dashboard</h2>
    <div class="list-group">
        <a href="adminaddcourse.php" class="list-group-item">Add Course & Assign Faculty</a>
        <a href="login.php" class="list-group-item">Logout</a>
    </div>
</div>
</body>
</html>
<?php 
session_start(); 
if($_SESSION["role"]!="faculty") header("Location: login.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Faculty Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Faculty Dashboard</h2>
    <div class="list-group">
        <a href="advisingfac.php" class="list-group-item">Approve Advising Requests</a>
        <a href="selectgrade.php" class="list-group-item">Grade Students</a>
        <a href="login.php" class="list-group-item">Logout</a>
    </div>
</div>
</body>
</html>
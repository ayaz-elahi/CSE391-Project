<?php 
session_start(); 
if($_SESSION["role"]!="student") header("Location: login.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Student Dashboard</h2>
    <div class="list-group">
        <a href="showcourses.php" class="list-group-item">View Available Courses</a>
        <a href="advisingadd.php" class="list-group-item">Request Advising</a>
        <a href="studentgrade.php" class="list-group-item">Check My Grades</a>
        <a href="login.php" class="list-group-item">Logout</a>
    </div>
</div>
</body>
</html>
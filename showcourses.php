<?php
session_start();
if($_SESSION["role"]!="student") header("Location: login.php");

$conn = mysqli_connect("localhost", "root", "", "edusystem");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Available Courses</h2>
    
    <table class="table">
        <tr>
            <th>Course</th>
            <th>Section</th>
            <th>Faculty ID</th>
        </tr>
        <?php
        $sql = "SELECT * FROM facultysectionset";
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['course']}</td>
                <td>{$row['section']}</td>
                <td>{$row['faculty_id']}</td>
            </tr>";
        }
        ?>
    </table>
    <a href="student_dashboard.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
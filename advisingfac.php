<?php
session_start();
if($_SESSION["role"]!="faculty") header("Location: login.php");

$conn = mysqli_connect("localhost", "root", "", "edusystem");
$faculty_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Advising Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Advising Requests for Faculty ID: <?php echo $faculty_id; ?></h2>
    
    <table class="table">
        <tr>
            <th>Student ID</th>
            <th>Course</th>
            <th>Section</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        // Show only advising requests for courses taught by this faculty
        $sql = "SELECT a.id, a.course, a.section, a.status 
                FROM advising a 
                JOIN facultysectionset f ON a.course = f.course AND a.section = f.section 
                WHERE f.faculty_id = '$faculty_id' AND a.status = '0'";
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['course']}</td>
                <td>{$row['section']}</td>
                <td>Pending</td>
                <td><a class='btn btn-primary btn-sm' href='advisingapprv.php?id={$row['id']}'>Approve</a></td>
            </tr>";
        }
        ?>
    </table>
    <a href="faculty_dashboard.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
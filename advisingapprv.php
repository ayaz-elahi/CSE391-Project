<?php
session_start();
if($_SESSION["role"]!="faculty") header("Location: login.php");

$conn = mysqli_connect("localhost", "root", "", "edusystem");

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    
    // Get advising details
    $sql = "SELECT * FROM advising WHERE id = '$student_id' AND status = '0'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $course = $row['course'];
        $section = $row['section'];
        
        // Approve advising and add to student_grade
        $update1 = "UPDATE advising SET status = '1' WHERE id = '$student_id'";
        $update2 = "INSERT INTO student_grade (id, course, section, grade) VALUES ('$student_id', '$course', '$section', '')";
        
        $conn->query($update1);
        $conn->query($update2);
        
        $success = "Advising approved for Student ID: $student_id";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approve Advising</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Approve Advising</h2>
    
    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    
    <a href="advisingfac.php" class="btn btn-primary">Back to Requests</a>
    <a href="faculty_dashboard.php" class="btn btn-secondary">Dashboard</a>
</div>
</body>
</html>
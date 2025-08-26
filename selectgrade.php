<?php
session_start();
if($_SESSION["role"]!="faculty") header("Location: login.php");

$conn = mysqli_connect("localhost", "root", "", "edusystem");
$faculty_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grade Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Grade Students - Faculty ID: <?php echo $faculty_id; ?></h2>
    
    <table class="table">
        <tr>
            <th>Student ID</th>
            <th>Course</th>
            <th>Section</th>
            <th>Current Grade</th>
            <th>Action</th>
        </tr>
        <?php
        // Show students in courses taught by this faculty
        $sql = "SELECT sg.id, sg.course, sg.section, sg.grade 
                FROM student_grade sg 
                JOIN facultysectionset fs ON sg.course = fs.course AND sg.section = fs.section 
                WHERE fs.faculty_id = '$faculty_id'";
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $grade = empty($row['grade']) ? 'Not Graded' : $row['grade'];
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['course']}</td>
                <td>{$row['section']}</td>
                <td>$grade</td>
                <td><a class='btn btn-primary btn-sm' href='addgrade.php?id={$row['id']}'>Grade</a></td>
            </tr>";
        }
        ?>
    </table>
    <a href="faculty_dashboard.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
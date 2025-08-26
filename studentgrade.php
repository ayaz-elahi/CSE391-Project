<?php
session_start();
if($_SESSION["role"]!="student") header("Location: login.php");

$conn = mysqli_connect("localhost", "root", "", "edusystem");
$student_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Grades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>My Grades - Student ID: <?php echo $student_id; ?></h2>

    <table class="table">
        <tr>
            <th>Course</th>
            <th>Section</th>
            <th>Grade</th>
        </tr>
        <?php
        $sql = "SELECT * FROM student_grade WHERE id = '$student_id'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $grade = empty($row['grade']) ? 'Not Graded Yet' : $row['grade'];
                echo "<tr>
                    <td>{$row['course']}</td>
                    <td>{$row['section']}</td>
                    <td>$grade</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No courses enrolled yet.</td></tr>";
        }
        ?>
    </table>
    <a href="student_dashboard.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
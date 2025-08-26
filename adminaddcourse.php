<?php
session_start();
if($_SESSION["role"]!="admin") header("Location: login.php");

$conn = mysqli_connect("localhost", "root", "", "edusystem");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $faculty_id = $_POST["faculty_id"];
    $course = $_POST["course"];
    $section = $_POST["section"];

    if (!empty($course) && !empty($section) && !empty($faculty_id)) {
        $sql = "INSERT INTO facultysectionset(faculty_id, course, section) VALUES ('$faculty_id','$course', '$section')";
        $conn->query($sql);
        $success = "Course added and faculty assigned successfully";
    } else {
        $error = "All fields are required";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course & Assign Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Add Course & Assign Faculty</h2>

    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="post">
        <div class="mb-3">
            <label>Faculty ID</label>
            <input type="text" class="form-control" name="faculty_id" required>
        </div>            
        <div class="mb-3">
            <label>Course</label>
            <input type="text" class="form-control" name="course" required>
        </div>
        <div class="mb-3">
            <label>Section</label>
            <input type="text" class="form-control" name="section" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Course</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
<?php
session_start();
if($_SESSION["role"]!="student") header("Location: login.php");

$conn = mysqli_connect("localhost", "root", "", "edusystem");
$student_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course = $_POST["course"];
    $section = $_POST["section"];

    if (!empty($course) && !empty($section)) {
        $sql = "INSERT INTO advising(id, course, section, status) VALUES ('$student_id', '$course', '$section', '0')";
        $conn->query($sql);
        $success = "Advising request submitted. Wait for approval.";
    } else {
        $error = "Course and Section are required";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Advising</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Request Advising - Student ID: <?php echo $student_id; ?></h2>

    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="post">
        <div class="mb-3">
            <label>Course</label>
            <input type="text" class="form-control" name="course" required>
        </div>
        <div class="mb-3">
            <label>Section</label>
            <input type="text" class="form-control" name="section" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Request</button>
        <a href="showcourses.php" class="btn btn-info">View Available Courses</a>
        <a href="student_dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
<?php
session_start();
if($_SESSION["role"]!="faculty") header("Location: login.php");

$conn = mysqli_connect("localhost", "root", "", "edusystem");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $student_id = $_GET["id"];
    $sql = "SELECT * FROM student_grade WHERE id='$student_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST["id"];
    $grade = $_POST["grade"];
    
    $sql = "UPDATE student_grade SET grade = '$grade' WHERE id = '$student_id'";
    $conn->query($sql);
    $success = "Grade updated successfully";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Grade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Update Student Grade</h2>

    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="mb-3">
            <label>Student ID</label>
            <input type="text" class="form-control" value="<?php echo $row['id']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Course</label>
            <input type="text" class="form-control" value="<?php echo $row['course']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Section</label>
            <input type="text" class="form-control" value="<?php echo $row['section']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Grade</label>
            <input type="text" class="form-control" name="grade" value="<?php echo $row['grade']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Grade</button>
        <a href="selectgrade.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
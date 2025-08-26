<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "edusystem");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    if ($role == "student") {
        $sql = "SELECT * FROM students WHERE email='$email'";
    } else if ($role == "faculty") {
        $sql = "SELECT * FROM faculty WHERE email='$email'";
    } else if ($role == "admin") {
        $sql = "SELECT * FROM admins WHERE email='$email'";
    }

    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['role'] = $role;
            if ($role == "student") $_SESSION['id'] = $row['student_id'];
            if ($role == "faculty") $_SESSION['id'] = $row['faculty_id'];
            if ($role == "admin") $_SESSION['id'] = $row['admin_id'];

            header("Location: {$role}_dashboard.php");
            exit;
        }
    }
    $error = "Invalid login";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="post">
        <div class="mb-3">
            <label>Email</label>
            <input class="form-control" type="email" name="email" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input class="form-control" type="password" name="password" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select class="form-control" name="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
        <a href="register.php">Register</a>
    </form>
</div>
</body>
</html>
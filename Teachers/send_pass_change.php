<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// $id = $_SESSION['teacher_id']; // Retrieve the teacher's ID from the session
$message = '';

if (isset($_POST['change_password'])) {
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Fetch the current password from the database
    $sql = "SELECT password FROM teachers WHERE teacher_id = '$teacher_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['password'] === $current_password) { // Use password_verify() if passwords are hashed
            if ($new_password === $confirm_password) {
                // Update the password
                $update_sql = "UPDATE teachers SET password = '$new_password' WHERE teacher_id = '$teacher_id'";
                if (mysqli_query($conn, $update_sql)) {
                    $message = '<div class="alert alert-success">Password changed successfully!</div>';
                } else {
                    $message = '<div class="alert alert-danger">Error updating password: ' . mysqli_error($conn) . '</div>';
                }
            } else {
                $message = '<div class="alert alert-danger">New password and confirm password do not match!</div>';
            }
        } else {
            $message = '<div class="alert alert-danger">Current password is incorrect!</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">Error: User not found or database query failed!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Change Password</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($message)) echo $message; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password [<span style="color:crimson; font-weight: bold; "><?= $row['password'] ?></span>]</label>
                            <input type="password" class="form-control" name="current_password" id="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="change_password" class="btn btn-success">Change Password</button>
                        </div>
                    </form>
                </div>
                <!-- <div class="card-footer text-center">
                    <a href="logout.php" class="btn btn-link">Logout</a>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

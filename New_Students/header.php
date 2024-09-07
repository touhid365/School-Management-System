
<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['students_id'])) {
    header("Location:http://localhost/School-Manegment-System/new_student_login.php");
    exit();
}

// $user = $_SESSION['user'];
$students_id = $_SESSION['students_id'];
// $roll_number = $_SESSION['roll_number'] ?? $_GET['roll_number'] ?? null;


?>
<?php   
	$conn = new mysqli('localhost', 'root', '', 'students_db');
    $sql = mysqli_query($conn, "SELECT * FROM  `students` WHERE id = '$students_id'");
    if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
    }
?>
<!--otp verify ---->

<?php

$verifyMessage = '';
$students_id = $_SESSION['students_id'];

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "students_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student data
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $students_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['otp'])) {
    $entered_otp = implode('', $_POST['otp']); // Combine OTP input fields into one string
    $current_time = date('Y-m-d H:i:s');

    if ($row['otp'] == $entered_otp && $current_time <= $row['otp_expiry']) {
        // OTP is correct and not expired
        $_SESSION['otp_verified'] = true;
        $verifyMessage = '<div class="alert alert-success">OTP verified successfully!</div>';

        // Update student's verification status in the database
        $update_sql = "UPDATE students SET is_verified = 1 WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $students_id);
        $update_stmt->execute();
        echo '<script>
                setTimeout(function() {
                    window.location.href = "index.php";
                }, 2000); // 2000 milliseconds = 2 seconds
              </script>';
    } else {
        $verifyMessage = '<div class="alert alert-danger">Invalid or expired OTP. Please try again.</div>';
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/school_4130952.png" type="image/x-icon">
    <style>
        .badge-button {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 700;
        line-height: 1.5;
        text-align: center;
        text-decoration: none !important;
        white-space: nowrap;
        border-radius: 0.375rem;
        color: #fff;
        background-color: #007bff; /* Default button color */
        border: 1px solid transparent;
    }

    .badge-button.success {
        background-color: #28a745; /* Green color for success */
        /* color: #fff; */
    }

    .badge-button.danger {
        background-color: #dc3545; /* Red color for danger */
        /* color: #fff; */
    }

    .badge-button.warning {
        background-color: #ffc107; /* Yellow color for warning */
        color: #212529; /* Text color for warning */
        color: #fff;
    }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       <?php include 'sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               <?php include 'topbar.php' ?>
                <!-- End of Topbar -->
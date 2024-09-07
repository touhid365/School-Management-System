
<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location:http://localhost/School-Manegment-System/Student_login.php");
    exit();
}


// $user = $_SESSION['user'];
$student_id = $_SESSION['student_id'];
// $roll_number = $_SESSION['roll_number'] ?? $_GET['roll_number'] ?? null;


// ?>
 <?php   
	$conn = new mysqli('localhost', 'root', '', 'students_db');
    $sql = mysqli_query($conn, "SELECT * FROM  `reg_students` WHERE id = '$student_id'");
    if(mysqli_num_rows($sql) > 0){
    $user = mysqli_fetch_assoc($sql);
    }
     // Fetch the list of exams from the database
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "exam_system";
     
     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     
     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     
     // Fetch the list of exams from the database
     $result = $conn->query("SELECT id, title, total_marks, total_question, total_time FROM exams");
     
     if ($result === false) {
         die('Error: ' . htmlspecialchars($conn->error));
     }
     $result = $conn->query("SELECT id, title, total_marks, total_question, total_time FROM exams");

     if ($result === false) {
     die('Error: ' . htmlspecialchars($conn->error));
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exam - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="./img/graduate.png" type="image/x-icon">

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
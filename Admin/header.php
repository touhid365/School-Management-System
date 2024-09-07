<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location:http://localhost/School-Manegment-System/admin_login.php");
    exit();
}

// $user = $_SESSION['user'];
$admin_id = $_SESSION['admin_id'];




?>
<?php   
	$conn = new mysqli('localhost', 'root', '', 'students_db');
    $sql = mysqli_query($conn, "SELECT * FROM  `admins` WHERE id = '$admin_id'");
    if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
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

    <title>Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link rel="icon" href="../images/school_17720730.png" style="width: 400px; height: 400px; " type="image/jpeg"> -->
    <link rel="icon" href="../images/school_3297823.png" type="image/jpeg">


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
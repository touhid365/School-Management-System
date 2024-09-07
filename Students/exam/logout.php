<?php
// Start session
session_start();

// Destroy session and redirect to login page
session_destroy();
header("Location:http://localhost/School-Manegment-System/Student_login.php");
exit();
?>
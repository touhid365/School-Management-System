<?php
// Start session
session_start();

// Destroy session and redirect to login page
session_destroy();
header("Location:http://localhost/School-Manegment-System/teachers_login.php");
exit();
?>
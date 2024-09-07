<?php
// Start session
session_start();
$common_id = '';
function generateId() {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 40);
}
$common_id = generateId();

// Destroy session and redirect to login page
session_destroy();
header("Location:http://localhost/School-Manegment-System/teachers_login.php?logout=".$common_id."");
exit();
?>

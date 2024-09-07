<?php
$error  = '';
// Database connection
$conn = mysqli_connect("localhost", "root", "", "students_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if id is passed in the URL
if (isset($_GET['id'])) {
    $question_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM questions WHERE id=$question_id";

    if (mysqli_query($conn, $sql)) {
        $error = "Question deleted successfully.";
        header("Location: exam_questions.php");
    } else {
        $error = "Error deleting question: " . mysqli_error($conn);
    }
} else {
    $error = "Invalid request.";
}

mysqli_close($conn);
?>

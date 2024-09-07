<?php
ob_start();
  // Include database configuration file
  $servername = "localhost";
  $rowname = "root"; // Your MySQL username
  $password = ""; // Your MySQL password
  $dbname = "students_db";

  // Create connection
  $conn = new mysqli($servername, $rowname, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }
  $message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $total_marks = $_POST['total_marks'];
    $total_question = $_POST['total_question'];
    $total_time = $_POST['total_time'];

    // Check if an exam with the same title already exists in the database
    $check_sql = "SELECT * FROM exams WHERE title = '$title'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // Duplicate exam found
        $message = "<div class='container'><div class='alert alert-danger' role='alert'>An exam with this title already exists!</div></div>";
    } else {
        // No duplicate found, insert the exam
        $insert_sql = "INSERT INTO exams (title, total_marks, total_question, total_time) 
                       VALUES ('$title', $total_marks, $total_question, $total_time)";

        if (mysqli_query($conn, $insert_sql)) {
            $exam_id = mysqli_insert_id($conn);
            header("Location: add_questions.php?exam_id=$exam_id&total_question=$total_question");
            // $redirect_url = "add_questions.php?exam_id=$exam_id&total_question=$total_question";
            exit;
        } else {
            $message = "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
        }
    }
}
ob_end_flush();
?>

<?php 
session_start();
 if (!isset($_SESSION['teacher_id'])) {
    header("Location:http://localhost/School-Manegment-System/teachers_login.php");
    exit();
 }

$teacher_id = $_SESSION['teacher_id'];
$conn = new mysqli('localhost', 'root', '', 'students_db');
$sql = mysqli_query($conn, "SELECT * FROM  `teachers` WHERE teacher_id = '$teacher_id'");
if(mysqli_num_rows($sql) > 0){
$row = mysqli_fetch_assoc($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <title>Add Exam</title>
   
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
      <!-- <script>
        function redirectTo(url) {
            setTimeout(function() {
                window.location.href = url;
            }, 2000); // Redirect after 2 seconds
        }
    </script> -->
</head>
<body>
<?php include 'navbar.php' ?>

<div class="container">
<?php if (!empty($message)) echo $message; ?>
    <div class="card">
        <h2>Add New Exam</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="title">Exam Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="total_marks">Total Marks:</label>
                <input type="number" class="form-control" id="total_marks" name="total_marks" required>
            </div>
            <div class="form-group">
                <label for="total_question">Total Questions:</label>
                <input type="number" class="form-control" id="total_question" name="total_question" required>
            </div>
            <div class="form-group">
                <label for="total_time">Total Time (minutes):</label>
                <input type="number" class="form-control" id="total_time" name="total_time" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Exam</button>
        </form>
    </div>
</div>
<?php include 'footer.php' ?>

<!-- Bootstrap JS, Popper.js, and jQuery -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <!-- Bootstrap core JavaScript-->

</body>
</html>

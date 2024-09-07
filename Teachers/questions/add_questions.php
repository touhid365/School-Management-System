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


$exam_id = $_GET['exam_id'];
$total_question = $_GET['total_question'];
$current_question = isset($_GET['current_question']) ? $_GET['current_question'] : 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    // Check if the question already exists in the database for the same exam
    $check_sql = "SELECT * FROM questions WHERE exam_id = $exam_id AND question = '$question'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // Duplicate question found
        $message = "<div class='container'><div class='alert alert-danger' role='alert'>This question already exists in the exam!</div></div>";
    } else {
        // No duplicate found, insert the question
        $insert_sql = "INSERT INTO questions (exam_id, question, option_a, option_b, option_c, option_d, correct_option) 
                       VALUES ($exam_id, '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_option')";

        if (mysqli_query($conn, $insert_sql)) {
            if ($current_question < $total_question) {
                header("Location: add_questions.php?exam_id=$exam_id&total_question=$total_question&current_question=" . ($current_question + 1));
            } else {
               
                $message = "<div class='container'><div class='alert alert-success' role='alert'>All questions added successfully!</div></div>";
                exit;
            }
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
    <title>Add Question <?php echo $current_question; ?> of <?php echo $total_question; ?></title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            max-height: 300px;
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
        h3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php' ?>


<div class="container">
    <div class="card">
        <h3>Add Question<?php echo $current_question; ?> of <?php echo $total_question; ?> </h3>
        <form method="post" action="">
        <?php if (!empty($message)) echo $message; ?>
            <div class="form-group">
                <label for="question">Question:</label>
                <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="option_a">Option A:</label>
                <input type="text" class="form-control" id="option_a" name="option_a" required>
            </div>
            <div class="form-group">
                <label for="option_b">Option B:</label>
                <input type="text" class="form-control" id="option_b" name="option_b" required>
            </div>
            <div class="form-group">
                <label for="option_c">Option C:</label>
                <input type="text" class="form-control" id="option_c" name="option_c" required>
            </div>
            <div class="form-group">
                <label for="option_d">Option D:</label>
                <input type="text" class="form-control" id="option_d" name="option_d" required>
            </div>
            <div class="form-group">
                <label for="correct_option">Correct Option:</label>
                <select class="form-control" id="correct_option" name="correct_option" required>
                    <option value="A">Option A</option>
                    <option value="B">Option B</option>
                    <option value="C">Option C</option>
                    <option value="D">Option D</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>        
</div>
<div class="footer" style=" position:relative; margin-top: 27rem; ">
    <footer class="sticky-footer bg-white">
        <div class="container my-auto" style=" width: 100%; ">
            <div class="copyright text-center my-auto" style=" width: 100%; ">
                <span>Copyright &copy; Learn<span style="color: coral; font-weight: 600;">Dash</span>Academy 2024</span>
            </div>
        </div>
    </footer>

</div>


<!-- Bootstrap JS, Popper.js, and jQuery  -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
 
</body>
</html>

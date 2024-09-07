<?php
session_start();
$message = '';
$student_id = $_SESSION['student_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }


$exam_id = $_GET['exam_id'];
//  AND r.student_id != '$student_id'
// Fetch all user results
// $sql = "SELECT u.id as user_id, u.username, er.total_questions, er.correct_answers, er.incorrect_answers, er.percentile 
//         FROM exam_results er 
//         JOIN users u ON er.user_id = u.id 
//         ORDER BY er.percentage DESC";
// Assuming you have the selected exam ID stored in a variable
$selected_exam_id = $exam_id; // Replace this with the actual exam ID
// Replace this with the current user's ID to exclude their results

$sql = "SELECT 
        r.id,
        s.first_name AS student_name, 
        s.roll_number AS roll_no,
        e.title AS exam_name, 
        r.total_questions, 
        r.correct_answers, 
        r.score, 
        r.percentage, 
        r.created_at,
        FIND_IN_SET(r.percentage, (
            SELECT GROUP_CONCAT(percentage ORDER BY percentage DESC) 
            FROM results_tb 
            WHERE exam_id = r.exam_id
        )) AS `ranking`
    FROM 
        results_tb r
    JOIN 
        reg_students s ON r.student_id = s.id
    JOIN 
        exams e ON r.exam_id = e.id
    WHERE 
        r.exam_id = '$selected_exam_id' 
       
        
    ORDER BY 
        r.percentage DESC, r.created_at ASC";

$result = $conn->query($sql);
$count = 1;

if ($result === false) {
    // Display the error message if the query fails
    $message = "Error: " . $conn->error;
    exit; // Stop further execution if there's an error
}

$scoreboard = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $scoreboard[] = $row;
    }
} else {
  
    $message ='<div class="alert alert-danger" role="alert"><strong>Error!</strong> No results found.</div>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Scoreboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./img/graduate.png" type="image/x-icon">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-wrapper {
            width: 80%;
            margin: 50px auto;
        }
        h2 {
            margin-top: 20px;
            text-align: center;
            color: #343a40;
        }
        table {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2>Exam Scoreboard</h2>

<div class="table-wrapper">
    <table class="table table-bordered table-hover table-striped table-responsive-sm">
        <thead class="thead-dark">
            <tr>
                <th>S.NO</th>
                <th>Student Name</th>
                <th>Roll No</th>
                <th>Score</th>
                <th>Percentage</th>
                <th>Rank</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($scoreboard)): ?>
                <?php foreach ($scoreboard as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($count++); ?></td>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['roll_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['score']); ?></td>
                        <td><?php echo htmlspecialchars($row['percentage']); ?></td>
                        <td><?php echo htmlspecialchars($row['ranking']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No scores available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

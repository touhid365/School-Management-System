<?php
include 'db.php';
session_start();
$student_id = $_SESSION['student_id'] ;
$exam_id = $_GET['exam_id'];


// Fetch total questions
$sql = "SELECT COUNT(*) AS total_questions FROM questions WHERE exam_id = :exam_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':exam_id', $exam_id, PDO::PARAM_INT);
$stmt->execute();
$total_questions = $stmt->fetchColumn();

// Fetch correct answers
$sql = "SELECT COUNT(*) AS correct_answers
        FROM user_answers ua
        JOIN questions q ON ua.question_id = q.id
        WHERE ua.student_id = :student_id AND ua.exam_id = :exam_id AND ua.selected_option = q.correct_option";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
$stmt->bindParam(':exam_id', $exam_id, PDO::PARAM_INT);
$stmt->execute();
$correct_answers = $stmt->fetchColumn();
$incorrect_answers = 0;
$percentage = 0;


// Calculate score and percentage
$score = $correct_answers;
// $percentage = ($correct_answers / $total_questions) * 100;
if ($total_questions > 0) {
    $percentage = ($correct_answers / $total_questions) * 100;
}

//store the result, into database table result_td

// if ($result_count == $student_id) {
//     // If the result is already stored, redirect to results page or show a message
//     header("Location: your_result.php?exam_id=" . $exam_id);
//     exit();
// } else {

// Store the result in the results_tb table
// $sql = "INSERT INTO results_tb (student_id, exam_id, total_questions, correct_answers, score, percentage)
//         VALUES (:student_id, :exam_id, :total_questions, :correct_answers, :score, :percentage)";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([
//     ':student_id' => $student_id,
//     ':exam_id' => $exam_id,
//     ':total_questions' => $total_questions,
//     ':correct_answers' => $correct_answers,
//     ':score' => $score,
//     ':percentage' => $percentage
// ]);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results Card</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./img/graduate.png" type="image/x-icon">

    <style>
        .card-custom {
            max-width: 450px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .score-circle {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .score-circle .circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: conic-gradient(#4CAF50 85%, #ddd 0);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .score-circle .circle span {
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        .btn-custom {
            margin: 5px;
        }

        .stats p {
            margin: 5px 0;
            font-size: 16px;
        }

        .stats strong {
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="card card-custom">
        

        <!-- <div class="score-circle">
            <div class="circle">
                <span>85%</span>
            </div>
        </div> -->
        <?php 
        if ($total_questions > 0) {?>
            <h3 class="text-success">🎉 Congratulations 🎉</h3>
            <p>You successfully completed the Exam. Now you can click on finish and go back to your home page.</p>
            <div class="stats">
            <p>Total Questions: <strong><?= $total_questions ?></strong></p>
            <p>Correct Questions: <strong><?= $correct_answers ?></strong></p>
            <!-- <p>Unattempted Questions: <strong>2</strong></p> -->
            <p>Accuracy: <strong><?php echo number_format($percentage, 2); ?>%</strong></p>
        </div>

        <p>Your Score: <strong><?= $score ?>/</strong><?= $total_questions ?></p>
        <p>Passing Score: <strong>80%</strong></p>
        <?php }
        else
        {?>
             <h3 class="text-success">🙇🏻💔 Sorry..! 🙇🏻‍♂️💔</h3>
             <p>You do not completed the Exam..</p>
            <div class="stats">
                <p>Total Questions: <strong>0</strong></p>
                <p>Correct Questions: <strong>0</strong></p>
                <p>Accuracy: <strong>0%</strong></p>
            </div>
            <p>Your Score: <strong>0/0</strong></p>
            <p><strong>Not found result...!</strong></p>
        <?php }

         ?>

        <a href="index.php" class="btn btn-primary btn-custom">Go Back</a>
        <button class="btn btn-outline-secondary btn-custom">Share</button>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

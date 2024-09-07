<?php
ob_start(); // Start output buffering
include 'db.php';
session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['student_id'] ;
    
    $exam_id = $_POST['exam_id'];
    $answers = $_POST['answers']; // Array of question_id => selected_option

    // fetch the total question from database
    $sql = "SELECT COUNT(*) AS total_questions FROM questions WHERE exam_id = :exam_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':exam_id', $exam_id, PDO::PARAM_INT);
    $stmt->execute();
    $total_questions = $stmt->fetchColumn();

    // $total_questions = count($answers);
    // $attempted_questions = 0;
    // $correct_answers = 0;
    // $incorrect_answers = 0;

    foreach ($answers as $question_id => $selected_option) {
        // Check if the user answered the question
      
        if ($selected_option) {
            // $attempted_questions++;

            // // Fetch the correct option for this question
            // $sql = "SELECT correct_option FROM questions WHERE id = :question_id ";
            // $stmt = $pdo->prepare($sql);
            // $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
            // $stmt->execute();
            // $correct_option = $stmt->fetchColumn();
            // Fetch correct answers
            // $sql = "SELECT *
            //         FROM user_answers ua
            //         JOIN questions q ON ua.question_id = q.id
            //         WHERE ua.user_id = :user_id AND ua.exam_id = :exam_id AND ua.selected_option = q.correct_option";
            //         $stmt = $pdo->prepare($sql);
            //         $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            //         $stmt->bindParam(':exam_id', $exam_id, PDO::PARAM_INT);
            //         $stmt->execute();
                   // $correct_option = $stmt->fetchColumn();
                    $sql = "SELECT 
                        ua.question_id, 
                        ua.selected_option, 
                        q.correct_option 
                    FROM 
                        user_answers ua
                    INNER JOIN 
                        questions q 
                    ON 
                        ua.question_id = q.id
                    WHERE 
                        ua.student_id = :student_id 
                    AND 
                        ua.exam_id = :exam_id
                ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':student_id' => $student_id,
                    ':exam_id' => $exam_id
                ]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($results) {
                    foreach ($results as $result) {
                        echo "Question ID: " . $result['question_id'] . "<br>";
                        echo "Selected Option: " . $result['selected_option'] . "<br>";
                        echo "Correct Option: " . $result['correct_option'] . "<br><br>";
                    }
                } else {
                    echo "No results found.";
                }
                

            // Check if the selected option is correct
            // if ($results === $selected_option) {
            //     $correct_answers++;
            // } else {
                
            //     $incorrect_answers++;
            // }
        }
           // Check if the user has already submitted answers for this exam
        include 'db.php';
        $sql = "SELECT COUNT(*) FROM user_answers WHERE student_id = :student_id AND exam_id = :exam_id ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->bindParam(':exam_id', $exam_id, PDO::PARAM_INT);
        $stmt->execute();
        $submission_count = $stmt->fetchAll();
        if ( $submission_count == $student_id  ) {
         // If answers are already submitted, redirect to results page or show a message
         header("Location: confirmation.php?exam_id=" . $exam_id);
         exit();
        } else {

        // Store the user's answer
        $sql = "INSERT INTO user_answers (student_id, exam_id, question_id, selected_option)
                VALUES (:student_id, :exam_id, :question_id, :selected_option)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':student_id' => $student_id,
            ':exam_id' => $exam_id,
            ':question_id' => $question_id,
            ':selected_option' => $selected_option
        ]);
    }
}



    // -------------storethe result ----------
    $sql = "SELECT COUNT(*) FROM results_tb WHERE student_id = :student_id AND exam_id = :exam_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
    $stmt->bindParam(':exam_id', $exam_id, PDO::PARAM_INT);
    $stmt->execute();
    $result_count = $stmt->fetchColumn();
   
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


// Calculate score and percentage
$score = $correct_answers;
$percentage = ($correct_answers / $total_questions) * 100;

//store the result, into database table result_td

if ($result_count == $student_id) {
    // If the result is already stored, redirect to results page or show a message
    header("Location: your_result.php?exam_id=" . $exam_id);
    exit();
} else {

// Store the result in the results_tb table
$sql = "INSERT INTO results_tb (student_id, exam_id, total_questions, correct_answers, score, percentage)
        VALUES (:student_id, :exam_id, :total_questions, :correct_answers, :score, :percentage)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':student_id' => $student_id,
    ':exam_id' => $exam_id,
    ':total_questions' => $total_questions,
    ':correct_answers' => $correct_answers,
    ':score' => $score,
    ':percentage' => $percentage
]);

      // Redirect to the result page after storing the result
    //   header("Location: result.php?exam_id=" . $exam_id);
      header("Location:confirmation.php?exam_id=" . $exam_id);
      
}

    // Redirect to the result page
    // header('Location: result.php?exam_id=' . $exam_id);
    // exit;
      // Clear the session data related to the exam
    //   unset($_SESSION['exam_id']);
    //   unset($_SESSION['student_id']);
      
    //   // Set headers to prevent caching of the exam page
    //   header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    //   header("Pragma: no-cache"); // HTTP 1.0.
    //   header("Expires: 0"); // Proxies.
}
ob_end_flush(); // Flush the output buffer and turn off output buffering




<?php
include 'db.php';
session_start();
// if (isset($_SESSION['exam_id'])) {
//     header('Location: submit_exam.php');
//     exit;
// }


$exam_id = $_GET['id'];
// $exam_id = $_SESSION['exam_id'];

$sql = "SELECT exams.id, exams.title AS exam_title, exams.total_time, questions.id AS question_id, questions.question, questions.option_a, questions.option_b, questions.option_c, questions.option_d
        FROM exams
        LEFT JOIN questions ON exams.id = questions.exam_id
        WHERE exams.id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $exam_id, PDO::PARAM_INT);
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$exam_title = '';
$total_time = 0;
$total_questions = 0;

if (!empty($questions)) {
    $exam_title = $questions[0]['exam_title'];
    $total_time = $questions[0]['total_time'];
    $total_questions = count($questions);
} else {
    $exam_title = 'Not Found';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>React Basic Quiz</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="./img/graduate.png" type="image/x-icon">
    <style>
 body {
    background-color: #f8f9fa;
}

.quiz-card {
    border: 2px solid #6c63ff; /* Card border */
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.quiz-header {
    background-color: #fff;
    border-bottom: 1px solid #e9ecef;
    padding: 20px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.quiz-header h2 {
    margin: 0;
}

.quiz-body {
    background-color: #fff;
    padding: 20px;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}

.progress {
    height: 3px;
    border-radius: 5px;
}

#timer {
    font-size: 18px;
    border: 1px solid crimson;
    padding: 2px;
    border-radius: 5px;
}

.timer-label {
    font-weight: bold;
    margin-right: 5px;
}

.nav-btns .btn {
    width: 100px;
}

.nav-btns .btn-primary {
    background-color: #6c63ff;
    border: none;
}

.nav-btns .btn-primary:hover {
    background-color: #5146d3;
}

.question {
    padding: 15px;
    margin-bottom: 15px;
    border: 2px solid #e9ecef; /* Question border */
    border-radius: 8px;
}

/* Hide the default radio buttons */
.form-check-input {
    display: none;
}

/* Style the custom label as a selectable option */
.form-check-label {
    display: block;
    padding: 10px;
    border: 2px solid #dee2e6; /* Option border */
    border-radius: 5px;
    margin-bottom: 10px;
    background-color: #f8f9fa;
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s, color 0.3s;
}

/* Style for options when selected */
.form-check-input:checked + .form-check-label {
    background-color: #d4edda;/* Green background for selected option */
    border-color: #28a745; /* Green border for selected option */
    color: #008200; /* White text for selected option */
}

/* Hover effect for options */
.form-check-label:hover {
    background-color: #e9ecef; /* Light grey on hover */
    border-color: #6c63ff; /* Border color on hover */
}

    </style>
 


    <script>
       // Set the initial time for the timer (in seconds)
let timeLeft = <?= $total_time * 60; ?>; //convert minutes into seconds

// Function to start the countdown timer
function startTimer() {
    const timerElement = document.getElementById('time-remaining');

    const timerInterval = setInterval(() => {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        // Add a leading zero to seconds if less than 10
        seconds = seconds < 10 ? `0${seconds}` : seconds;

        // Display the timer
        timerElement.textContent = `${minutes}:${seconds}`;

        // If time runs out, clear the interval and handle time up (e.g., submit the quiz)
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert("Time's up! your exam Submitting...");
            window.location.href = "submit_answer.php"; // Redirect to the submission page
            // You can add code here to automatically submit the quiz
        }

        // Decrement time
        timeLeft--;
    }, 1000);
}

    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card quiz-card">
                    <div class="card-header quiz-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><?= htmlspecialchars($exam_title) ?></h2>
                        <div id="timer" class="text-danger fw-bold">
                          <span class="timer-label">Time Left: </span><span id="time-remaining"></span>
                       </div>
                    </div>
                    <div class="card-body quiz-body">
                        <div class="progress mb-4">
                            <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <form id="quizForm" action="submit_answer.php" method="post">
                           <input type="hidden" name="exam_id" value="<?= $exam_id ?>">
                            <?php foreach ($questions as $index => $question): ?>
                                <div class="question" id="question-<?php echo $index; ?>" style="<?php echo $index === 0 ? '' : 'display: none'; ?>">
                                    <h5>Question <?php echo $index + 1; ?> of <?php echo $total_questions; ?></h5>
                                    <p><?php echo htmlspecialchars($question['question']); ?></p>
                                    <input type="hidden" name="question_ids[]" value="<?= $question['question_id'] ?>">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[<?= $question['question_id']; ?>]" value="A" id="q<?= $question['question_id']; ?>a">
                                        <label class="form-check-label" for="q<?= $question['question_id']; ?>a"><?php echo htmlspecialchars($question['option_a']); ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[<?= $question['question_id']; ?>]" value="B" id="q<?= $question['question_id']; ?>b">
                                        <label class="form-check-label" for="q<?= $question['question_id']; ?>b"><?= htmlspecialchars($question['option_b']); ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[<?= $question['question_id']; ?>]" value="C" id="q<?= $question['question_id']; ?>c">
                                        <label class="form-check-label" for="q<?= $question['question_id']; ?>c"><?= htmlspecialchars($question['option_c']); ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[<?= $question['question_id']; ?>]" value="D" id="q<?= $question['question_id']; ?>d">
                                        <label class="form-check-label" for="q<?= $question['question_id']; ?>d"><?= htmlspecialchars($question['option_d']); ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="d-flex justify-content-between mt-4 nav-btns">
                                <button type="button" id="prevBtn" class="btn btn-secondary" onclick="navigateQuestion(-1)" disabled>Previous</button>
                                <button type="button" id="nextBtn" class="btn btn-primary" onclick="navigateQuestion(1)">Next</button>
                                <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentQuestion = 0;
        const totalQuestions = <?= $total_questions; ?>;

        function updateProgressBar() {
            const progress = ((currentQuestion + 1) / totalQuestions) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
            document.getElementById('progress-bar').setAttribute('aria-valuenow', progress);
        }

        function navigateQuestion(step) {
            document.getElementById(`question-${currentQuestion}`).style.display = 'none';
            currentQuestion += step;
            document.getElementById(`question-${currentQuestion}`).style.display = 'block';
            document.getElementById('prevBtn').disabled = currentQuestion === 0;
            document.getElementById('nextBtn').style.display = currentQuestion === totalQuestions - 1 ? 'none' : 'inline-block';
            document.getElementById('submitBtn').style.display = currentQuestion === totalQuestions - 1 ? 'inline-block' : 'none';
            updateProgressBar();
        }

        window.onload = function() {
            startTimer();
            updateProgressBar();
        };
    </script>


</body>
</html>

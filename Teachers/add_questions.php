<?php include 'header.php';

 ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Exam Selection Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Select Exam</h5>
        </div>
        <div class="card-body">
            <form id="selectExamForm" method="POST">
                <div class="form-group">
                    <label for="examTitle">Select Exam Title:</label>
                    <select class="form-control" id="examTitle" name="examTitle" required>
                        <option value="">Select an exam</option>
                        <?php
                        // Fetch the list of exams from the database
                        $conn = new mysqli('localhost', 'root', '', 'students_db');
                        $result = $conn->query("SELECT id, title FROM exams");

                        if ($result && $result->num_rows > 0) {
                            while ($exam = $result->fetch_assoc()) {
                                echo "<option value=\"" . htmlspecialchars($exam['id']) . "\">" . htmlspecialchars($exam['title']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3" name="selectExam">Next</button>
            </form>
        </div>
    </div>

    <!-- Add Questions Section -->
    <?php if (isset($_POST['selectExam'])): ?>
        <?php
        $selectedExamId = $_POST['examTitle'];
        $examResult = $conn->query("SELECT title, total_question FROM exams WHERE id='$selectedExamId'");
        $exam = $examResult->fetch_assoc();
        $examTitle = $exam['title'];
        $totalQuestionsAllowed = $exam['total_question'];

        // Count existing questions
        $countResult = $conn->query("SELECT COUNT(*) as total FROM questions WHERE exam_id='$selectedExamId'");
        $countRow = $countResult->fetch_assoc();
        $currentQuestionCount = $countRow['total'];
        ?>
        <div class="card mt-4">
            <div class="card-header">
                <h5>Add Questions for - <?php echo htmlspecialchars($examTitle); ?></h5>
                <small>Total Questions Allowed: <?php echo htmlspecialchars($totalQuestionsAllowed); ?></small><br>
                <small>Current Questions No: <?php echo htmlspecialchars($currentQuestionCount); ?></small>
            </div>
            <div class="card-body">
                <?php if ($currentQuestionCount < $totalQuestionsAllowed): ?>
                    <form action="" method="POST">
                        <?php if(!empty($message)) echo $message ?>
                        <input type="hidden" name="examId" value="<?php echo htmlspecialchars($selectedExamId); ?>">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Input</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Question No: <?= ++$currentQuestionCount ?></td>
                                    <td><input type="text" class="form-control" id="question" name="question" required></td>
                                </tr>
                                <tr>
                                    <td>Option A:</td>
                                    <td><input type="text" class="form-control" id="optionA" name="optionA" required></td>
                                </tr>
                                <tr>
                                    <td>Option B:</td>
                                    <td><input type="text" class="form-control" id="optionB" name="optionB" required></td>
                                </tr>
                                <tr>
                                    <td>Option C:</td>
                                    <td><input type="text" class="form-control" id="optionC" name="optionC" required></td>
                                </tr>
                                <tr>
                                    <td>Option D:</td>
                                    <td><input type="text" class="form-control" id="optionD" name="optionD" required></td>
                                </tr>
                                <tr>
                                    <td>Correct Answer:</td>
                                    <td>
                                        <select class="form-control" id="answer" name="answer" required>
                                            <option value="A">Option A</option>
                                            <option value="B">Option B</option>
                                            <option value="C">Option C</option>
                                            <option value="D">Option D</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary" name="addQuestion">Add Question</button>
                    </form>
                <?php else: ?>
                    <div class='alert alert-warning'>The maximum number of questions for this exam has been reached.</div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php
    $message ='';
    // Handle form submission to add new question
    if (isset($_POST['addQuestion'])) {
        $examId = $_POST['examId'];
        $question = $_POST['question'];
        $optionA = $_POST['optionA'];
        $optionB = $_POST['optionB'];
        $optionC = $_POST['optionC'];
        $optionD = $_POST['optionD'];
        $answer = $_POST['answer'];

        // Check if the question already exists
        $checkQuery = "SELECT * FROM questions WHERE exam_id='$examId' AND question='$question'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            $message = "<div class='alert alert-danger mt-4'>This question already exists for the selected exam.</div>";
        } else {
            // Insert new question into the database
            $insertQuery = "INSERT INTO questions (exam_id, question, option_a, option_b, option_c, option_d, correct_option) 
                            VALUES ('$examId', '$question', '$optionA', '$optionB', '$optionC', '$optionD', '$answer')";

            if ($conn->query($insertQuery) === TRUE) {
                $message = "<div class='alert alert-success mt-4'>New question added successfully!</div>";
            } else {
                $message = "<div class='alert alert-danger mt-4'>Error: " . $conn->error . "</div>";
            }
        }
    }
    ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include 'footer.php'; ?>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
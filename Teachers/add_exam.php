<?php 
include 'header.php'; 

// Initialize messages variable
$messages = '';

// Handle form submission to add new exam
if (isset($_POST['addExam'])) {
    // Retrieve form input
    $examName = $_POST['examName'];
    $totalQuestions = $_POST['totalQuestions'];
    $totalMarks = $_POST['totalMarks'];
    $totalTime = $_POST['totalTime'];
    $exam_type = $_POST['exam_type'];

    // Connection to database
    $conn = new mysqli('localhost', 'root', '', 'students_db');

    // Check for connection errors
    if ($conn->connect_error) {
        $messages = "<div class='alert alert-danger mt-4'>Connection failed: " . $conn->connect_error . "</div>";
    } else {
        // Check if exam already exists
        $sql = "SELECT * FROM exams WHERE title ='$examName'";
        $fetch = mysqli_query($conn, $sql);

        if (mysqli_num_rows($fetch) > 0) {
            $messages = "<div class='alert alert-danger mt-4'>An exam already exists!</div>";
        } else {
            // Insert new exam into the database
            $insertQuery = "INSERT INTO exams (title, total_question, total_marks, total_time, exam_type) 
                            VALUES ('$examName', '$totalQuestions', '$totalMarks', '$totalTime', '$exam_type')";

            if ($conn->query($insertQuery) === TRUE) {
                $messages = "<div class='alert alert-success mt-4'>New exam added successfully!</div>";
            } else {
                $messages = "<div class='alert alert-danger mt-4'>Error: " . $conn->error . "</div>";
            }
        }
    }
    $conn->close();
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Add New Exam Section -->
    <div class="add-exam-section mt-5">
        <div class="card shadow mx-auto" style="max-width: 600px;">
            <div class="card-header text-center">
                <h3>Add New Exam</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <!-- Display messages -->
                    <?php if(!empty($messages)) echo $messages; ?>

                    <div class="form-group">
                        <label for="examName">Exam Name:</label>
                        <input type="text" class="form-control" id="examName" name="examName" required>
                    </div>
                    <div class="form-group">
                        <label for="totalQuestions">Total Questions:</label>
                        <input type="number" class="form-control" id="totalQuestions" name="totalQuestions" required>
                    </div>
                    <div class="form-group">
                        <label for="totalMarks">Total Marks:</label>
                        <input type="number" class="form-control" id="totalMarks" name="totalMarks" required>
                    </div>
                    <div class="form-group">
                        <label for="totalTime">Total Time (minutes):</label>
                        <input type="number" class="form-control" id="totalTime" name="totalTime" required>
                    </div>
                    <div class="form-group">
                        <label for="exam_type">Types of Stream:</label>
                        <select class="form-control" name="exam_type" id="exam_type" required>
                            <option value="Science">Science</option>
                            <option value="Arts">Arts</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="addExam">Add Exam</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Rest of your HTML code -->

<?php include 'footer.php'; ?>

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


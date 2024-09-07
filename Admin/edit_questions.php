<!-- Footer -->
<?php include 'header.php' ?>
<!-- End of Footer -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="exam_questions.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Questions</a>
    </div>

    <!-- Exam Details Table -->
     <!-- Questions Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Questions</h6>
    </div>
    <div class="card-body">
    <?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "students_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get question ID from URL
$question_id = $_GET['id'];

// Fetch question details
$sql = "SELECT * FROM questions WHERE id = $question_id";
$result = mysqli_query($conn, $sql);
$question = mysqli_fetch_assoc($result);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_question_text = $_POST['question'];
    $new_option_a = $_POST['option_a'];
    $new_option_b = $_POST['option_b'];
    $new_option_c = $_POST['option_c'];
    $new_option_d = $_POST['option_d'];
    $new_option_correct = $_POST['correct_option'];

    // Update question in the database
    $sql = "UPDATE questions SET question = '$new_question_text', option_a = '$new_option_a', option_b = '$new_option_b', option_c = '$new_option_c', option_d = '$new_option_d', correct_option = '$new_option_correct' WHERE id = $question_id";

    if (mysqli_query($conn, $sql)) {
        echo "Question updated successfully.";
        // Redirect back to the main page
        header("Location: your_main_page.php"); // Replace with your main page filename
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

   
        <form method="post" action="">
            <div class="form-group">
                <label for="question_text">Question:</label>
                <input type="text" class="form-control" id="question" name="question" value="<?php echo $question['question']; ?>" required>
            </div>
            <div class="form-group">
                <label for="question_text">Option:A</label>
                <input type="text" class="form-control" id="option_a" name="option_a" value="<?php echo $question['option_a']; ?>" required>
            </div>
            <div class="form-group">
                <label for="question_text">Option:B</label>
                <input type="text" class="form-control" id="option_b" name="option_b" value="<?php echo $question['option_b']; ?>" required>
            </div>
            <div class="form-group">
                <label for="question_text">Option:C</label>
                <input type="text" class="form-control" id="option_c" name="option_c" value="<?php echo $question['option_c']; ?>" required>
            </div>
            <div class="form-group">
                <label for="question_text">Option:D</label>
                <input type="text" class="form-control" id="option_d" name="option_d" value="<?php echo $question['option_d']; ?>" required>
            </div>
            <div class="form-group">
                <label for="correct_option" style="display: flex; align-items: center; ">Correct Answer: <p style="font-size: 1.4rem; color:crimson; margin: 4px; text-transform: uppercase; " ><?php echo $question['correct_option']; ?></p></label>
            </div>
            <select class="form-control" id="correct_option" name="correct_option"   required>
                <option value="A">Chose New Option A</option>
                <option value="B"> Chose New Option B</option>
                <option value="C">Chose New Option C</option>
                <option value="D">Chose New Option D</option>
            </select>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="your_main_page.php" class="btn btn-secondary">Cancel</a> <!-- Replace with your main page filename -->
        </form>
    

   
    </div>
</div> 
<!-- End of Questions Table -->
 <!-- Questions Table with Options and Correct Answer -->

<!-- End of Questions Table with Options -->


   
    <!--Arts students--->
  
    <!-- Display Exams for Arts Students -->
   
    <!-- End of Exam Details Table -->

</div>
<!-- /.container-fluid -->
 <!-- JavaScript for Confirm Delete -->
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this exam?");
}
</script>

<!-- End of Main Content -->

<!-- Footer -->
<?php include 'footer.php' ?>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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

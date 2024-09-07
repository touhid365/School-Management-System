<!-- Footer -->
<?php include 'header.php' ?>
<!-- End of Footer -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Exam</h1>
        <a href="exam_setting.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Exams</a>
    </div>

   

    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "students_db");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form is submitted
    if (isset($_POST['update'])) {
        $exam_id = $_POST['id'];
        $title = $_POST['title'];
        $exam_question = $_POST['total_question'];
        $exam_time = $_POST['total_time'];
        $exam_marks = $_POST['total_marks'];

        // Update query
        $sql = "UPDATE exams SET title='$title', total_time='$exam_time', total_marks ='$exam_marks', total_question='$exam_question' WHERE id=$exam_id";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Exam updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating exam: " . mysqli_error($conn) . "</div>";
        }
    }

    // Fetch the exam record to edit
    if (isset($_GET['id'])) {
        $exam_id = $_GET['id'];
        $sql = "SELECT * FROM exams WHERE id=$exam_id";
        $result = mysqli_query($conn, $sql);
        $exam = mysqli_fetch_assoc($result);
    }
    ?>

    <!-- Exam Edit Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Exams Details</h6>
        </div>
    <div class="card-body">
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $exam['id']; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" value="<?php echo $exam['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="exam_date">Questions:</label>
            <input type="text" class="form-control" name="total_question" value="<?php echo $exam['total_question']; ?>" required>
        </div>
        <div class="form-group">
            <label for="exam_date">Marks:</label>
            <input type="text" class="form-control" name="total_marks" value="<?php echo $exam['total_marks']; ?>" required>
        </div>
        <div class="form-group">
            <label for="exam_date">Times:</label>
            <input type="text" class="form-control" name="total_time" value="<?php echo $exam['total_time']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update Exam</button>
    </form>
    </div>
    </div>
    <!-- End of Exam Edit Form -->

</div>
<!-- /.container-fluid -->

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

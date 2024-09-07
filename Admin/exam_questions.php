<!-- Footer -->
<?php include 'header.php' ?>
<!-- End of Footer -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Exam Details</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Download Report</a>
    </div>

  
    <!-- Questions Table -->

  <!-- Questions Table for Science Students -->
  <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Questions List for Science Students</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableScience" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Exam Title</th>
                            <th>Question</th>
                            <th style="width:20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database connection
                        $conn = mysqli_connect("localhost", "root", "", "students_db");

                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Fetch questions for Science students
                        $sql = "SELECT questions.id as question_id, exams.title as exam_title, questions.question
                                FROM questions
                                JOIN exams ON questions.exam_id = exams.id 
                                WHERE exams.exam_type = 'Science'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>". $count++ ."</td>
                                        <td>" . $row['exam_title'] . "</td>
                                        <td>" . $row['question'] . "</td>
                                        <td style='width:20%;'><a href='edit_questions.php?id=" . $row['question_id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                            <a href='delete_question.php?id=" . $row['question_id'] . "' class='btn btn-sm btn-danger' onclick='return confirmDelete();'>Delete</a></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No questions found for Science students</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Questions Table for Arts Students -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Questions List for Arts Students</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableArts" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Exam Title</th>
                            <th>Question</th>
                            <th style="width:20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch questions for Arts students
                        $sql = "SELECT questions.id as question_id, exams.title as exam_title, questions.question
                                FROM questions
                                JOIN exams ON questions.exam_id = exams.id 
                                WHERE exams.exam_type = 'Arts'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>". $count++ ."</td>
                                        <td>" . $row['exam_title'] . "</td>
                                        <td>" . $row['question'] . "</td>
                                        <td style='width:20%;'><a href='edit_questions.php?id=" . $row['question_id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                            <a href='delete_question.php?id=" . $row['question_id'] . "' class='btn btn-sm btn-danger' onclick='return confirmDelete();'>Delete</a></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No questions found for Arts students</td></tr>";
                        }

                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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

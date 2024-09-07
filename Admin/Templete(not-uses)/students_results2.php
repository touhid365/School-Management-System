<?php include 'header.php' ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'students_db');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch distinct exam titles from the exams table
    $examQuery = "SELECT DISTINCT title FROM exams";
    $examResult = $conn->query($examQuery);

    if ($examResult) {
        while ($examRow = $examResult->fetch_assoc()) {
            $examTitle = $examRow['title'];
            
            // Display tables for Science and Arts separately under each exam title
            foreach (['Science', 'Arts'] as $stream) {
                ?>
                <!-- Students Table for Specific Exam and Stream -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo htmlspecialchars($stream); ?> Students List - Exam: <?php echo htmlspecialchars($examTitle); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Roll No</th>
                                        <th>Gender</th>
                                        <th>Score</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch students data by joining reg_students, results_tb, and exams tables for specific exam and stream
                                    $query = "SELECT reg_students.first_name, reg_students.roll_number, reg_students.gender, 
                                              results_tb.score, results_tb.percentage
                                              FROM reg_students
                                              INNER JOIN results_tb ON reg_students.id = results_tb.student_id
                                              INNER JOIN exams ON results_tb.exam_id = exams.id
                                              WHERE reg_students.stream = '$stream' AND exams.title = '$examTitle'
                                              GROUP BY reg_students.roll_number";

                                    $result = $conn->query($query);

                                    if ($result) {
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['roll_number']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['score']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['percentage']) . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No records found for $stream students for the exam titled '$examTitle'.</td></tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>Error: " . $conn->error . "</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    } else {
        echo "<p>Error fetching exam titles: " . $conn->error . "</p>";
    }

    // Close the database connection
    $conn->close();
    ?>

</div>
<!-- /.container-fluid -->

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

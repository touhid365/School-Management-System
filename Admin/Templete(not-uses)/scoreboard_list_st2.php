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
        ?>
        <!-- Sub-Header for Exam Titles -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Exam Titles</h6>
            </div>
            <div class="card-body">
                <div class="btn-group" role="group" aria-label="Exam Titles">
                    <?php
                    // Generate buttons for each exam title
                    while ($examRow = $examResult->fetch_assoc()) {
                        $examTitle = $examRow['title'];
                        echo "<button type='button' class='btn btn-secondary' onclick=\"showExamDetails('$examTitle')\">" . htmlspecialchars($examTitle) . "</button>";
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Scoreboard Section -->
    <div class="card shadow mb-4" id="scoreboard-section">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Top Performers Scoreboard</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Roll No</th>
                            <th>Stream</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch top performers by percentage
                        $scoreboardQuery = "SELECT reg_students.first_name, reg_students.roll_number, reg_students.stream, results_tb.percentage
                                            FROM reg_students
                                            INNER JOIN results_tb ON reg_students.id = results_tb.student_id
                                            ORDER BY results_tb.percentage DESC
                                            LIMIT 10"; // Limiting to top 10 performers

                        $scoreboardResult = $conn->query($scoreboardQuery);

                        if ($scoreboardResult) {
                            $rank = 1;
                            while ($row = $scoreboardResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $rank++ . "</td>";
                                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['roll_number']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['stream']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['percentage']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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

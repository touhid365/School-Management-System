<?php include 'header.php' ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> </a>
    </div>

    <!-- <div class="centers-content" style="text-align: center;">
        <h2> Hi <strong><?php echo $row['name']; ?>,</strong> Welcome to your Dashboard</h2>
       
        <p>🌸please complete your application fast.🌸</p>
        <a href="./student/index.php" target="_blank" class="btn btn-success">Complete Application <i class="fa fa-arrow-right"></i> </a>
    </div> -->
    <div class="centers-content" style="text-align: center;">
        <h2> Hi <strong><?php echo $row['name']; ?>,</strong> Welcome to your Dashboard</h2>
        
        <?php if ($row['is_verified']): ?>
            <!-- If the OTP is verified, show the complete application button -->
            <p>🌸 Please complete your application fast. 🌸</p>
            <a href="./student/index.php" target="_blank" class="btn btn-success">Complete Application <i class="fa fa-arrow-right"></i> </a>
        <?php else: ?>
            <!-- If the OTP is not verified, show the OTP input fields and buttons -->
            <p>Please enter the OTP sent to your registered mobile number:</p>
            
            <!-- <p><?php if (!empty($verificationMessage)) echo $verificationMessage; ?></p> -->
            <form method="POST" action="">
            <?php if (!empty($verifyMessage)) echo $verifyMessage; ?>
                <!-- 6 OTP Input Fields -->
                <?php for ($i = 1; $i <= 6; $i++): ?>
                    <input type="text"   name="otp[]" maxlength="1" size="1" style="width: 30px; text-align: center;" required>
                <?php endfor; ?>
                <br><br>
                <button type="submit" class="btn btn-primary">Verify</button>
                <a href="resend_otp.php" class="btn btn-warning">Resend OTP</a>
            </form>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include 'footer.php' ?>

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
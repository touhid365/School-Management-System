
<?php
session_start();
// Database connection parameters
$servername = "localhost"; // or your database server address
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "students_db"; // your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$reg_no =$_GET['reg_no'];

// Fetch data from the database

$sql = mysqli_query($conn, "SELECT * FROM  `students` WHERE registration_id = '$reg_no'");
    if(mysqli_num_rows($sql) > 0){
    $rows = mysqli_fetch_assoc($sql);
    }
 

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>
    <link rel="shortcut icon" href="../images/school_4130952.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
            line-height: 1.5;
            color: #333;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        /*----*/

        .header-section .logo {
          max-height: 80px;
          margin-bottom: 10px;
        }

        .header-section .additional-image { 
            position: absolute;
            bottom: 20px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            max-height: 60px; /* Adjust as needed */
            border-radius: 8px;
        }
        /*----*/
        .header-section {
            text-align: center;
            padding: 20px;
            background-color: #003366;
            color: #ffffff;
            border-radius: 8px;
            position: relative;
        }

        .header-section img {
            max-height: 80px;
            margin-bottom: 10px;
        }

        .sub-header {
            font-size: 1.1rem;
            font-weight: 300;
            color: #cbd1d8;
        }

        .header-main-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #ffffff;
        }

        .section {
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: #003366;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd1d8;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #e9ecef;
            color: #495057;
            font-weight: 500;
            transition: border-color 0.3s ease;
        }

        .form-control:disabled {
            background-color: #e9ecef;
            color: #6c757d;
        }

        .actions {
            text-align: center;
            margin-top: 30px;
        }

        .actions button {
            margin: 0 10px;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background-color: #003366;
            transition: background-color 0.3s ease;
        }

        .actions button:hover {
            background-color: #00509e;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .text-highlight {
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header Section -->
    <div class="header-section">
    <!-- Image (College Logo) -->
    <img src="../images/university.jpg" alt="Aliah University Logo" class="logo">

    <!-- College Name -->
    <h1 class="header-main-title">LearnDash Academy</h1>

    <!-- Approval Details -->
    <h2 class="sub-header">(A UGC, AICTE and NCTE Approved Autonomous Institution under the Government of India)</h2>

    <!-- Merit Rank Information -->
    <h3 class="sub-header text-highlight">[Application For Code IMITUG2406]</h3>

    <!-- Provisional Allotment List Title -->
    <h3 class="header-main-title">Application Details</h3>
    
    <!-- Additional Image Box -->
    <img src="./uploads/<?= $rows['profile_image'] ?>" alt="Additional Image" class="additional-image">
    </div>

    <!-- Students Details -->
    <div class="section">
        <h4 class="section-title">Students Details</h4>
        <div class="grid">
            <div>
                <label for="customerName" class="form-label">Name</label>
                <input type="text" class="form-control" id="customerName" value="<?= htmlspecialchars($rows['name'])?>" placeholder="Rocky Khan" disabled>
            </div>
            <div>
                <label for="email" class="form-label">Email ID</label>
                <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($rows['email'])?>" placeholder="rocky123@gmail.com" disabled>
            </div>
            <div>
                <label for="reg_no" class="form-label">Reg No</label>
                <input type="text" class="form-control" id="reg_no" value="<?= htmlspecialchars($rows['registration_id'])?>" placeholder="IMIT0347865GHQ80" disabled>
            </div>
            <div>
                <label for="contactNo" class="form-label">Contact No.</label>
                <input type="text" class="form-control" id="contactNo" value="<?= htmlspecialchars($rows['mobile_no'])?>" placeholder="+91 9011338899" disabled>
            </div>
            <div>
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="gender" value="<?= htmlspecialchars($rows['gender'])?>" placeholder="Male" disabled>
            </div>
            <div>
                <label for="fathersName" class="form-label">Fathers Name</label>
                <input type="text" class="form-control" id="fathersName" value="<?= htmlspecialchars($rows['father_name'])?>" placeholder="Aman Khan" disabled>
            </div>
            <div>
                <label for="stream" class="form-label">Stream</label>
                <input type="text" class="form-control" id="stream" value="<?= htmlspecialchars($rows['stream'])?>" placeholder="Science" disabled>
            </div>
            <div>
                <label for="Aadhaar_no" class="form-label">Aadhaar No</label>
                <input type="text" class="form-control" id="Aadhaar_no" value="<?= htmlspecialchars($rows['aadhaar_no'])?>" placeholder="7423xxxx4590" disabled>
            </div>
        </div>
    </div>

    <!-- Education Details -->
    <div class="section">
        <h4 class="section-title">Education Details</h4>
        <div class="grid">
            <div>
                <label for="10th_school" class="form-label">Class 10th School</label>
                <input type="text" class="form-control" id="10th_school" value="<?= htmlspecialchars($rows['class_ten'])?>" placeholder="Abc school" disabled>
            </div>
            <div>
                <label for="10th_board" class="form-label">10th Board</label>
                <input type="text" class="form-control" id="10th_board" value="<?= htmlspecialchars($rows['board_ten'])?>" placeholder="WBBSE" disabled>
            </div>
            <div>
                <label for="10th_percentage" class="form-label">10th Percentage%</label>
                <input type="text" class="form-control" id="10th_percentage" value="<?= htmlspecialchars($rows['percentage_ten'])?>" placeholder="94%" disabled>
            </div>
            <div>
                <label for="12th_school" class="form-label">Class 12th School</label>
                <input type="text" class="form-control" id="12th_school" value="<?= htmlspecialchars($rows['class_12th'])?>" placeholder="Abcd school" disabled>
            </div>
            <div>
                <label for="12th_board" class="form-label">12th Board</label>
                <input type="text" class="form-control" id="12th_board" value="<?= htmlspecialchars($rows['board_12th'])?>" placeholder="CBSE" disabled>
            </div>
            <div>
                <label for="12th_percentage" class="form-label">12th percentage%</label>
                <input type="text" class="form-control" id="12th_percentage" value="<?= htmlspecialchars($rows['percentage_12th'])?>" placeholder="96%" disabled>
            </div>
        </div>
    </div>

    <!-- Address Details -->
    <div class="section">
        <h4 class="section-title">Address Details</h4>
        <div class="grid">
            <div>
                <label for="Street" class="form-label">Street</label>
                <input type="text" class="form-control" id="Street" value="<?= htmlspecialchars($rows['address'])?>" placeholder="Newtown" disabled>
            </div>
            <div>
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" value="<?= htmlspecialchars($rows['state'])?>" placeholder="West Bengal" disabled>
            </div>
            <div>
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" value="<?= htmlspecialchars($rows['city'])?>" placeholder="Kolkata" disabled>
            </div>
            <div>
                <label for="post_office" class="form-label">Post Office</label>
                <input type="text" class="form-control" id="post_office" value="<?= htmlspecialchars($rows['post_office'])?>" placeholder="Balihara" disabled>
            </div>
            <div>
                <label for="zip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="zip" value="<?= htmlspecialchars($rows['zip'])?>" placeholder="733125" disabled>
            </div>
            <div>
                <label for="nation" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="nation" value="<?= htmlspecialchars($rows['nation'])?>" placeholder="India" disabled>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="section actions">
        <button class="btn btn-secondary">Open File</button>
        <button class="btn btn-primary">Print Application</button>
        <button class="btn btn-success">Download Application</button>
    </div>

    <div class="text-center mt-4">
        <p>Made with <span style="color: red;">♥</span> by <span class="text-highlight">LearnDash</span>.</p>
    </div>
</div>

</body>
</html>

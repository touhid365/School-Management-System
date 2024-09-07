
<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "students_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$common_id = '';
function generateId() {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 40);
}
$common_id = generateId();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $roll_number = mysqli_real_escape_string($conn, $_POST['roll_no']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT); // Hashing the password
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $stream = mysqli_real_escape_string($conn, $_POST['stream']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['m_status']);
    $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['add_city']);
    $state = mysqli_real_escape_string($conn, $_POST['add_state']);
    $zip = mysqli_real_escape_string($conn, $_POST['add_zip']);
    $post_office = mysqli_real_escape_string($conn, $_POST['add_postoffice']);

    // Check if user is already registered
    $check_user_sql = "SELECT * FROM reg_students WHERE email='$email' OR roll_number='$roll_number'";
    $result = $conn->query($check_user_sql);

    if ($result->num_rows > 0) {
        // User already registered
        $message = '
        <div class="alert alert-danger">
        User with this email or roll number is already registered.
        </div>
        ';
    } else {
        // Generate OTP
        $otp = rand(100000, 999999);

        // SQL query to insert data
        $sql = "INSERT INTO reg_students (email, roll_number, password, first_name, last_name, mobile_no, stream, gender, marital_status, nationality, address, city, state, zip, post_office, otp, is_verified)
        VALUES ('$email', '$roll_number', '$password', '$first_name', '$last_name', '$mobile_no', '$stream', '$gender', '$marital_status', '$nationality', '$address', '$city', '$state', '$zip', '$post_office', '$otp', 0)";
        //alert message send to admin
       

        if ($conn->query($sql) === TRUE) {
            // Send OTP to user's email
            $subject = "Your OTP Code";
            $message_body = "Your OTP for email verification is: $otp";
            $headers = "From: no-reply@yourdomain.com";

            if (mail($email, $subject, $message_body, $headers)) {
                // Redirect to OTP verification page
                header("Location: otp_verify.php?email=" . urlencode($email));
                exit();
            } else {
                $message = '
                <div class="alert alert-danger">
                Could not send OTP. Please try again.
                </div>
                ';
            }
        } else {
            $message = '
            <div class="alert alert-danger">
            There was an error in Registration: ' . $conn->error . '
            </div>
            ';
        }
    }
}

// Close the connection
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration </title>

     <!---css of bootstrap-->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <!----js of bootstrap-->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <!--------fontawsome-cdn-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!------fontawsome css-->
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!----css of body-->
 <link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="css/dropdown.css">
 <link rel="stylesheet" href="css/captcha.css">
<!---------others links-------->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<!--<link
  href="https://fonts.googleapis.com/css2?family=Foldit:wght@100;200;300;400;500;600;700;800;900&display=swap"
  rel="stylesheet"
/>---->
<link
href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone"
rel="stylesheet"
/>
 <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
 <!---------others link-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 <link rel="icon"  href="images/mortarboard.png" style="height: 90px; width: 90px; border-radius: .5rem; background-color:#ffffff;" type="image/png/gif">

 </head>
 <style>
    .box
  {
   width:100%;
   margin:0 auto;
  }
  .form-register
  {
   width: 405px;
  }
  .tab-content
  {
   width: 400px;
   margin-top: 16px;
  }
  
  .active_tab1
  {
   background-color: #002D62 !important;
   color: #ffffff !important;

   
   font-weight: 600;
  }
  .active_tab1:hover
  {
    color: #002D62 !important;
    background: #d7d7d7 !important;
  }
  .inactive_tab1
  {
   background-color: #d7d7d7 !important;
   color: #002D62 !important;
   
  }
  label
  {
    color: #002D62;
  }
  .form-control::placeholder
  
  {
    color: #083f7e !important;
    font-weight: 600;
    font-size: 14px;
    
  }
  canvas {
      max-width: 100%;
    }

  .has-error
  {
   border-color:#cc0000;
   background-color:#ff9999;
  }
  @media (max-width:900px) {
    .box
    {
        width: auto;
    }
    .form-register
    {
        width: auto;
    }
    .tab-content
    {
        width: auto;
    }
    .nav-tabs
  {
    font-size: 12px;
    
  }
  .nav-tabs li
  {
    border-radius: 5px;
  }
  }
 </style>
</head>
<body style="background: #dae8f6; " >

    <br />
    <div class="container box" style=" border-radius: .5rem;  background: #ffff;">
     
      <h2 align="center" style="color: #03264f; font-weight: 600; font-size: 18px;">Create your account</h2>
      <!-- <a class="navbar " style="color:#fb792b; font-weight: 600; font-size: 2rem; margin-right: -0rem; float: right;" href="student_login.html"> <i class="fa fa-lock"></i>Login</a>  -->
      <p class="lead" style="font-size: 1.5rem;font-weight: 600; margin-top: 50px; margin-bottom: -30px; color:#cc0000;">Please use a valid E-Mail and mobile number in registration.</p>
    
     <br>
    
     
     
     <br />
     
     <?php echo $message; ?>
     <form method="post" id="register_form" class="form-register" >
      <ul class="nav nav-tabs" style=" gap: 5px; " >
       <li class="nav-item">
        <a class="nav-link active_tab1" style="border:1px solid #ccc ; " id="list_login_details">Login Details</a>
       </li>
       <li class="nav-item">
        <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc; ">Personal Details</a>
       </li>
       <li class="nav-item">
        <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Address Details</a>
       </li>
      </ul>
      <div class="tab-content" >
       <div class="tab-pane active" id="login_details">
        <div class="panel panel-default">
         <div class="panel-heading" style="color: #03264f;">Login Details</div>
         <div class="panel-body">
          <div class="form-group">
            <input type="text" name="email" id="email" style="height: 40px;" placeholder="Enter your Email"  class="form-control" />
            <span id="error_email" class="text-danger"></span>
          </div>
          <div class="form-group">
            <input type="text" name="roll_no" id="roll_no" style="height: 40px;" placeholder="Enter your Roll No."  class="form-control" />
            <span id="error_roll_no" class="text-danger"></span>
          </div>
          <div class="form-group">
             <input type="password" name="password" id="password" placeholder=" Enter Password" style="height: 40px;"  class="form-control" />
             <span id="error_password" class="text-danger"></span>
          </div>
        
          <br />
          <div align="center">
           <button type="button" style="outline: none; color: #ffffff; background: #fb792b;" name="btn_login_details" id="btn_login_details" class="btn  btn-lg">Next <i class="fa fa-arrow-right"></i></button>
          </div>
          <br />
          <p><a href="student_login.php?login=<?= isset($common_id) ? $common_id : '' ?>">already registerd login now</a></p>
         </div>
        </div>
       </div>
       <div class="tab-pane fade" id="personal_details">
        <div class="panel panel-default">
         <div class="panel-heading">Fill Personal Details</div>
         <div class="panel-body">
          <div class="form-group">
           <input type="text" name="first_name" id="first_name" placeholder="First Name" style="height: 40px;" class="form-control" />
           <span id="error_first_name" class="text-danger"></span>
          </div>
          <div class="form-group">
           <input type="text" name="last_name" id="last_name" placeholder="Last Name" style="height: 40px;" class="form-control" />
           <span id="error_last_name" class="text-danger"></span>
          </div>
         
          <div class="form-group">
            <select class=" form-control" name="gender" id="gender" style="height: 40px; color: #05346a; font-weight: 600;" required >
                <option value="" selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            <span id="error_gender" class="text-danger"></span>
           </div>
          
          <div class="form-group">
            <select class=" form-control" name="stream" id="Occupation" style="height: 40px; color: #05346a; font-weight: 600;" required >
                <option value="" selected disabled>Select Stream</option>
                <option value="Science">Science</option>
                <option value="Arts">Arts</option>
                
              </select>
            <span id="error_occupation" class="text-danger"></span>
           </div>
           
           <div class="form-group">
            <select class=" form-control " name="m_status" id="m_status" style="height: 40px; color: #05346a; font-weight: 600;" required >
                <option value="" selected>Select Maritial Status</option>
                <option value="Married">Married</option>
                <option value="Unmarried">Unmarried</option>
              </select>
            <span id="error_m_status" class="text-danger"></span>
           </div>
           <!-- <div class="form-group"> --
            
            <input type="text" name="email" id="email" placeholder="Email" style="height: 40px;" class="form-control" />
            <span id="error_email" class="text-danger"></span>
           </div>-->
           <div class="form-group">
            
            <input type="text" name="mobile_no" id="mobile_no" placeholder="Mobile No" style="height: 40px;" class="form-control" />
            <span id="error_mobile_no" class="text-danger"></span>
           </div>
           <div class="form-group">
            
            <select class=" form-control " name="nationality" id="nationality" style="height: 40px; color: #05346a; font-weight: 600;" required>
                <option value="" selected>select Nationality</option>
                <option value="India" >India</option>
                <option value="UK" >Other</option>
                
              </select>
            <span id="error_nationality" class="text-danger"></span>
           </div>
          <br />
          <div align="center">
           <button type="button" style=" background: #d7d7d7; border-color:1px solid #fb792b; "  name="previous_btn_personal_details"  id="previous_btn_personal_details" class="btn  btn-lg">Previous</button>
           <button type="button" style="outline: none;border-color: #fb792b; color: #ffffff; background: #fb792b;" name="btn_personal_details" id="btn_personal_details" class="btn btn-primary btn-lg">Next<i class="fa fa-arrow-right"></i></button>
          </div>
          <br />
          <p><a href="student_login.php?login=<?= isset($common_id) ? $common_id : '' ?>">already registerd login now</a></p>
         </div>
        </div>
       </div>
       <div class="tab-pane fade" id="contact_details">
        <div class="panel panel-default">
         <div class="panel-heading">Fill Address </div>
         <div class="panel-body">
          <div class="form-group">
            <input type="text" class="form-control" style="height: 40px;" id="address" name="address" placeholder="Flat/House/Street No.">
            <span id="error_address" class="text-danger"></span>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" style="height: 40px;" id="add_city" name="add_city" name="address" placeholder="City" required>
            <span id="error_add_city" class="text-danger"></span>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" style="height: 40px;" id="add_state" name="add_state" placeholder="State" required>
            <div class="invalid-feedback">
              Please provide a valid State.
            </div>
            <span id="error_add_state" class="text-danger"></span>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" style="height: 40px;" id="add_zip" name="add_zip" placeholder="Pin Code" required>
            <div class="invalid-feedback">
              Please provide a valid Zip.
            </div>
            <span id="error_add_zip" class="text-danger"></span>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" style="height: 40px;" id="add_postoffice" name="add_postoffice" placeholder="Post Office" required>
            <div class="invalid-feedback">
              Please provide a valid Post office.
            </div>
            <span id="error_add_postoffice" class="text-danger"></span>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="gridCheck" style="background: #07366c; margin-left: -15px;" id="gridCheck">
              <span id="error_gridCheck" class="text-danger"></span>
              <label class="form-check-label" for="gridCheck">
                I have read and agree with the Terms and Conditions and also agree to receive promotional emails/SMS/WhatsApp/Alerts/offers/announcements from LearnDash & associated partners.
              </label>
            </div>
          </div>
          <div class="mb-3 d-flex align-items-center">
            <canvas id="captchaCanvas" width="150" height="50"></canvas>
            <button type="button" class="btn btn-secondary" id="refresh-captcha">
                <i class="fa fa-refresh"></i>
            </button>
        </div>
        <div class="mb-3">
            <label for="captcha-input" class="form-label">Enter Captcha</label>
            <input type="text" class="form-control" id="captchaInput" required>
            <span id="error_captcha" class="text-danger"></span>
        </div>
        
           
          <br />
          <div align="center">
           
           <button type="button"name=" previous_btn_contact_details" id="previous_btn_contact_details" style="background: #d7d7d7; border:1px solid #fb792b;" class="btn btn-lg">previes</button>
           <button type="button" style="outline: none; border: 1px solid rgb(194, 117, 28); background-color: #03264f; color: #ffffff;" name="btn_contact_details" id="btn_contact_details" class="btn  btn-lg" >Register</button>
          </div>
          <br />
          <p><a href="student_login.php?login=<?= isset($common_id) ? $common_id : '' ?>">already registerd login now</a></p>
         </div>
        </div>
       </div>
      </div>
     </form>
    </div>
   <script src="js/form.js"></script>
   <!-- <script src="js/captcha.js"></script> -->
   <script src="js/dropdown.js"></script>
   <!-- <script src="js/captcha.js"></script> -->
   

</body>
</html>
<?php 
$common_id = '';
function generateId() {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 40);
}
$common_id = generateId();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!---fontawsome fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="images/mortarboard.png" style="width: 100%; height: 100%; " type="image/jpeg">

    <!-- <link rel="icon" href="i" sizes="500x500" type="image/png"> -->

    


    
    <style>
        .contaner-cards
        {
            display: grid;
            grid-template-columns: repeat(2,1fr);
           margin-left: 25%;
           width: 50%;
           padding-top: 18px;
           
        }
        /* .image-container 
        {
            background:#e1dada;
           
         } */
        .card-text
        {
            color: #777;
        }
        .card-title
        {
          color: coral;
        }
        /*-----media----*/
        @media (max-width:900px) {

         .contaner-cards
        {
            grid-template-columns: repeat(1,1fr);
            width: auto;
            margin-left: 8px;
        }
        }
        .navbar
        {
          background: #fef5f5;
        }
    </style>

    <title>Home | School</title>
  </head>
  <body>
    <!--------navbar start---------->
    <!-- Image and text -->
<nav class="navbar navbar-light ">
    <a class="navbar-brand" href="#">
      <img src="images/mortarboard" width="30" height="30" class="d-inline-block align-top" alt="">
      Learn<span style="color: coral;font-weight: 600; ">Dash</span>Academy 
    </a>
  </nav>
    <!--------navbar end---------->
    <!----------home cards--------->
    <div class="image-container">
    <div class="contaner-cards">
        <div class="card border-primary  mb-3" style="max-width: 18rem; cursor: pointer;">
            <!-- <div class="card-header">Registered Student</div> -->
            <div class="card-body text-primary">
              <h5 class="card-title" ><i class="fa-solid fa-user"></i> Registered Student</h5>
              <p class="card-text">Access your courses, grades, and resources with our secure student login.</p>
              <a href="student_login.php?login=<?= isset($common_id) ? $common_id : '' ?>" target="_blank"  class="btn btn-outline-primary">Click here <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="card border-info  mb-3" style="max-width: 18rem;  cursor: pointer;">
            <!-- <div class="card-header"><i class="fa-solid fa-user-circle"></i> Online Application for Admisson</div> -->
            <div class="card-body text-info">
              <h5 class="card-title" ><i class="fa-solid fa-user-circle"></i> Online Application for Admisson</h5>
              <p class="card-text">Apply Online: Start Your Academic Journey Today!. </p>
              <a href="new_student_login.php?login=<?= isset($common_id) ? $common_id : '' ?>" target="_blank" class="btn btn-outline-info">Click here <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="card border-success  mb-3" style="max-width: 18rem;  cursor: pointer;">
            <!-- <div class="card-header">Teacher's Login</div> -->
            <div class="card-body text-success">
              <h5 class="card-title"><i class="fa-solid fa-chalkboard-user"></i> Teacher's Login</h5>
              <p class="card-text">Efficiently manage classes, grades, and communications with our secure portal.</p>
              <a href="teachers_login.php?login=<?= isset($common_id) ? $common_id : '' ?>" target="_blank" class="btn btn-outline-success">Click here <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="card border-danger mb-3"  style="max-width: 18rem;  cursor: pointer;">
            <!-- <div class="card-header">Admin Login</div> -->
            <div class="card-body text-danger">
              <h5 class="card-title"><i class="fa-solid fa-user-lock"></i> Admin Login</h5>
              <p class="card-text">Securely manage student accounts and oversee academic activities efficiently.</p>
              <a href="admin_login.php?login=<?= isset($common_id) ? $common_id : '' ?>" target="_blank"  class="btn btn-outline-danger">Click here <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
    </div>
  </div>
      <!-------home cards end-->
      <!-------footer start---->
      <!-- Image and text -->
    <nav class="navbar navbar-light ">
      <a class="navbar-brand" href="#" style="color: #666666;">
        <!-- <img src="images/university.jpg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
        <i class="fa-solid fa-copyright" style="color: coral;"></i> 2024 LearnDash.
      </a>
    </nav>
    <!------footer end-------->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
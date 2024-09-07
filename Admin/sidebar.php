
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin <sup></sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Main
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-user"></i>
        <span>Profile</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Profile:</h6>
            <a class="collapse-item" href="view_profile.php">Profile</a>
            <a class="collapse-item" href="edit_profile.php">Edit Profile</a>
            
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Teacher</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Teacher:</h6>
            <a class="collapse-item" href="add_teacher.php">Add Teachers</a>
            
            <!-- <a class="collapse-item" href="result.html">View Result</a>
            <a class="collapse-item" href="scoreboard.html">Scoreboard</a> -->
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents"
        aria-expanded="true" aria-controls="collapseStudents">
        <i class="fas fa-user-circle"></i>
        <span>Registerd Students</span>
    </a>
    <div id="collapseStudents" class="collapse" aria-labelledby="headingStudents"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Registerd Students:</h6>
            <a class="collapse-item" href="Students_lists_tb.php">List of Students</a>
            <a class="collapse-item" href="students_lists_result.php">Exam Result-1</a>
            <!-- <a class="collapse-item" href="students_results2.php">Exam Result-2</a>
            <a class="collapse-item" href="students_results3.php">Exam Result-3</a> -->
            <!-- <a class="collapse-item" href="students_results4.php">Exam Result-4</a> -->
            <a class="collapse-item" href="students_results-4.php">Exam Result-2</a>
            <!-- <a class="collapse-item" href="scoreboard_list_st.php">Scoreboard-1</a>
            <a class="collapse-item" href="scoreboard_list_st2.php">Scoreboard-2</a> -->
            <a class="collapse-item" href="scoreboard_students3.php">Scoreboard-1</a>
            <a class="collapse-item" href="scoreboard_students_table.php">Scoreboard-2</a>
        </div>
    </div>
</li> 



<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-users"></i>
        <span>New Students</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">New Students:</h6>
            <a class="collapse-item" href="new_application.php">Application's list</a>
            <!-- <a class="collapse-item" href="new_admit_card.php">Admit card</a> -->
            <a class="collapse-item" href="new_result.php">Students Result</a>
            
        </div>
    </div>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>
 <!--Nav Item - Utilities Collapse Menu-->
 <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExams"
        aria-expanded="true" aria-controls="collapseExams">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Exams Setting</span>
    </a>
    <div id="collapseExams" class="collapse" aria-labelledby="headingExams"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Exams Setting:</h6>
            <a class="collapse-item" href="exam_setting.php">Exam Name</a>
            
            <a class="collapse-item" href="exam_questions.php">Exam Question</a> 
           <!--- <a class="collapse-item" href="scoreboard.html">Scoreboard</a>  -->
        </div>
    </div>
</li> 

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fas fa-bell fa-fw"></i>
        <span>Notification</span></a>
</li>

<!-- Nav Item - Tables --
<li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li>-->

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-1" src="../images/education.png" alt="...">
    <p class="text-center mb-2"><strong></strong></p>
   
</div>

</ul>
<?php

session_start();

$server = "localhost";
$username = "root";
$password = "";
$db_name = "pracEntranceExam";

$conn = mysqli_connect($server, $username, $password, $db_name);

if(empty($_SESSION['logged'])){
    header("location:index.php");
}

$studentName = $_SESSION["logged"];

$getStudent = "SELECT * FROM Student_Accounts WHERE ReferenceNo = '$studentName'";
$getStudentrun = mysqli_query($conn, $getStudent);
$getStudentrow = mysqli_fetch_assoc($getStudentrun);

$courseDate = "SELECT ExamDate, ScoreDate FROM Courses WHERE Course_ID = (SELECT Course_ID FROM Student_Accounts WHERE ReferenceNo = '$studentName')";
$courseDaterun = mysqli_query($conn, $courseDate);
$courseDaterow = mysqli_fetch_assoc($courseDaterun);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="studentdashboard.css">
</head>
<body>
    <div class="nav-bar">
        <div class="row">
            <div class="col-sm-12">
                <div class="left">
                <div class="nav-square"><a href="#"><img src="images/Layout/lines.png"></a></div>
                <a href="studentdashboard.php"><img src="IMAGES/Layout/logo3.png"></a>
                </div>
                <div class="nav-log-off"><a href="logout.php"><img src="images/Layout/power-off.png"></a></div>
            </div>
        </div>
    </div>
    <div class="main-content">
    <div class="row mainrow">
        <div class="col-sm-2">
            <h6>AVAILABLE EXAMS</h6>
            <?php
            $currentDate = date("Y-m-d");
            if($currentDate != $courseDaterow['ExamDate']){
                echo "<a a href='#' onclick='alert(\"Exam Not Yet Available\")'>";
                    echo "<div class='side-nav-btn'>";
                        echo "<img src='images/Layout/user.png' alt='User Icon'> TAKE EXAM";
                    echo "</div>";
                echo "</a>";
            }
            elseif($currentDate == $courseDaterow['ExamDate']){
                echo "<a href='#' onclick=\"confirmation()\">";
                echo "<div class='side-nav-btn'>";
                echo "<img src='images/Layout/user.png' alt='User Icon'> TAKE EXAM";
                echo "</div>";
                echo "</a>";
            }
            ?>
            <hr>
            <h6>TAKEN EXAMS</h6>
            <?php
            $currentDate = date("Y-m-d");
            if($currentDate != $courseDaterow['ScoreDate']){
                echo "<a a href='#' onclick='alert(\"Results Not Available Yet\")'>";
                    echo "<div class='side-nav-btn'>";
                        echo "<img src='images/Layout/exam.png' alt='User Icon'> EXAM RESULT";
                    echo "</div>";
                echo "</a>";
            }
            elseif($currentDate == $courseDaterow['ScoreDate']){
                echo "<a href='#' onclick=\"scorechecker()\">";
                echo "<div class='side-nav-btn'>";
                echo "<img src='images/Layout/exam.png' alt='User Icon'> EXAM RESULT";
                echo "</div>";
                echo "</a>";
            }
            ?>
        </div>

        <div class="col-sm-10">
    <div class="dashboard">
        <div class="row">
            <div class="col-sm-12 user-details">
                <img src="images/Layout/logo2.png" alt="LOGO" class="dashboard-image">
                <div class="user-names">
                    <div class="user-text"><?php echo "Hi! " . $getStudentrow['FirstName'] . " " . $getStudentrow['LastName'];?></div>
                    <div class="active-text">ALWAYS STAY UPDATED IN YOUR PORTAL</div>
                </div>
            </div>
        </div>

    <div class="row align-left">
    <div class="small-box">
        <div class="text-container">
            <img src="calendar.png" alt="Academic Year Icon" class="icon">
            <div class="text-content">
                <div class="hello-text" style="font-size: 25px;"> 2023  - 2024 </div>
                <div class="calendar-text">ACADEMIC YEAR</div>
            </div>
        </div>
    </div>

    <div class="small-box exam-status">
        <div class="text-container">
            <img src="edit.png" alt="Edit Icon" class="icon">
            <div class="text-content">
                <div class="exam-status-text" style="font-size: 25px;"> 3/5 </div>
                <div class="number-text">EXAM STATUS</div>
            </div>
        </div>
    </div>
    </div>

</div>
        </div>

            </div>
        </div>
    </div>
    <script src="datechecker.js"></script>
</body>
</html>
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

$getExams = "SELECT ExamName FROM Exam INNER JOIN Student_Accounts ON Exam.Course_ID = Student_Accounts.Course_ID WHERE Exam.Course_ID = '$studentName'";
$getExamsrun = mysqli_query($conn, $getExams);

$getStudent = "SELECT * FROM Student_Accounts WHERE ReferenceNo = '$studentName'";
$getStudentrun = mysqli_query($conn, $getStudent);
$getStudentrow = mysqli_fetch_assoc($getStudentrun);

$studentCourse = $getStudentrow['Course_ID'];

$getExam = "SELECT * FROM Exam WHERE Course_ID = '$studentCourse' AND Exam_ID NOT IN (SELECT Exam_ID FROM Student_Result WHERE ReferenceNo = '$studentName') LIMIT 1";

$getExamrun = mysqli_query($conn, $getExam);
$getExamrow = mysqli_fetch_assoc($getExamrun);

if (!$getExamrow) {
    header("location:exams.php");
}

$examName = $getExamrow['ExamName'];
$examId = $getExamrow['Exam_ID'];
$_SESSION['examname'] = $examName;
$_SESSION['examid'] = $examId;

$getQuestions = "SELECT * FROM Questions WHERE ExamName = '$examName'";
$getQuestionsrun = mysqli_query($conn, $getQuestions);

$getTimer = "SELECT * FROM Exam WHERE ExamName = '$examName'";
$getTimerrun = mysqli_query($conn, $getExam);
$getTimerrow = mysqli_fetch_assoc($getTimerrun);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="studentdashboard.css">
    <link rel="stylesheet" href="exam-taking.css">
</head>
<body>
    <div class="nav-bar">
        <div class="row no-gutters">
            <div class="col-sm-12">
                <div class="left">
                <div class="nav-square"><a href="#"><img src="images/Layout/lines.png"></a></div>
                <a href="#"><img src="images/Layout/logo.png"></a>
                </div>
                <div class="nav-log-off"><a href="#"><img src="images/Layout/power-off.png"></a></div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="row mainrow">
            <div class="col-sm-2">
                <h6>STUDENTS</h6>
                <a href="#"><div class="side-nav-btn">TAKE EXAM</div></a>
                <hr>
                <h6>REPORTS</h6>
                <a href="#"><div class="side-nav-btn">RESULTS</div></a>
            </div>
            <div class="col-sm-10 containers">
                <div class="exam-container">
                    <div class="row exam">
                        <div class="col-sm-12 exam-details">
                            <div class="exam-name-desc">
                                <p><?php echo "<strong>{$getTimerrow['ExamName']}</strong>"; ?></p>
                                <p><?php echo "{$getTimerrow['Description']}"; ?></p>
                            </div>
                            <div class="timer-sec">
                                <p>REMAINING TIME:</p>
                                <div class="timer">
                                    <span id="minutes"><?php echo $getTimerrow['Timer']; ?></span>
                                    <span>:</span>
                                    <span id="seconds">00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 pages">
                            <div class="page-number">-----</div>
                        </div>
                    </div>
                    <div class="row questions">
                        <form method="POST" id="submit-exam" action="submit-exam.php">
                        <?php
                            $questionnum = 1;
                            while($getQuestionsrow = mysqli_fetch_assoc($getQuestionsrun)){
                                $questionid = $getQuestionsrow['Question_ID'];
                                echo "<div class='col-sm-12 exam-questions'>";
                                echo "<div class='question-desc'>";
                                    echo "<p><strong>{$questionnum}: {$getQuestionsrow['QuestionName']}</strong></p>";
                                echo "</div>";
                                echo "<div class='answers-container'>";
                                    echo "<div class='answers-align'>";
                                        echo "<div class='answers'><div style='border-right:1px solid;'><input type='radio' name='answer[$questionid]' value='{$getQuestionsrow['Answer1']}'></div><p>{$getQuestionsrow['Answer1']}</p></div>";
                                        echo "<div class='answers'><div style='border-right:1px solid;'><input type='radio' name='answer[$questionid]' value='{$getQuestionsrow['Answer2']}'></div><p>{$getQuestionsrow['Answer2']}</p></div>";
                                        echo "<div class='answers'><div style='border-right:1px solid;'><input type='radio' name='answer[$questionid]' value='{$getQuestionsrow['Answer3']}'></div><p>{$getQuestionsrow['Answer3']}</p></div>";
                                        echo "<div class='answers'><div style='border-right:1px solid;'><input type='radio' name='answer[$questionid]' value='{$getQuestionsrow['Answer4']}'></div><p>{$getQuestionsrow['Answer4']}</p></div>";
                                    echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                $questionnum++;
                            }
                            
                        ?>
                        <div class="submit-btn"><button type="submit">Submit Answer</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="timer.js"></script>
</body>
</html>
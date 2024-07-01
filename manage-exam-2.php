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

$examid = $_SESSION['examid'];

$tableexam = "SELECT * FROM Exam INNER JOIN Courses ON Exam.Course_ID = Courses.Course_ID INNER JOIN Category ON Category.Category_ID = Exam.Category_ID WHERE Exam.Exam_ID = '$examid'";
$tableexamrun = mysqli_query($conn, $tableexam);
$tableexamrow = mysqli_fetch_assoc($tableexamrun);

$tablequestion = "SELECT * FROM Questions INNER JOIN Exam ON Questions.ExamName = Exam.ExamName WHERE Exam.Exam_ID = '$examid'";
$tablequestionrun = mysqli_query($conn, $tablequestion);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="create-exam.css">
    <link rel="stylesheet" href="table-design.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/Layout/logo1.png"/>
</head>
<body>
    <div class="nav-bar">
        <div class="row no-gutters">
            <div class="col-sm-12">
                <div class="left">
                <div class="nav-square"><a href="#"><img src="images/Layout/lines.png"></a></div>
                <a href="#"><img src="images/Layout/logo.png"></a>
                </div>
                <div class="nav-log-off"><a href="logout.php"><img src="images/Layout/power-off.png"></a></div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="row mainrow">
            <div class="col-sm-2">
                <h6>STUDENTS</h6>
                <a href="manage-student.php"><div class="side-nav-btn">MANAGE STUDENTS</div></a>
                <hr>
                <h6>EXAMS</h6>
                <a href="manage-exam.php"><div class="side-nav-btn">MANAGE EXAMS</div></a>
                <hr>
                <h6>REPORTS</h6>
                <div class="side-nav-btn">EXAM REPORTS</div><br>
            </div>
            <div class="col-sm-10">
                <div class="page-title">
                    <h1>EXAM DETAILS</h1>
                </div>
                <div class="content-table">
                    <div class="content">
                        <h2>Exam Information</h2>
                        <div class="exam-details">
                            <div class="exam-info">
                                <label for="exam-name">Exam Name:</label>
                                <input type="text" id="exam-name" value = "<?php echo $tableexamrow['ExamName']?>" disabled>
        
                                <label for="exam-time">Time Limit:</label>
                                <input type="text" id="exam-time" value = "<?php echo $tableexamrow['Timer']?>" disabled>
        
                                <label for="category">Category:</label>
                                <input type="text" id="category" value = "<?php echo $tableexamrow['CategoryName']?>" disabled>
        
                                <label for="exam-date">Exam Date:</label>
                                <input type="date" id="exam-date" value = "<?php echo $tableexamrow['ExamDate']?>" disabled>
        
                                <label for="description">Description:</label>
                                <textarea id="description" disabled><?php echo $tableexamrow['Description']?></textarea>
                            </div>
                            <div class="questions">
                                <?php 
                                while($tablequestionrow = mysqli_fetch_assoc($tablequestionrun)){
                                    $ref = $tablequestionrow['Question_ID'];
                                    echo 
                                    "
                                    <div class='question-item'>
                                        <p>".$tablequestionrow['QuestionName']."</p>
                                        <div class='answers'>
                                            <div class='answers-design'>
                                                <p> A: ".$tablequestionrow['Answer1']."</p>
                                                <p> B: ".$tablequestionrow['Answer2']."</p>
                                                <p> C: ".$tablequestionrow['Answer3']."</p>
                                                <p> D: ".$tablequestionrow['Answer4']."</p>
                                                <p>Correct Answer </p>
                                                <p><strong>".$tablequestionrow['CorrectAnswer']."</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                }

                                ?>
                                
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="manage-exam.php"><button class="go-back-btn">GO BACK</button></a>
                        </div>
                        <div class="buttons">
                            <?php echo"<form method='POST' action='remove-exam.php'><input type='text' name='remove' hidden value='$examid'><button class='go-back-btn' type='submit'style='background-color:#EC7B7B;'>REMOVE EXAM</button></a></form>";?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
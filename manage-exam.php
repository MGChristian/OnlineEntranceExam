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

if(!empty($_SESSION['examid'])){
    unset($_SESSION['examid']);
}

$tableexam = "SELECT * FROM Exam INNER JOIN Courses ON Exam.Course_ID = Courses.Course_ID INNER JOIN Category ON Category.Category_ID = Exam.Category_ID ORDER BY Courses.CourseName DESC";
$tableexamrun = mysqli_query($conn, $tableexam);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="table-design.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/Layout/logo1.png"/>
</head>
<body>
    <div class="nav-bar">
        <div class="row no-gutters">
            <div class="col-sm-12">
                <div class="left">
                <div class="nav-square"><a href="#"><img src="images/Layout/lines.png"></a></div>
                <a href="Dashboard.php"><img src="images/Layout/logo.png"></a>
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
                <a href="exam-report.php"><div class="side-nav-btn">EXAM REPORTS</div><br></a>
            </div>
            <div class="col-sm-10">
                <div class="page-title">
                    <h1>MANAGE EXAMS</h1>
                </div>
                <div class="content-table">
                    <div class="table-container">
                    <table>
                        <tr style="color:#6C99EE;">
                            <th colspan="5">EXAM LIST</th>
                            <th colspan="1"><a href="create-exam.php"><button class="add-exam" type="button">+ADD EXAM</button></a></th>
                        </tr>
                        <tr style="background-color:#6C99EE; color:white;">
                            <th>EXAM NAME</th>
                            <th>COURSE</th>
                            <th>CATEGORY</th>
                            <th>TIME LIMIT</th>
                            <th>SCHEDULE</th>
                            <th></th>
                        </tr>
                        <?php 
                            while($tableexamrow = mysqli_fetch_assoc($tableexamrun)){
                                $ref = $tableexamrow['Exam_ID'];
                                echo"<tr>";
                                        
                                echo"<td>{$tableexamrow['ExamName']}</td>";
                                echo"<td>{$tableexamrow['CourseName']}</td>";
                                echo"<td>{$tableexamrow['CategoryName']}</td>";
                                echo"<td>{$tableexamrow['Timer']}</td>";
                                echo"<td>{$tableexamrow['ExamDate']}</td>";
                                echo"<td class='table-btn'><form method='POST' action='view.php'><input type='text' name='manexam' hidden value='$ref'><button type='submit' class='views'>VIEW</button></form></td>";
                                echo"</tr>";
                                
                            }
                        ?>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
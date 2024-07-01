<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="table-design.css">
    <link rel="stylesheet" href="exam-report.css">
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
                    <h1>EXAM REPORTS</h1>
                </div>
                <div class="exam-reporting">
                    <a href="exam-report-clicked.php">
                        <div class="exam-category">
                            <p>Category || Exam Name</p>
                        </div>
                    </a>
                    <a href="exam-report-clicked.php">
                        <div class="exam-category">
                            <p>Category || Exam Name</p>
                        </div>
                    </a>
                    <a href="exam-report-clicked.php">
                        <div class="exam-category">
                            <p>Category || Exam Name</p>
                        </div>
                    </a>
                    <a href="exam-report-clicked.php">
                        <div class="exam-category">
                            <p>Category || Exam Name</p>
                        </div>
                    </a>
                    <a href="exam-report-clicked.php">
                        <div class="exam-category">
                            <p>Category || Exam Name</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
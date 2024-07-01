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

if(isset($_POST['exam-name']) && isset($_POST['timer']) && isset($_POST['categories']) && isset($_POST['courses']) && isset($_POST['date']) && isset($_POST['scoredate'])  && isset($_POST['description'])){
    $_SESSION['examname'] = $_POST['exam-name'];
    $examname = $_SESSION['examname'];
    $timer = $_POST['timer'];
    $category = $_POST['categories'];
    $score = $_POST['scoredate'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    foreach ($_POST['courses'] as $course_id){
        $insertexam = "INSERT INTO Exam(`Course_ID`, `Category_ID`, `ExamName`, `Timer`, `Description`) VALUES('$course_id', '$category', '$examname', '$timer', '$description')";
        mysqli_query($conn, $insertexam);
        
        $insertdate = "UPDATE Courses SET ExamDate = '$date' WHERE Course_ID = '$course_id'";
        mysqli_query($conn, $insertdate);

        $insertscoredate = "UPDATE Courses SET ScoreDate = '$score' WHERE Course_ID = '$course_id'";
        mysqli_query($conn, $insertscoredate);
    }
    header("location:create-questions.php"); // Redirect after successful insertion
    exit;
}

else{
    header("location:create-exam.php");
    exit;
}

if(isset($_POST['finish'])){
    echo "<script>alert('Exam Successfully Created');</script>";
    header("location:manage-exam.php");

}

else{
    echo "<script>alert('Exam Successfully Created');</script>";
}

?>
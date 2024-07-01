<?php 

session_start();

if(isset($_POST['studdet'])){
    if(!empty($_SESSION['studentref'])){
        unset($_SESSION['studentref']);
    }

    $_SESSION['studentref'] = $_POST['studdet'];

    header("location:student-details.php");
}

if(isset($_POST['manexam'])){
    if(!empty($_SESSION['examid'])){
        unset($_SESSION['examid']);
    }
    $_SESSION['examid'] = $_POST['manexam'];
    header("location:manage-exam-2.php");
}


if(isset($_POST['studexam'])){
    if(!empty($_SESSION['studexam'])){
        unset($_SESSION['studexam']);
    }
    $_SESSION['studexam'] = $_POST['studexam'];
    header("location:student-exam-details.php");
}

?>
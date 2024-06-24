<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'innovateu.school@gmail.com'; // Admin Gmail
    $mail->Password = 'xspcnxmrcwniebim'; // Admin Password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('innovateu.school@gmail.com', 'Mailer'); // Admin Gmail

    $mail->addAddress($_POST["email"], 'NameHere');

    $mail->isHTML(true);

    $mail->Subject = "Student Verification";
    $mail->Body = "First Name: " . $_POST["fname"] . "<br>" . "Last Name: " . $_POST["lname"]  . "<br>" .  "Middle Name: " . $_POST["mname"]  . "<br>" .  "Birthdate: " . $_POST["bdate"]  . "<br>" .  "Gender: " . $_POST["gender"]  . "<br>" .  "Contact: " . $_POST["contact"]  . "<br>" .  "Address: " . $_POST["address"]  . "<br>" .  "Guardian: " . $_POST["guardian"]  . "<br>" .  "Email: " . $_POST["email"];

    $mail->send();

    echo
    "
    <script>
    alert('Sent Sucessfully');
    document.location.href = 'signup.php';
    </script>
    ";
}

?>
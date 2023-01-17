<?php
session_start();
include('cgmdbconnection.php');

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

    if(isset($_POST['praysubmit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $request = $_POST['request'];
        $report = $_POST['report'];
        $chapter = $_POST['chapter'];


        $select = "SELECT * FROM chapter WHERE id = $chapter";
        $select_run = mysqli_query($con, $select);
        $row = mysqli_fetch_array($select_run);
        $cgmchapter = $row['cgmchapter'];

        $email_sender = 'cgmchurchweb@gmail.com';
    $name_sender = 'CGM Church';

    
    $subject = "New Prayer Request & Prayer reports";
    $message = $name ." just sent a prayer request & prayer report. \n 
                Prayer Request: " . $request . "
                Prayer Report: " . $report . "
                Chapter: " . $cgmchapter;

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";

    $mail->Username = "cgmchurchweb@gmail.com";
    $mail->Password = "ejyfdyctmtqdmduf";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($email_sender, $name_sender);

    $mail->addAddress($email_sender, $name_sender);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();


        $query = "INSERT INTO prayer (`name`, `email`, `request`, `cgmchapter`, `cgm_id`, `report`) VALUES ('$name','$email','$request', '$cgmchapter', '$chapter', '$report')";
        $query_run = mysqli_query($con,$query);




        if($query_run){
            $_SESSION['status'] = "Sent Successfully";
            $_SESSION['status-code'] = "success";
            header('location:prayer.php');
        }else{
            $_SESSION['status'] = "Something is wrong";
            $_SESSION['status-code'] = "error";
            header('location:prayer.php');
        }
    }
?>
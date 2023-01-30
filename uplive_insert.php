<?php
session_start();
include('cgmdbconnection.php');    

    if(isset($_POST['uplive'])){
        
        $chap = $_POST['cgmchapter'];
        $cgm_id = $_POST['cgm_id'];
        $title = $_POST['title'];
        $live = $_POST['live'];

        $query = "INSERT INTO stream (`cgmchapter`, `title`, `live`, `cgm_id`) VALUES ('$chap','$title','$live','$cgm_id')";
        $query_run = mysqli_query($con,$query);

        if($query_run){
            $_SESSION['status'] = "Post Successfully";
            $_SESSION['status-code'] = "success";
            header("location:uploadevent.php?chapter=$cgm_id");
        }else{
            $_SESSION['status'] = "Something is wrong";
            $_SESSION['status-code'] = "error";
            header("location:uploadevent.php?chapter=$cgm_id");
        }

    }
?>
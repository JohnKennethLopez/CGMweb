<?php
include('cgmdbconnection.php');
$dibconfig = mysqli_select_db($con,'cgm');

$date_today = date('Y-m-d');

if(isset($_POST['reload'])){
    $todate = $_POST['todaydate'];

    $sesdate = " UPDATE upcoming SET curdate = '$todate' WHERE curdate<'$date_today' ";
    $query_run = mysqli_query($con,$sesdate);
}
if($query_run){
    $_SESSION['status'] = "Updated!";
    $_SESSION['status-code'] = "success";
    header('location:information.php');
}else{
    $_SESSION['status'] = "Something is wrong";
    $_SESSION['status-code'] = "error";
    header('location:information.php');
}
?>
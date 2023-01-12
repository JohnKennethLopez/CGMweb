<?php
session_start();
include('cgmdbconnection.php');
if(!isset($_SESSION["username"]))
{
    header("location:admin.php");
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGM</title>
    <link rel="shortcut icon" type="image/png" href="css/image/icon.png">
    <link rel="stylesheet" href="css/admin2.css">
    
</head>
<body>
    <section id="admin">
        <div class="dashb">
            <div class="adlogo">
                <h1 class="CGMh1"><img class="logo" src="logo.png" alt=""><br>CHURCH<br>OF GOD'S <br>MIRACLES<br></h1>
            </div>
            <div class="addash">
                    <br><h1 class="cgmadmin">CGM <br>ADMIN</h1><br><br>
                    <div class="inner">
                        <div class="dashnav">
                        <p class="btn"><a href="appointment_admin.php#Appointment">View Appointment</a><p>
                        <p class="btn"><a href="viewprayer_admin.php#prayerReq">View Prayer Requests</a><p>
                            <p class="btn"><a href="attendancelist_admin.php#Attendancelist">View Attendance List</a><p>
                            <p class="btn"><a href="add_user.php#Adduser">Add User</a><p>
                        </div>
                    </div>
            </div>
        </div>
        <button class="logout"><a href="logout.php">Logout</a></button>
    </section>
</body>
</html>
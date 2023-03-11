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
    <link rel="stylesheet" href="css/info.css">
    <script src="JavaScript/upload.js" defer></script>
    <script src="JavaScript/announcepic.js" defer></script>
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
                        <p style="background: linear-gradient(90deg, #2427ff, #020049);" class="btn"><a href="information.php#upload">Edit Website's Information</a><p>
                        <p class="btn"><a href="appointment_admin.php#Appointment">View Appointment</a><p>
                        <p class="btn"><a href="viewprayer_admin.php#prayerReq">View Prayer Requests</a><p>
                        <p class="btn"><a href="attendancelist_admin.php#Attendancelist">View Attendance List</a><p>
                        <p class="btn"><a href="add_user.php#Adduser">Add User</a><p>
                        </div>
                    </div>
            </div>
        </div>
        <button class="logout"><a href="logout.php">Logout</a></button>
                <hr />
                <h1 class="uplaodevent">Website's Information</h1>
    </section>
    <section id="upload">
        <div class="pinakalabas">
                <div class="edit">
                    <div class="homepic">
                        <div class="inside">
                            <p class="editbtn"><a href="Earchive.php"> Update<br>Event Archive</a></p>
                        </div>
                    </div>
                    <div class="homepic">
                        <div class="inside">
                            <p class="editbtn"><a href="upload5.php"> Upload<br>Limang Minunto</a></p>
                        </div>
                    </div>
                    <div class="homepic">
                        <div class="inside">
                            <p class="editbtn"><a href="uploadmanna.php"> Upload<br>Daily Manna</a></p>
                        </div>
                    </div>
                    <div class="homepic">
                        <div class="inside">
                            <p class="editbtn"><a href="uploadanswer.php"> Upload Jesus is the Answer</a></p>
                        </div>
                    </div>
                    <div class="homepic">
                        <div class="inside">
                            <p class="editbtn"><a href="editHomePic.php">Edit Home pages Pictures</a></p>
                        </div>
                    </div>
                    
                    <div class="editabout">
                        <div class="inside">
                            <p class="editbtn"><a href="editAbout.php">Edit<br>About</a></p>
                        </div>
                    </div>
                    
                    <div class="editCM">
                        <div class="inside">
                            <p class="editbtn"><a href="editCM.php">Edit Councile & Ministry</a></p>
                        </div>
                    </div>
            
                    <div class="editmisser">
                        <div class="inside">
                            <p class="editbtn"><a href="editmisser.php">Edit<br>Mission & Service</a></p>
                        </div>
                    </div>

                    <div class="editmisser">
                        <div class="inside">
                        <p class="editbtn"> <a href="editgivepic.php"> Edit Give page<br>photo & Info </a></p>
                        </div>
                    </div>
                    
                </div>
    </section>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<?php
if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
    ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            // text: "You clicked the button!",
            icon: "<?php echo $_SESSION['status-code']; ?>",
            confirmButtonColor: "#020049",
            confirmButtonText: "Ok",

            });
    </script>
    <?php
    unset($_SESSION['status']);
}
?>
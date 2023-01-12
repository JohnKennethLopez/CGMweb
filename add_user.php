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
    <link rel="stylesheet" href="css/adduser.css">
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
            <br><h1 class="cgmadmin">CGM ADMIN</h1><br><br>
                    <div class="inner">
                        <div class="dashnav">

                        <p class="btn"><a href="information.php#upload">Edit Website's Information</a><p>
                        <p class="btn"><a href="appointment_admin.php#Appointment">View Appointment</a><p>
                        <p class="btn"><a href="viewprayer_admin.php#prayerReq">View Prayer Requests</a><p>
                        <p class="btn"><a href="attendancelist_admin.php#Attendancelist">View Attendance List</a><p>    
                        <p style="background: linear-gradient(90deg, #2427ff, #020049);" class="btn"><a href="add_user.php#Adduser">Add User</a><p>    
                        </div>
                    </div>
            </div>
        </div>
        <button class="logout"><a href="logout.php">Logout</a></button>
                <hr />
                <h1 class="uplaodevent">Add New User</h1>
    </section>
    <section id="Adduser">
        <div class="pinakalabas">
            <div class="labas">
                <form action="insert.php" method="POST" enctype="multipart/form-data">
                    <h1 class="h1up">ADD USER</h1>
                <div class="loob">
 
                    <div class="isang">
                        <label for="title">Username:</label>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="isang">
                        <label for="loc">Password:</label>
                        <input type="text" name="password" placeholder="Password">
                    </div>
                    <div class="isang">
                        <label for="loc">Level:</label>
                        <input type="text" name="level" placeholder="Access Level">
                        <p class="note">Note: 1(one) for ADMIN & 0(zero) for Other chapters </p>
                    </div>
                    <div class="isang">
                    <label for="loc">Chapter:</label>
                    <select name="chapter" id="church" >
                   
                            <option value="select" disabled selected>Choose a CGM Church</option>
                        <?php
                        $chapter = "SELECT * FROM chapter";
                        $chapter_run = mysqli_query($con, $chapter);

                        while($row = mysqli_fetch_array($chapter_run)){

                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['cgmchapter'] ?></option>
                        <?php } ?>
                            </select>
                    </div>
                    
                        <input type="submit" name="add" id="send" value="ADD">
                </div>
                </form>
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
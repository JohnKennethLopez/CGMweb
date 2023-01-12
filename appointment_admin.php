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
    <link rel="stylesheet" href="css/viewappointment.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <section id="admin">
        <div class="dashb">
            <div class="adlogo">
                <h1 class="CGMh1"><img class="logo" src="logo.png" alt=""><br>CHURCH<br>OF GOD'S <br>MIRACLES<br></h1>
            </div>
            <div class="addash">
            <br><h1 class="cgmadmin"> CGM ADMIN</h1><br><br>
                    <div class="inner">
                        <div class="dashnav">
                        <p class="btn"><a href="appointment_admin.php#Appointment">View Appointment</a><p>
                        <p class="btn"><a href="viewprayer_admin.php#prayerReq">View Prayer Requests</a><p>
                            <p class="btn"><a href="attendance_admin.php#attendance">Attendance</a><p>
                            <p class="btn"><a href="attendancelist_admin.php#Attendancelist">View Attendance List</a><p>
                        </div>
                    </div>
            </div>
        </div>
        <button class="logout"><a href="logout.php">Logout</a></button>
                <hr />
                <h1 class="appoint">Appointment Reservation</h1>
    </section>
    <section id="Appointment">
        <div class="labas">
            <div class="filter">
                <div class="inn">
                    <p class="backbtn"><a href="searchappoint_admin.php">Filter the Date and <br>CGM CHAPTER</a></p>
                </div>
            </div>
            <div class="print">
                <div class="pr">
                    <p class="printbtn"><a href="printappoint.php">Print<br>Appointment List</a></p>
                </div>
            </div>
        </div>
        <div class="table">
            <table class="tablecont">
                <tr>
                    <th>DATE</th>
                    <th>CGM CHAPTER</th>
                    <th>FULL NAME</th>
                    <th>EMAIL</th>
                    <th>CONTACT NUMBER</th>
                    <th>SERVICE</th>
                    <th>TIME</th>
                    <th>ADDRESS</th>
                    <th>MESSAGE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
                <?php
                    include('cgmdbconnection.php');
                    $dibconfig = mysqli_select_db($con,'cgm');
                    
                    $query = "SELECT * FROM appointment";
                    $query_run = mysqli_query($con,$query);
                    $check_attendance = mysqli_num_rows($query_run) > 0; 
                    if($check_attendance){
                        while($row = mysqli_fetch_array($query_run)){
                            
                    ?>
                    <tr class="scroll">
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['cgmchapter']?></td>
                        <td><?php echo $row['fullname']?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['contact']?></td>
                        <td><?php echo $row['service']?></td>
                        <td><?php echo $row['time']?></td>
                        <td><?php echo $row['address']?></td>
                        <td><?php echo $row['message']?></td>
                        <td><?php echo $row['status']?></td>
                        <td><input type="hidden" class="delete_id_value " value="<?php echo $row['id']?>">

                        <button class="confirm_btn_ajax confirm-btn" name="confirm" 
                            <?php if($row['status'] == 'Pending')
                            {  } else {?> disabled <?php } ?>>Confirm</button>

                        <button class="reject_btn_ajax reject-btn" name="reject" 
                            <?php if($row['status'] == 'Pending')
                            {  } else {?> disabled <?php } ?>>Reject</button>

                    <a href="javascript:void(0)" class="delete_btn_ajax delete-btn">Delete</a></td>
                    </tr>
                    <?php
                        }
                        } else{
                            echo " No Appointment Reservation Found!";
                        }
                    

                ?>
            </table>
        </div>
    </section>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>
<script>
    $('.confirm_btn_ajax').click(function(e){
        e.preventDefault();

        var confirmid = $(this).closest("tr").find('.delete_id_value').val();
        console.log(confirmid);
        swal({
            title: "Confirm Appointment?",
            text: "Once confirmed, notification will be sent",
            icon: "info",
            buttons: true,
            })
            .then((willConfirm) => {
            if (willConfirm) {
                $.ajax({
                    type: "POST",
                    url: "sendemail.php",
                    data: {
                        "confirm_btn_set": 1,
                        "confirm_id": confirmid,
                    },
                    success: function(response) {

                        swal("Confirmed Successfully!", {
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                                   
                            });
                    }
                });


                
            }
            });
    })

    $('.reject_btn_ajax').click(function(e){
        e.preventDefault();

        var rejectid = $(this).closest("tr").find('.delete_id_value').val();
        console.log(rejectid);
        swal({
            title: "Reject Appointment?",
            text: "Once rejected, notification will be sent",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willReject) => {
            if (willReject) {
                $.ajax({
                    type: "POST",
                    url: "sendemail.php",
                    data: {
                        "reject_btn_set": 1,
                        "reject_id": rejectid,
                    },
                    success: function(response) {

                        swal("Rejected Successfully!", {
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                                   
                            });
                    }
                });


                
            }
            });
    })


    $('.delete_btn_ajax').click(function(e){
        e.preventDefault();

        var deleteid = $(this).closest("tr").find('.delete_id_value').val();
        console.log(deleteid);
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "deleteappoint.php",
                    data: {
                        "delete_btn_set": 1,
                        "delete_id": deleteid,
                    },
                    success: function(response) {

                        swal("Data Deleted Successfully!", {
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                            });
                    }
                });
            }
            });
    })
</script>

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

<?php
session_start();

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
    <link rel="stylesheet" href="css/editprog.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <section id="editevent">
        <?php 
                    include('cgmdbconnection.php');
                    $dibconfig = mysqli_select_db($con,'cgm');

                        $chapter = $_GET['chapter'];
                        $name = "SELECT * FROM chapter WHERE id = $chapter";
                        $name_run = mysqli_query($con, $name);
                        $row = mysqli_fetch_array($name_run);
                    ?>
        <div class="labasbtn">
                <div class="back">
                    <div class="inn">
                        <p class="backbtn"> <a href="uploadevent.php?chapter=<?php echo $chapter ?>"> Go Back to <br>the Admin</a></p>
                    </div>
                </div>
                
        </div>
        <div class="table">
            <table class="tablecont">
                <tr>
                    <th>CGM Chapter</th>
                    <th>Live Stream Replay Iframe</th>
                    <th class="DE">EDIT & DELETE</th>
                </tr>
                
                <?php
                    
                    $query = "SELECT * FROM stream WHERE cgm_id = $chapter ORDER BY id DESC";
                    $query_run = mysqli_query($con,$query);
                    $check_attendance = mysqli_num_rows($query_run) > 0; 
                    if($check_attendance){
                        while($row = mysqli_fetch_array($query_run)){
                    ?>
                    <tr class="scroll">
                        <td><?php echo $row['cgmchapter']?></td>
                        <td><?php echo $row['live']?></td>
                        
                        <td><a href="Editprogbtn.php?chapter=<?php echo $chapter ?>&edit=<?php echo $row['id']; ?>"><button class="edit">edit</button></a><input type="hidden" class="delete_id_value " value="<?php echo $row['id']?>">
                        <a href="javascript:void(0)" class="delete_btn_ajax delete-btn">Delete</a></td>
                    </tr>
                    <?php
                        }
                        } else{
                            echo " No Information Found!";
                        }
                    

                ?>
            </table>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </section>

</body>
</html>
<script>
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
                    url: "deleteprog.php",
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
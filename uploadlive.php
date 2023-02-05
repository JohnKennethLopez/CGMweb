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
    <link rel="stylesheet" href="css/uplive.css">
    <script src="JavaScript/announcepic.js" defer></script>
</head>
<body>
    <section id="announcement">
    <div class="backk">
    <div class="back">
            <div class="inn">
            <?php 
                    include('cgmdbconnection.php');
                    $dibconfig = mysqli_select_db($con,'cgm');

                        $chapter = $_GET['chapter'];
                        $name = "SELECT * FROM chapter WHERE id = $chapter";
                        $name_run = mysqli_query($con, $name);
                        $row = mysqli_fetch_array($name_run);
                        $cgmchapter = $row['cgmchapter'];
                    ?>
                <p class="backbtn"> <a href="uploadevent.php?chapter=<?php echo $chapter ?>"> Go Back to <br>the Admin</a></p>
            </div>
        </div>
        <div class="baack">
            <div class="iinn">
                <p class="backbtn"> <a href="editprog.php?chapter=<?php echo $chapter ?>">Edit Live Stream<br>Iframe </a></p>
            </div>
        </div>
    </div>

        <div class="pinakalabas">
            <div class="labass">
                <form action="uplive_insert.php" method="POST" enctype="multipart/form-data">
                <h3 class="h1up"><?php echo $cgmchapter ?> Live Stream</h3>
                <div class="loob">
                        <input type="text" hidden name="cgmchapter" value="<?php echo $cgmchapter ?>">
                        <input type="text" hidden name="cgm_id" value="<?php echo $chapter ?>">
                        <div class="isang">
                            <label for="title">Title:</label>
                            <input type="text" name="title" placeholder="Enter live stream Title" required>
                        </div>
                        <div class="isang">
                            <label for="live">Live Stream Iframe:</label>
                            <textarea name="live" id="caption" placeholder="Add Live Stream Iframe"></textarea>
                            <p class="note">Note: Please remove all ' in the iframe so that you don't encounter some error</p>
                        </div>
                            <input type="submit" name="uplive" id="send" value="POST">
                    </div>
                    </form>
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
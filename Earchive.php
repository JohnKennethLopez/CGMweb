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
    <link rel="stylesheet" href="css/Editabout.css">
</head>
<style>
    .todate {
        text-align: center;
        margin-left: 50%;
        transform: translateX(-50%);
        height: 45px;
        width: 42%;
        font-size: 17px;
        letter-spacing: 3px;
        color: black;
        border-color: black;
        font-family: 'Orbitron', sans-serif;
        padding: 5px 5px 5px 15px;
        outline: none;
        border-radius: 5px;
    }
    .submit {
        text-align: center;
    }
    .note {
        text-align: center;
    }
</style>
<body>





    <section id="upload">
        
        <?php 
            $date_today = date('Y-m-d');
        ?>
        <div class="pinakalabas">
            <div class="labas">
                            
                <form action="archive.php" method="POST">
                    <input type="date" class="todate" readonly name="todaydate" value="<?php echo $date_today; ?>"><br><br>
                    <p class="note">Note: This will bring the current date of each event up to date. If the event's date is less than the current date, it will be archived.</p>
                    <div class="submit">
                        <button name="reload" id="send">UPDATE</button><br>
                        <button class="cancel"> <a href="information.php#upload">CANCEL</a></button>
                    </div>
                </form>
                
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
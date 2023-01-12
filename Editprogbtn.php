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
<body>

                    
<?php 
                    include('cgmdbconnection.php');
                    $dibconfig = mysqli_select_db($con,'cgm');

                        $chapter = $_GET['chapter'];
                        $name = "SELECT * FROM chapter WHERE id = $chapter";
                        $name_run = mysqli_query($con, $name);
                        $row = mysqli_fetch_array($name_run);
                    ?>
<?php

  

    
    $sql = "SELECT * FROM stream WHERE id = $chapter";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $chap = $row['cgmchapter'];
    $live = $row['live'];
    $title = $row['title'];

    if(isset($_POST['submitlive'])){
        

        $live = $_POST['live'];
        $title = $_POST['title'];

        $query = "UPDATE stream SET live='$live', title='$title' where id=$chapter";
        $query_run = mysqli_query($con,$query);

        if($query_run){
            $_SESSION['status'] = "Updated Successfully";
            $_SESSION['status-code'] = "success";
            header("location:editprog.php?chapter=$chapter");
        }else{
            $_SESSION['status'] = "Something is wrong";
            $_SESSION['status-code'] = "error";
            header("location:editprog.php?chapter=$chapter");
        }

    }
?>



    <section id="upload">
        
                
        <div class="pinakalabas">
            <div class="labas">
                            
                <form method="POST" enctype="multipart/form-data">
                    <h1 class="h1up">Live Stream Replay Iframe for <?php echo $chap; ?>:</h1>
                <div class="loob">
                    <div class="isang">
                        <label for="title">Title:</label>
                        <input type="text" name="title" placeholder="Enter the title of the stream" value="<?php echo $title; ?>">
                    </div>
                    <div class="isang">
                        <label for="live">Live Stream Iframe:</label>
                        <textarea name="live" id="live"><?php echo $live; ?></textarea>
                        <p class="note">Note: Please remove all ' in the iframe so that you don't encounter some error</p>
                    </div>
            
                    <div class="button">
                        <div class="submit">
                            <button name="submitlive" id="send">UPDATE</button>
                            <button class="cancel"> <a href="editprog.php?chapter=<?php echo $chapter ?>"> CANCEL</a></button>
                        </div>
                    </div>
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
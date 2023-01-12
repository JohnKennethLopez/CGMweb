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
    <link rel="stylesheet" href="css/Editbtn.css">
</head>
<body>

<?php

include('cgmdbconnection.php');    

    $id = $_GET['edit'];
    $sql = "SELECT * FROM home WHERE id = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $photo = $row['photo'];


    if(isset($_POST['submitevent'])){

        $image = $_FILES['photo'];
        print_r($_FILES['photo']);
        $img_loc = $_FILES['photo']['tmp_name'];
        $img_name = $_FILES['photo']['name'];
        $photo ="upload/" .$img_name;
        move_uploaded_file($img_loc,'upload/'.$img_name);


        $query = "UPDATE home SET photo='$photo' where id=$id";
        $query_run = mysqli_query($con,$query);

        if($query_run){
            $_SESSION['status'] = "Updated Successfully";
            $_SESSION['status-code'] = "success";
            header('location:editHomePic.php');
        }else{
            $_SESSION['status'] = "Something is wrong";
            $_SESSION['status-code'] = "error";
            header('location:editHomePic.php');
        }

    }
?>



    <section id="upload">
        
                
        <div class="pinakalabas">
            <div class="labas">
                            
                <form method="POST" enctype="multipart/form-data">
                    <h1 class="h1up">HOME PICTURES:</h1>
                <div class="loob">
                    <div class="iisang">
                        <label for="image">Add Image:</label>
                        <input type="file"  name="photo" ><img src="<?php echo $photo; ?>" alt="" width="500px">
                    </div>
            
                    <div class="button">
                        <div class="submit">
                            <button name="submitevent" id="send">UPDATE</button>
                            <button class="cancel"> <a href="editHomePic.php"> CANCEL</a></button>
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
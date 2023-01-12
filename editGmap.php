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
    <link rel="stylesheet" href="css/editgmap.css">
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
        <div class="back">
            <div class="inn">
                <p class="backbtn"> <a href="uploadevent.php?chapter=<?php echo $chapter ?>"> Go Back to <br>the Admin</a></p>
            </div>
        </div>
        <div class="table">
            <table class="tablecont">
                <tr>
                    <th>CGM Chapter</th>
                    <th>F2F Service</th>
                    <th>Online Service</th>
                    <th>Address</th>
                    <th>Google Map Iframe</th>
                    <th>FaceBook Page/Account Link</th>
                    <th class="DE">EDIT</th>
                </tr>
                    
                <?php
                    
                    
                    $query = "SELECT * FROM gmap WHERE id = $chapter";
                    $query_run = mysqli_query($con,$query);
                    $check_attendance = mysqli_num_rows($query_run) > 0; 
                    if($check_attendance){
                        while($row = mysqli_fetch_array($query_run)){
                    ?>
                    <tr class="scroll">
                        <td><?php echo $row['cgmchapter']?></td>
                        <td><?php echo $row['f2fservice']?></td>
                        <td><?php echo $row['online']?></td>
                        <td><?php echo $row['address']?></td>
                        <td><?php echo $row['googlemap']?></td>
                        <td><?php echo $row['fblink']?></td>
                        <td><a href="Editgmapbtn.php?chapter=<?php echo $chapter ?>"><button class="edit">edit</button></a></td>
                    </tr>
                    <?php
                        }
                        } else{
                            echo " No Information Found!";
                        }
                    

                ?>
            </table>
        </div>
        
    </section>

</body>
</html>
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
    <link rel="stylesheet" href="css/searchapp.css" media="all">
    <link rel="stylesheet" href="css/print.css" media="print">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <section id="editevent">
        <div class="header">
            <div class="lgg"><img class="lg" src="logo.png" alt=""></div>
            <div class="cgmm"><h1 class="cgm">Church of God's Miracles</h1></div>
        </div>
        <div class="back">
            <div class="inn">
                <p class="backbtn"> <a href="admin2.php"> Go Back to <br>the Admin</a></p>
            </div>
        </div>
        <h1 class="head">APPOINTMENT RESERVATION</h1><hr>
        <div class="filterpart">
                <form action="" method="GET">
                    <div class="filter">
                            <select name="chapter" id="church" >
                            <option value="select" disabled selected>Choose a CGM Church</option>
                        <?php
                        $chapter = "SELECT * FROM chapter";
                        $chapter_run = mysqli_query($con, $chapter);

                        while($row = mysqli_fetch_array($chapter_run)){

                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['cgmchapter'] ?></option>
                        <?php } ?>
                            </select><br>
                            <div class="datefilter">
                                <div class="fromdate">
                                    <label class="date_label" for="from_date">From Date:</label><br>
                                    <input type="date" name="from_date" value="<?php if(isset($_GET['chapter'])){ echo $_GET['from_date']; } ?>">
                                </div>
                                <div class="todate">
                                    <label class="date_label" for="to_date">To Date:</label><br>
                                    <input type="date" name="to_date" value="<?php if(isset($_GET['chapter'])){ echo $_GET['to_date']; } ?>">
                                </div>
                            </div>
                            
                        <button type="submit" class="filterbtn">Filter<i class="fa-solid fa-filter"></i></button><br><br>
                        <button onclick="window.print()" class="printbtn">PRINT <i class="fa-solid fa-print"></i></button><br><br>
                    </div>
                </form>
            </div>
            <div class="table">
            <table class="tablecont">
                <thead>
                    <th>DATE</th>
                    <th>CGM CHAPTER</th>
                    <th>FULL NAME</th>
                    <th>EMAIL</th>
                    <th>CONTACT NUMBER</th>
                    <th>SERVICE</th>
                    <th>TIME</th>
                    <th>ADDRESS</th>
                    <th>MESSAGE</th>
                </thead>
                <?php
                    include('cgmdbconnection.php');
                    $dibconfig = mysqli_select_db($con,'cgm');
                    
                    if(isset($_GET['chapter']))
                    {
                        
                        $chapter = $_GET['chapter'];
                        $from_date = $_GET['from_date'];
                        $to_date = $_GET['to_date'];
                        $new_from_date = date("Y/m/d", strtotime($from_date));
                        $new_to_date = date("Y/m/d", strtotime($to_date));
                        

                        $query = "SELECT * FROM appointment WHERE cgmchapter='$chapter' AND date BETWEEN '$new_from_date' AND '$new_to_date' ";
                        $query_run = mysqli_query($con,$query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $items)
                            {
                                ?>
                                    <tr class="scroll">
                                    <td><?= $items['date']; ?></td>
                                    <td><?= $items['cgmchapter']; ?></td>
                                    <td><?= $items['fullname']; ?></td>
                                    <td><?= $items['email']; ?></td>
                                    <td><?= $items['contact']; ?></td>
                                    <td><?= $items['service']; ?></td>
                                    <td><?= $items['time']; ?></td>
                                    <td><?= $items['address']; ?></td>
                                    <td><?= $items['message']; ?></td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                             ?>
                                <tr>
                                    <td colspan="9">No Record Found!!!</td>
                                </tr>
                            <?php
                        }
                    }
                    ?>
                    
            </table>
        </div>
        <?php 
                if(isset($_GET['chapter']))
                {
                    
                    $chapter = $_GET['chapter'];
                    $from_date = $_GET['from_date'];
                    $to_date = $_GET['to_date'];
                    $new_from_date = date("Y/m/d", strtotime($from_date));
                    $new_to_date = date("Y/m/d", strtotime($to_date));

                    $count_query = $count_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM appointment WHERE cgmchapter='$chapter' AND date BETWEEN '$new_from_date' AND '$new_to_date' ");
                    $row_count = mysqli_fetch_assoc($count_query);
                    $count = $row_count['total'];
                }
            ?>
            <div class="totalattend">
                <?php 
                    if(!isset($_GET['chapter'])){
                        $count = '0';
                        
                    }else{
                            $count = $row_count['total'];
                        }
                ?>
                <h1 class="total">Total of Appointment Reservations: <?php echo $count; ?></h1>
            </div>
    </section>
</body>
</html>
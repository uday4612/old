<?php
session_start();
if (!isset($_SESSION['name']) || $_SESSION['role'] !== 'admin') {
    header("Location: login1.php");
    exit();
}
require('firstimport.php');

$tbl_name = "interlist";

mysqli_select_db($conn, "$db_name") or die("cannot select db");

// Fetch all trains from the database
$sql = "SELECT * FROM $tbl_name";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Train List</title>
    <link rel="shortcut icon" href="images/favicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="Default.css" rel="stylesheet">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            var x = (($(window).width()) - 1024) / 2;
            $('.wrap').css("left", x + "px");
        });
    </script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/man.js"></script>
</head>
<body>
<div class="wrap">
    <!-- Header -->
    <div class="header">
        <div style="float:left;width:150px;">
            <img src="../images/logo.jpg"/>
        </div>
        <div>
            <div style="float:right; font-size:20px;margin-top:20px;">
                <?php
                if(isset($_SESSION['name']))
                {
                    echo "Welcome,".$_SESSION['name']."&nbsp;&nbsp;&nbsp;<a href=\"logout.php\" class=\"btn btn-info\">Logout</a>";
                }
                ?>
            </div>
            <div id="heading">
                <a href="index.php">Indian Railways</a><h4>Admin Panel</h4>
            </div>
        </div>
    </div>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="index.php">HOME</a>
                <a class="brand" href="train.php">TRAIN</a>
                <a class="brand" href="reservation.php">RESERVATION</a>
                <a class="brand" href="profile.php">PROFILE</a>
                <a class="brand" href="seat_a.php">SEAT AVAILABILITY</a>
                <a class="brand" href="train_list.php">TRAIN LIST</a>
            </div>
        </div>
    </div>

    <div class="well" id="boxh">
        <h3>Train InterList</h3>
    </div>

    <!-- Displaying all trains -->
    <div class="well">
        <div class="display" style="height:30px;">
            <table class="table" border="5px">
                <tr>
                    <th style="width:70px;border-top:0px;">Train No.</th>
                    <th style="width:210px;border-top:0px;">Train Name</th>
                    <th style="width:30px;border-top:0px;">St 1</th>
                    <th style="width:30px;border-top:0px;">St 1 Arri</th>
                    <th style="width:45px;border-top:0px;">St 2</th>
                    <th style="width:40px;border-top:0px;">St 2 Arri</th>
                    <th style="width:43px;border-top:0px;">St 3</th>
                    <th style="width:35px;border-top:0px;">St 3 Arri</th>
                    <th style="width:60px;border-top:0px;">St 4</th>
                    <th style="width:40px;border-top:0px;">St 4 Arri</th>
                    <th style="width:50px;border-top:0px;">St 5</th>
                    <th style="width:30px;border-top:0px;">St 5 Arri</th>
                    <th style="width:45px;border-top:0px;">Orig.</th>
                    <th style="width:45px;border-top:0px;">Des.</th>
                    <th style="width:45px;border-top:0px;">Arr.</th>
                    <th style="width:45px;border-top:0px;">Dep.</th>
                    <th style="width:25px;border-top:0px;">M</th>
                    <th style="width:25px;border-top:0px;">T</th>
                    <th style="width:25px;border-top:0px;">W</th>
                    <th style="width:25px;border-top:0px;">T</th>
                    <th style="width:25px;border-top:0px;">F</th>
                    <th style="width:25px;border-top:0px;">S</th>
                    <th style="border-top:0px;"><font color=red>S</font></th>
                </tr>
            </table>
        </div>
        <div class="display" style="margin-top:0px;overflow:auto;">
            <table class="table">
                <?php
                $n = 0;
                while($row = mysqli_fetch_array($result)) {
                    if($n%2 == 0) {
                        ?>
                        <tr class="text-error">
                    <?php } else { ?>
                        <tr class="text-info">
                    <?php } ?>
                        <td style="width:70px;"><?php echo $row['Number']; ?> </td>
                        <td style="width:210px;"><?php echo $row['Name']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st1']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st1arri']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st2']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st2arri']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st3']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st3arri']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st4']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st4arri']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st5']; ?> </td>
                        <td style="width:25px;"><?php echo $row['st5arri']; ?> </td>
                        <td style="width:50px;"><?php echo $row['Ori']; ?> </td>
                        <td style="width:50px;"><?php echo $row['Dest']; ?> </td>
                        <td style="width:50px;"><?php echo $row['Oriarri']; ?> </td>
                        <td style="width:50px;"><?php echo $row['Desarri']; ?> </td>
                        <td style="width:20p;"><?php echo $row['Mon']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Tue']; ?> </td>
                        <td style="width:29px;"><?php echo $row['Wed']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Thu']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Fri']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Sat']; ?> </td>
                        <td><?php echo $row['Sun']; ?> </td>
                    </tr>
                    <?php
                    $n++;
                }
                mysqli_close($conn);
                ?>
            </table>
        </div>
        <footer>
		<div style="width:100%;">
			<div style="float:left; margin-top:10px;">
			<p class="text-right text-info">  &copy; <?php echo date("Y") ?> Copyright PVT Ltd.</p>	
			</div>
			<div style="float:right; margin-top:10px;">
			<p class="text-right text-info">Desinged & Developed By : <a target="_blank" href="https://uday4612.42web.io">Uday</a></p>
			</div>
		</div>
</footer>
    </div>
</div>
</body>
</html>

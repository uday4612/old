<?php  
session_start();
if (!isset($_SESSION['name']) || $_SESSION['role'] !== 'admin') {
    header("Location: login1.php");
    exit();
}
require('firstimport.php');

$tbl_name = "seats_availability";

mysqli_select_db($conn, "$db_name") or die("cannot select db");

// Fetch all trains from the database
$sql = "SELECT * FROM $tbl_name";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html>
<head>
	<title> Reservation </title>
	<link rel="shortcut icon" href="images/favicon.png"></link>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="../css/bootstrap.min.css" rel="stylesheet"></link>
	<link href="../css/Default.css" rel="stylesheet"></link>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script>
		$(document).ready(function()
		{
			var x=(($(window).width())-1024)/2;
			$('.wrap').css("left",x+"px");
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

    <div class="span12 well" id="boxh">
        <h3>Seat Availability List</h3>
        <a class="btn btn-primary" href="add_seat.php">Add Seat</a>
    </div>

    <!-- Displaying all trains -->
    <div class="span12 well">
        <div class="display" style="height:30px;">
            <table class="table" border="5px">
                <tr>
                    <th style="width:50px;border-top:0px;">Train Number</th>
                    <th style="width:140px;border-top:0px;">Train Name</th>
                    <th style="width:50px;border-top:0px;">DOJ</th>
                    <th style="width:10px;border-top:0px;">1A</th>
                    <th style="width:10px;border-top:0px;">2A</th>
                    <th style="width:10px;border-top:0px;">3A</th>
                    <th style="width:10px;border-top:0px;">AC</th>
                    <th style="width:10px;border-top:0px;">CC</th>
                    <th style="width:10px;border-top:0px;">SL</th>
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
                        <td style="width:50px;"><?php echo $row['Train_No']; ?> </td>
                        <td style="width:10px;"><?php echo $row['Train_Name']; ?> </td>
                        <td style="width:10px;"><?php echo $row['doj']; ?> </td>
                        <td style="width:10px;"><?php echo $row['1A']; ?> </td>
                        <td style="width:10px;"><?php echo $row['2A']; ?> </td>
                        <td style="width:10px;"><?php echo $row['3A']; ?> </td>
                        <td style="width:10px;"><?php echo $row['AC']; ?> </td>
                        <td style="width:10px;"><?php echo $row['CC']; ?> </td>
                        <td style="width:1px;"><?php echo $row['SL']; ?> </td>
                    </tr>
                    <?php
                    $n++;
                }
                mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>

    <?php
	include 'footer.php';
?>
</div>
</body>
</html>
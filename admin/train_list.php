<?php
session_start();
if (!isset($_SESSION['name']) || $_SESSION['role'] !== 'admin') {
    header("Location: login1.php");
    exit();
}
require('firstimport.php');

$tbl_name = "train_list";

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
        <h3>Train List</h3>
        <a class="btn btn-primary" href="add_train.php">Add Train</a>
    </div>

    <!-- Displaying all trains -->
    <div class="well">
        <div class="display" style="height:30px;">
            <table class="table" border="5px">
                <tr>
                    <th style="width:70px;border-top:0px;">Train No.</th>
                    <th style="width:180px;border-top:0px;">Train Name</th>
                    <th style="width:65px;border-top:0px;">Orig.</th>
                    <th style="width:55px;border-top:0px;">Des.</th>
                    <th style="width:60px;border-top:0px;">Arr.</th>
                    <th style="width:65px;border-top:0px;">Dep.</th>
                    <th style="width:20px;border-top:0px;">Mon</th>
                    <th style="width:25px;border-top:0px;">Tue</th>
                    <th style="width:29px;border-top:0px;">Wed</th>
                    <th style="width:25px;border-top:0px;">Thu</th>
                    <th style="width:25px;border-top:0px;">Fri</th>
                    <th style="width:25px;border-top:0px;">Sat</th>
                    <th style="width:25px;border-top:0px;">Sun</th>
                    <th style="width:30px;border-top:0px;">1A</th>
                    <th style="width:25px;border-top:0px;">2A</th>
                    <th style="width:20px;border-top:0px;">3A</th>
                    <th style="width:25px;border-top:0px;">SL</th>
                    <th style="width:20px;border-top:0px;">Gen</th>
                    <th style="width:25px;border-top:0px;">Ladies</th>
                    <th style="width:25px;border-top:0px;">Tatkal</th>
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
                        <td style="width:190px;"><?php echo $row['Name']; ?> </td>
                        <td style="width:65px;"><?php echo $row['Origin']; ?> </td>
                        <td style="width:70px;"><?php echo $row['Destination']; ?> </td>
                        <td style="width:60px;"><?php echo $row['Arrival']; ?> </td>
                        <td style="width:70px;"><?php echo $row['Departure']; ?> </td>
                        <td style="width:30px;"><?php echo $row['Mon']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Tue']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Wed']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Thu']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Fri']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Sat']; ?> </td>
                        <td style="width:25px;"><?php echo $row['Sun']; ?> </td>
                        <td style="width:20px;"><?php echo $row['1A']; ?> </td>
                        <td style="width:20px;"><?php echo $row['2A']; ?> </td>
                        <td style="width:29px;"><?php echo $row['3A']; ?> </td>
                        <td style="width:20px;"><?php echo $row['SL']; ?> </td>
                        <td style="width:35px;"><?php echo $row['General']; ?> </td>
                        <td style="width:35px;"><?php echo $row['Ladies']; ?> </td>
                        <td style="width:30px;"><?php echo $row['Tatkal']; ?> </td>
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

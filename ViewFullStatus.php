<?php
session_start();

require('firstimport.php');

if(isset($_SESSION['name'])) {

} else {
    header("location:login1.php");
    exit;
}

$tbl_name="booking";

mysqli_select_db($conn,"$db_name") or die("cannot select db");

$name1=$_SESSION['name'];
$sql="SELECT Tnumber,doj,Name,Age,Sex,Status,DOB,class FROM $tbl_name WHERE (uname='$name1')";
$result=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title> Reservation </title>
    <link rel="shortcut icon" href="images/favicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/Default.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
	<style>
@media print {
  @page {
    size: landscape;
  }
}
</style>
    <script>
        $(document).ready(function() {
            var x=(($(window).width())-1024)/2;
            $('.wrap').css("left",x+"px");
        });
    </script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/man.js"></script>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div style="float:left;width:150px;">
            <img src="images/logo.jpg"/>
        </div>
        <div>
            <div style="float:right; font-size:20px;margin-top:20px;">
                <?php
                if(isset($_SESSION['name'])) {
                    echo "Welcome, ".$_SESSION['name']."&nbsp;&nbsp;&nbsp;<a href=\"logout.php\" class=\"btn btn-info\">Logout</a>";
                }
                ?>
            </div>
            <div id="heading">
                <a href="index.php">Indian Railways</a>
            </div>
        </div>
    </div>
    <!-- Navigation bar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="index.php">HOME</a>
                <a class="brand" href="train.php">FIND TRAIN</a>
                <a class="brand" href="reservation.php">RESERVATION</a>
                <a class="brand" href="profile.php">PROFILE</a>
                <a class="brand" href="viewfullstatus.php">BOOKING HISTORY</a>
            </div>
        </div>
    </div>

    <div class="span12 well">
        <div align="center" style="border-bottom: 3px solid #ddd;">
            <h2>Booked Ticket History </h2>
        </div>
        <br>
        <div>
            <table class="table">
                <col width="90">
                <col width="90">
                <col width="90">
                <col width="110">
                <col width="90">
                <col width="90">
                <col width="90">
                <col width="90">
                <tr>
                    <th style="width:10px;border-top:0px;">SNo.</th>
                    <th style="width:100px;border-top:0px;">Train Number</th>
                    <th style="width:100px;border-top:0px;">Date Of Journey</th>
                    <th style="width:100px;border-top:0px;">Name</th>
                    <th style="width:100px;border-top:0px;">Age</th>
                    <th style="width:100px;border-top:0px;">Sex</th>
                    <th style="width:100px;border-top:0px;">Status</th>
                    <th style="width:100px;border-top:0px;">DOB</th>
                    <th style="width:100px;border-top:0px;">Class</th>
                </tr>
                <?php
                $n=1;
                while($row=mysqli_fetch_array($result)){
                    // Assigning value of class from the current row
                    $class = $row['class'];
                    if($n%2!=0) {
                ?>
                <tr class="text-error">
                    <th style="width:10px;"> <?php echo $n; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Tnumber']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['doj']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Name']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Age']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Sex']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Status']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['DOB']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['class']; ?> </th>
                </tr>
                <?php
                    } else {
                ?>
                <tr class="text-info">
                    <th style="width:10px;"> <?php echo $n; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Tnumber']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['doj']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Name']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Age']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Sex']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['Status']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['DOB']; ?> </th>
                    <th style="width:100px;"> <?php echo $row['class']; ?> </th>
                </tr>
                <?php
                    }
                    $n++;
                }
                ?>
				</table>
                <?php

$sql3 = "SELECT Tnumber, doj, Name, Age, Sex, Status, DOB, class FROM $tbl_name WHERE (uname='$name1')";
$result3 = mysqli_query($conn, $sql3);
$totalFare = 0;
while ($row3 = mysqli_fetch_array($result3)) {
    $class = $row3['class'];
    $tnumber = $row3['Tnumber'];
    // Fetch data from train_list based on the class
    $trainListQuery = "SELECT `1A`, `2A`, `3A`, `SL` FROM train_list WHERE Number='$tnumber'";
    $trainListResult = mysqli_query($conn, $trainListQuery);
    $trainListRow = mysqli_fetch_array($trainListResult);

    $fare = 0;

    switch ($class) {
        case '1A':
            $fare = $trainListRow['1A'];
            break;
        case '2A':
            $fare = $trainListRow['2A'];
            break;
        case '3A':
            $fare = $trainListRow['3A'];
            break;
        case 'SL':
            $fare = $trainListRow['SL'];
            break;
        default:
            echo "Invalid class";
    }

    $totalFare += $fare;
}

echo "<h3 style='color: red;'>Total Fare: $totalFare<br></h3>";
?>
				<button onClick="window.print()">Print</button>
            <!-- Adding footer -->
            <?php include 'footer.php'; ?>
        </div>
    </div>
</div>
</body>
</html>

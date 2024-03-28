<?php
session_start();
if (!isset($_SESSION['name']) || $_SESSION['role'] !== 'admin') {
    header("Location: login1.php");
    exit();
}
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Default.css" rel="stylesheet">
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
    <style>
        .radio-group {
            display: flex;
            flex-wrap: wrap;
        }

        .radio-item {
            margin-right: 20px;
        }

        .radio-label {
            margin-right: 5px;
        }

        .hii{
            margin-left: 400px;
            position: center;
        }
    </style>
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
        <h3>Add Train</h3>
    </div>

    <!-- Displaying all trains -->
    <div class="well">
        <div class="display" style="height:1200px;">

    <form action="process_form.php" method="post" class="hii">
        <label for="number">Number:</label>
        <input type="text" id="number" name="number" required><br><br>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="origin">Origin:</label>
        <input type="text" id="origin" name="origin" required><br><br>
        
        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="destination" required><br><br>
        
        <label for="arrival">Arrival:</label>
        <input type="text" id="arrival" name="arrival" required><br><br>
        
        <label for="departure">Departure:</label>
        <input type="text" id="departure" name="departure" required><br><br>

        <label>Operational Days:</label>
        <div class="radio-group">
        <div class="radio-item">
            <input type="radio" id="mon_yes" name="mon" value="Y" required>
            <label class="radio-label" for="mon_yes">Yes</label>
            <input type="radio" id="mon_no" name="mon" value="N" required>
            <label class="radio-label" for="mon_no">No</label>
            <label for="mon">Mon</label>
        </div>
        <div class="radio-item">
            <input type="radio" id="tue_yes" name="tue" value="Y" required>
            <label class="radio-label" for="tue_yes">Yes</label>
            <input type="radio" id="tue_no" name="tue" value="N" required>
            <label class="radio-label" for="tue_no">No</label>
            <label for="tue">Tue</label>
        </div>
        <div class="radio-item">
            <input type="radio" id="wed_yes" name="wed" value="Y" required>
            <label class="radio-label" for="wed_yes">Yes</label>
            <input type="radio" id="wed_no" name="wed" value="N" required>
            <label class="radio-label" for="wed_no">No</label>
            <label for="wed">Wed</label>
        </div>
        <div class="radio-item">
            <input type="radio" id="thu_yes" name="thu" value="Y" required>
            <label class="radio-label" for="thu_yes">Yes</label>
            <input type="radio" id="thu_no" name="thu" value="N" required>
            <label class="radio-label" for="thu_no">No</label>
            <label for="thu">Thu</label>
        </div>
        <div class="radio-item">
            <input type="radio" id="fri_yes" name="fri" value="Y" required>
            <label class="radio-label" for="fri_yes">Yes</label>
            <input type="radio" id="fri_no" name="fri" value="N" required>
            <label class="radio-label" for="fri_no">No</label>
            <label for="fri">Fri</label>
        </div>
        <div class="radio-item">
            <input type="radio" id="sat_yes" name="sat" value="Y" required>
            <label class="radio-label" for="sat_yes">Yes</label>
            <input type="radio" id="sat_no" name="sat" value="N" required>
            <label class="radio-label" for="sat_no">No</label>
            <label for="sat">Sat</label>
        </div>
        <div class="radio-item">
            <input type="radio" id="sun_yes" name="sun" value="Y" required>
            <label class="radio-label" for="sun_yes">Yes</label>
            <input type="radio" id="sun_no" name="sun" value="N" required>
            <label class="radio-label" for="sun_no">No</label>
            <label for="sun">Sun</label>
        </div>
    </div>
        
        <label for="1A">1A:</label>
        <input type="text" id="1A" name="1A" required><br><br>
        
        <label for="2A">2A:</label>
        <input type="text" id="2A" name="2A" required><br><br>
        
        <label for="3A">3A:</label>
        <input type="text" id="3A" name="3A" required><br><br>
        
        <label for="SL">SL:</label>
        <input type="text" id="SL" name="SL" required><br><br>
        
        <label for="general">General:</label>
        <input type="text" id="general" name="general" required><br><br>
        
        <label for="ladies">Ladies:</label>
        <input type="text" id="ladies" name="ladies" required><br><br>
        
        <label for="tatkal">Tatkal:</label>
        <input type="text" id="tatkal" name="tatkal" required><br><br>
        
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>

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

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
        <h3>Seat Availability Form</h3>
        <a class="btn btn-primary" href="add_seat.php">Add Seat</a>
    </div>

    <!-- Displaying all trains -->
    <div class="span12 well">
        <div class="display" style="height:900px;">
        <h2>Seat Availability Form</h2>
    <form action="submit.php" method="POST">
    <label for="train_number">Train Number:</label>
    <input type="text" id="train_number" name="train_number" required><br><br>
    
    <label for="train_name">Train Name:</label>
    <input type="text" id="train_name" name="train_name" required><br><br>

    <div id="suggestions"></div>

    <script>
        $(document).ready(function(){
            // Function to fetch train suggestions
            function fetchSuggestions(input, callback){
                $.ajax({
                    url: 'fetch_train_suggestions.php',
                    type: 'GET',
                    data: { search_term: input },
                    dataType: 'json',
                    success: function(response){
                        callback(response);
                    }
                });
            }

            // Event listener for train number input field
            $('#train_number').on('input', function(){
                var input = $(this).val();
                fetchSuggestions(input, function(suggestions){
                    displaySuggestions(suggestions);
                });
            });

            // Event listener for train name input field
            $('#train_name').on('input', function(){
                var input = $(this).val();
                fetchSuggestions(input, function(suggestions){
                    displaySuggestions(suggestions);
                });
            });

            // Function to display suggestions
            function displaySuggestions(suggestions){
                var suggestionHTML = '';
                suggestions.forEach(function(suggestion){
                    suggestionHTML += '<p>Train Number: ' + suggestion.train_number + ', Train Name: ' + suggestion.train_name + '</p>';
                });
                $('#suggestions').html(suggestionHTML);
            }
        });
    </script>
        
        <label for="doj">Date of Journey (DOJ):</label>
        <input type="date" id="doj" name="doj" required><br><br>
        
        <label for="1A">1A:</label>
        <input type="number" id="1A" name="1A" min="0"><br><br>
        
        <label for="2A">2A:</label>
        <input type="number" id="2A" name="2A" min="0"><br><br>
        
        <label for="3A">3A:</label>
        <input type="number" id="3A" name="3A" min="0"><br><br>
        
        <label for="AC">AC:</label>
        <input type="number" id="AC" name="AC" min="0"><br><br>
        
        <label for="CC">CC:</label>
        <input type="number" id="CC" name="CC" min="0"><br><br>
        
        <label for="SL">SL:</label>
        <input type="number" id="SL" name="SL" min="0"><br><br>
        
        <input type="submit" value="Submit">
    </form>
        </div>
    </div>

    <?php
	include 'footer.php';
?>
</div>
</body>
</html>
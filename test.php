<?php
session_start();
$name1 = $_SESSION['name'];
$tbl_name = "booking";
require('firstimport.php');
mysqli_select_db($conn, "$db_name") or die("cannot select db");

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

    // Output the fetched data
    // echo "Class: $class<br>";
    // echo "1A: " . $trainListRow['1A'] . "<br>";
    // echo "2A: " . $trainListRow['2A'] . "<br>";
    // echo "3A: " . $trainListRow['3A'] . "<br>";
    // echo "SL: " . $trainListRow['SL'] . "<br>";


    $fare = 0;

    switch ($class) {
        case '1A':
            $fare = $trainListRow['1A']; // Assuming distance is known
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

    // Accumulate fare to total fare
    $totalFare += $fare;
}

// Multiply total fare by another value
//$additionalFactor = 1; // Example additional factor
// $totalFare += $fare;

echo "Total Fare: $totalFare<br>";
?>
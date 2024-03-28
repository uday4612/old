<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "railres";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching data from the form
$train_number = $_POST['train_number'];
$train_name = $_POST['train_name'];
$doj = $_POST['doj'];
$seats = array(
    '1A' => $_POST['1A'],
    '2A' => $_POST['2A'],
    '3A' => $_POST['3A'],
    'AC' => $_POST['AC'],
    'CC' => $_POST['CC'],
    'SL' => $_POST['SL']
);

// Inserting data into the database
$query = "INSERT INTO seats_availability (Train_No, Train_Name, doj, 1A, 2A, 3A, AC, CC, SL) VALUES ('$train_number', '$train_name', '$doj', ";
foreach ($seats as $seat => $availability) {
    $query .= "$availability, ";
}
$query = rtrim($query, ", "); // Removing trailing comma and space
$query .= ")";

$result = mysqli_query($conn, $query);

if ($result === TRUE) {
    echo '<script>alert("New record created successfully");</script>';
    echo '<script>window.location.href = "seat_a.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
mysqli_close($connection);
?>

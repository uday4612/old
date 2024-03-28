<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $number = $_POST['number'];
    $name = $_POST['name'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];
    $mon = $_POST['mon'];
    $tue = $_POST['tue'];
    $wed = $_POST['wed'];
    $thu = $_POST['thu'];
    $fri = $_POST['fri'];
    $sat = $_POST['sat'];
    $sun = $_POST['sun'];
    $class_1A = $_POST['1A'];
    $class_2A = $_POST['2A'];
    $class_3A = $_POST['3A'];
    $class_SL = $_POST['SL'];
    $class_general = $_POST['general'];
    $class_ladies = $_POST['ladies'];
    $class_tatkal = $_POST['tatkal'];
    
    // Connect to your database (replace these variables with your actual database credentials)
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

    // SQL query to insert data into the database
    $sql = "INSERT INTO train_list (Number, Name, Origin, Destination, Arrival, Departure, Mon, Tue, Wed, Thu, Fri, Sat, Sun, 1A, 2A, 3A, SL, General, Ladies, Tatkal)
    VALUES ('$number', '$name', '$origin', '$destination', '$arrival', '$departure', '$mon', '$tue', '$wed', '$thu', '$fri', '$sat', '$sun', '$class_1A', '$class_2A', '$class_3A', '$class_SL', '$class_general', '$class_ladies', '$class_tatkal')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully");</script>';
        echo '<script>window.location.href = "train_list.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "railres";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Get the user input
$search_term = $_GET['search_term'];

// Fetch train numbers and names from the database based on the user input
$query = "SELECT Number, Name FROM train_list WHERE Number LIKE '%$search_term%' OR Name LIKE '%$search_term%'";
$result = mysqli_query($conn, $query);

// Store the suggestions in an array
$suggestions = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $suggestions[] = array(
            'train_number' => $row['Number'],
            'train_name' => $row['Name']
        );
    }
} else {
    // If no train is found, return a message indicating so
    $suggestions[] = array(
        'not_found' => true
    );
}

// Convert the array to JSON and output it
echo json_encode($suggestions);

// Close database connection
mysqli_close($conn);
?>

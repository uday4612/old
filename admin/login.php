<?php
session_start();

$uname = $_POST['admin'];
$pass = $_POST['psd'];

require('firstimport.php');

$tbl_name = "users"; // Table name

mysqli_select_db($conn, $db_name) or die("cannot select DB");

$sql = "SELECT * FROM $tbl_name WHERE f_name='$uname' and password='$pass'";
$result = mysqli_query($conn, $sql) or trigger_error(mysql_error.$sql);

if(mysqli_num_rows($result) < 1) {
    $_SESSION['error'] = "1";
    header("location:login1.php");
    exit(); // Stop further execution
}

// Fetch user details including role
$row = mysqli_fetch_assoc($result);
$user_role = $row['role']; // Assuming 'role' is the column in your users table that stores the role information

if ($user_role !== 'admin') {
    // If the user is not an admin, redirect to login again
    echo '<script>alert("You are Not an Admin, Please head back and login in your Login Panel");</script>';
    echo '<script>window.location.href = "../index.php";</script>';
    exit(); // Stop further execution
}

// If the user is an admin, set the session and redirect to index.php
$_SESSION['name'] = $uname;
$_SESSION['role'] = 'admin';
header("location:index.php");
exit(); // Stop further execution
?>

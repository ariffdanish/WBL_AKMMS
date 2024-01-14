<?php
session_start();

// Connect to DB
include('dbconnect.php');

// Retrieve data from registration form
$fid = $_POST['fid'];
$fpwd = $_POST['fpwd'];

// CRUD Operations
// RETRIEVE - SQL retrieve statement with password hashing
$sql = "SELECT * FROM tb_employee WHERE e_id='$fid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

// Check if user exists and password is correct
if ($row && password_verify($fpwd, $row['e_pwd'])) {
    $_SESSION['e_id'] = session_id();
    $_SESSION['suid'] = $fid;

    // Redirect to corresponding page based on user role
    if ($row['e_role'] == 'Admin') {
        header('Location: dashboard.php');
    } else {
        header('Location: dashboard.php');
    }
} else {
    // User not available or incorrect password
    // Add script to let the user know either the username or password is wrong
    header('Location: index.php');
}

// Close DB Connection
mysqli_close($con);
?>
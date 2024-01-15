<?php
//parameters
$servername="localhost";
$username="root";
$password="";
$dbname="akmms_db";


//connection
$con=mysqli_connect($servername,$username,$password,$dbname);

// Verify connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$phpMailerHost = 'smtp.gmail.com';
$phpMailerUsername = 'ariffdanish055@gmail.com';
$phpMailerPassword = 'mfqc gddg sklf vxvi';


//verify connection

?>
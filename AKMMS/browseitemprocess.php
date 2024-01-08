<?php
include ('mysession.php');
if(!session_id())
{
    session_start();
}
// Connect to DB
include('dbconnect.php');

// Retrieve data from additem.php form
$icode = $_POST['icode'];
$iname = $_POST['iname'];
$idesc = $_POST['idesc'];
$iquantity = $_POST['iquantity'];
$iprice = $_POST['iprice'];

// CRUD Operations
// UPDATE - SQL Update statement
$sqld = "SELECT i_Code, i_Name, i_Desc, i_Quantity, i_Price
         FROM tb_item";
         
// EXECUTE SQL
mysqli_query($con, $sqld);

// CLOSE DB Connection
mysqli_close($con);

// Redirect back to browseitem.php
header('Location:browseitem.php');
?>

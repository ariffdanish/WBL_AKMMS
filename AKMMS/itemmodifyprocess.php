<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

$icode = $_POST['icode'];
$iname = $_POST['iname'];
$idesc = $_POST['idesc'];
$iquantity = $_POST['iquantity'];
$iprice = $_POST['iprice'];

// 1. Get item quantity from table
$sqlp = "SELECT i_Quantity
        FROM tb_item
        WHERE i_Code = ?";

$stmt = mysqli_prepare($con, $sqlp);

// Bind parameters
mysqli_stmt_bind_param($stmt, "s", $icode);

// Execute statement
mysqli_stmt_execute($stmt);

// Bind result variables
mysqli_stmt_bind_result($stmt, $updquantity);

// Fetch value
mysqli_stmt_fetch($stmt);

// Close statement
mysqli_stmt_close($stmt);

// 2. Calculate total quantity
$totalquantity = $updquantity + $iquantity;

// CRUD: Update Current Item
$sql = "UPDATE tb_item
        SET i_Name = ?, i_Desc = ?, i_Quantity = ?, i_Price = ?
        WHERE i_Code = ?";

$stmt = mysqli_prepare($con, $sql);

// Bind parameters
mysqli_stmt_bind_param($stmt, "ssids", $iname, $idesc, $totalquantity, $iprice, $icode);

// Execute statement
mysqli_stmt_execute($stmt);

// Close statement
mysqli_stmt_close($stmt);

mysqli_close($con);

// Redirect to next page
header('Location:browseitem.php');
?>
<div class="container">
    <h5>Your updated item details</h5><br><br>
    <h5>Code: <?php echo $icode; ?></h5>
    <h5>Name: <?php echo $iname; ?></h5>
    <h5>Description: <?php echo $idesc; ?></h5>
    <h5>New Quantity: <?php echo $totalquantity; ?></h5>
    <h5>New Price: <?php echo $iprice; ?></h5>
    <h5>Status: Complete</h5>
</div>

<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

$icode = $_POST['icode'];
$iname = $_POST['iname'];
$idesc = $_POST['idesc'];
$icategory = $_POST['icategory'];
$imaterial = $_POST['imaterial'];
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
        SET i_Name = ?, i_Desc = ?, i_Category = ?, i_Material = ?, i_Quantity = ?, i_Price = ?
        WHERE i_Code = ?";

$stmt = mysqli_prepare($con, $sql);

// Bind parameters
mysqli_stmt_bind_param($stmt, "ssssids", $iname, $idesc, $icategory, $imaterial, $totalquantity, $iprice, $icode);

// Execute statement
mysqli_stmt_execute($stmt);

// Close statement
mysqli_stmt_close($stmt);

mysqli_close($con);

// Display Result
include 'headerNav.php';
?>
<div class="container" style="margin-top: 20px; padding: 20px;">
    <table class="table">
        <tr>
            <td><strong>Code: </strong></td>
            <td><?php echo $icode; ?></td>
        </tr>
        <tr>
            <td><strong>Name: </strong></td>
            <td><?php echo $iname; ?></td>
        </tr>
        <tr>
            <td><strong>Description: </strong></td>
            <td><?php echo $idesc; ?></td>
        </tr>
        <tr>
            <td><strong>Category: </strong></td>
            <td><?php echo $icategory; ?></td>
        </tr>
        <tr>
            <td><strong>Type: </strong></td>
            <td><?php echo $imaterial; ?></td>
        </tr>
        <tr>
            <td><strong>Total Quantity: </strong></td>
            <td><?php echo $totalquantity; ?></td>
        </tr>
        <tr>
            <td><strong>Price: </strong></td>
            <td><?php echo $iprice; ?></td>
        </tr>
    </table>
    <a class="btn btn-danger" href="browseitem.php">Back</a>
</div>

<?php include 'footer.php'; ?>
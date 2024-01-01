<?php
include('mysession.php');
if (!session_id()) 
{
    session_start();
}
include('dbconnect.php');

// retrieve data from form and session
$Ord_name = $_POST['Ord_name'];
$Ord_date = $_POST['Ord_date'];
$Ord_type = $_POST['Ord_type'];
$Ord_itemName = $_POST['Ord_itemName'];
$Ord_itemMaterial = $_POST['Ord_itemMaterial'];
$Ord_itemHeight = $_POST['Ord_itemHeight'];
$Ord_itemWidth = $_POST['Ord_itemWidth'];
$Ord_itemDepth = $_POST['Ord_itemDepth'];
$Ord_itemLength = $_POST['Ord_itemLength'];
$Ord_itemQuantity = $_POST['Ord_itemQuantity'];

$fbid=$_GET['fbid'];


// Insert New Customer
$sql = "INSERT INTO tb_order(Ord_name, Ord_date, Ord_type, Ord_itemName, Ord_itemMaterial, Ord_itemHeight, Ord_itemWidth, Ord_itemDepth, Ord_itemLength, Ord_itemQuantity)
        VALUES('$Ord_name', '$Ord_date', '$Ord_type', '$Ord_itemName ', '$Ord_itemMaterial', '$Ord_itemHeight', '$Ord_itemWidth', '$Ord_itemDepth', '$Ord_itemLength', '$Ord_itemQuantity')
        WHERE c_id=$fbid";

$result=mysqli_query($con,$sql);
mysqli_close($con);

// Display Result
include 'headerNav.php';
?>

<div class="container" style="margin-top: 20px; padding: 20px;">
    <table class="table">
        <tr>
            <td><strong>Order Name :</strong></td>
            <td><?php echo $cidnum; ?></td>
        </tr>
        <tr>
            <td><strong>Date :</strong></td>
            <td><?php echo $cname; ?></td>
        </tr>
        <tr>
            <td><strong>Order Type:</strong></td>
            <td><?php echo $cphone; ?></td>
        </tr>
        <tr>
            <td><strong>Item :</strong></td>
            <td><?php echo $caddress; ?></td>
        </tr>
        <tr>
            <td><strong>Material :</strong></td>
            <td><?php echo $cemail; ?></td>
        </tr>
        <tr>
            <td><strong>Quantity :</strong></td>
            <td><?php echo $ctype; ?></td>
        </tr>
    </table>
    <a class="btn btn-danger" href="customerorderformADV.php">Back</a>
</div>



<?php include 'footer.php'; ?>

<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

    // Order Information
    $fbid = $_POST['fbid'];
    $Ord_name = $_POST['Ord_name'];
    $Ord_cid = $_POST['Ord_cid'];
    $Ord_date = $_POST['Ord_date'];
    $Ord_type = $_POST['Ord_type'];
    $Ord_itemName = $_POST['Ord_itemName'];
    $Ord_itemMaterial = $_POST['Ord_itemMaterial'];
    $Ord_itemHeight = $_POST['Ord_itemHeight'];
    $Ord_itemWidth = $_POST['Ord_itemWidth'];
    $Ord_itemDepth = $_POST['Ord_itemDepth'];
    $Ord_itemLength = $_POST['Ord_itemLength'];
    $Ord_itemQuantity = $_POST['Ord_itemQuantity'];

    if (!empty($fbid)) {
        $sql = "UPDATE tb_order
                SET Ord_name='$Ord_name', Ord_cid='$Ord_cid', Ord_date='$Ord_date', Ord_type='$Ord_type', Ord_itemName='$Ord_itemName', 
                    Ord_itemMaterial='$Ord_itemMaterial', Ord_itemHeight='$Ord_itemHeight',Ord_itemWidth='$Ord_itemWidth', Ord_itemDepth='$Ord_itemDepth', 
                    Ord_itemLength='$Ord_itemLength', Ord_itemQuantity='$Ord_itemQuantity'
                WHERE Ord_id='$fbid'";
    } else {
        $sql = "INSERT INTO tb_order (Ord_name, Ord_cid, Ord_date, Ord_type, Ord_itemName, Ord_itemMaterial, Ord_itemHeight, Ord_itemWidth, Ord_itemDepth, Ord_itemLength, Ord_itemQuantity) 
                VALUES ('$Ord_name', '$Ord_cid', '$Ord_date', '$Ord_type', '$Ord_itemName', '$Ord_itemMaterial', '$Ord_itemHeight', '$Ord_itemWidth', '$Ord_itemDepth', '$Ord_itemLength', '$Ord_itemQuantity')";
    }

mysqli_query($con, $sql);

mysqli_close($con);

include 'headerNav.php';
?>



<div class="container" style="margin-top: 20px; padding: 20px;">
    <table class="table">
        <tr>
            <td><strong>Order Name :</strong></td>
            <td><?php echo $Ord_name; ?></td>
        </tr>
        <tr>
            <td><strong>Date :</strong></td>
            <td><?php echo $Ord_date; ?></td>
        </tr>
        <tr>
            <td><strong>Order Type:</strong></td>
            <td><?php echo $Ord_type; ?></td>
        </tr>
        <tr>
            <td><strong>Item :</strong></td>
            <td><?php echo $Ord_itemName; ?></td>
        </tr>
        <tr>
            <td><strong>Material :</strong></td>
            <td><?php echo $Ord_itemMaterial; ?></td>
        </tr>
        <tr>
            <td><strong>Quantity :</strong></td>
            <td><?php echo $Ord_itemQuantity; ?></td>
        </tr>
    </table>
    <a class="btn btn-danger" href="customerorderADV.php">Back</a>
</div>



<?php include 'footer.php'; ?>

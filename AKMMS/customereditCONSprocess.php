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

    if (!empty($fbid)) {
        $sql = "UPDATE tb_order
                SET Ord_name='$Ord_name', Ord_cid='$Ord_cid', Ord_date='$Ord_date', Ord_type='$Ord_type'
                WHERE Ord_id='$fbid'";
    } else {
        $sql = "INSERT INTO tb_order (Ord_name, Ord_cid, Ord_date, Ord_type) 
                VALUES ('$Ord_name', '$Ord_cid', '$Ord_date', '$Ord_type')";
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
        
    </table>
    <a class="btn btn-danger" href="customerorderCONS.php">Back</a>
</div>



<?php include 'footer.php'; ?>

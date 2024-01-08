<?php
include ('mysession.php');
if(!session_id())
{
    session_start();
}
    include 'headerNav.php';
    include('dbconnect.php');

    // Order Information
    $p_status = $_POST['p_status'];
    $p_ordID = $_POST['p_ordID'];
    $p_amount = $_POST['p_amount'];
    $p_date = $_POST['p_date'];


// Insert into tb_order using the obtained c_idnum
$sql = "INSERT INTO tb_payment (p_ordID, p_status, p_amount, p_date) 
        VALUES ('$p_ordID', '$p_status', '$p_amount', '$p_date')";

mysqli_query($con, $sql);

    // Close the database connection
    mysqli_close($con);
?>



<div class="container" style="margin-top: 20px; padding: 20px;">
    <table class="table">
        <tr>
            <td><strong>Order ID :</strong></td>
            <td><?php echo $p_ordID; ?></td>
        </tr>
        <tr>
            <td><strong>Status Payment :</strong></td>
            <td><?php echo $p_status; ?></td>
        </tr>

        <tr>
            <td><strong>Amount Payment (RM) :</strong></td>
            <td><?php echo $p_amount; ?></td>
        </tr>

        <tr>
            <td><strong>Date of payment  :</strong></td>
            <td><?php echo $p_date; ?></td>
        </tr>

    </table>
    <a class="btn btn-danger" href="payment.php">Back</a>
</div>



<?php include 'footer.php'; ?>

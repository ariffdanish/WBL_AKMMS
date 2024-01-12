<?php
    include('mysession.php');
    if (!session_id()) 
    {
        session_start();
    }
    include('dbconnect.php');
    include 'headerNav.php';

    // Order Information
    $fbid = $_POST['fbid'];
    $p_status = $_POST['p_status'];
    $p_ordID = $_POST['p_ordID'];
    $p_amount = $_POST['p_amount'];
    $p_date = $_POST['p_date'];
    $p_proof = $_POST['p_proof'];

    if (!empty($fbid)) {
        $sql = "UPDATE tb_payment
                SET p_ordID='$p_ordID', p_status='$p_status', p_amount='$p_amount', p_date='$p_date', p_proof='$p_proof'
                WHERE p_id='$fbid'";
    } else {
        // Insert into tb_order using the obtained c_idnum
        $sql = "INSERT INTO tb_payment (p_ordID, p_status, p_amount, p_date, p_proof) 
        VALUES ('$p_ordID', '$p_status', '$p_amount', '$p_date', '$p_proof')";
    }

    mysqli_query($con, $sql);
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

        <tr>
            <td><strong>Proof of payment  :</strong></td>
            <td><?php echo $p_proof; ?></td>
        </tr>

    </table>
    <a class="btn btn-danger" href="payment.php">Back</a>
</div>



<?php include 'footer.php'; ?>

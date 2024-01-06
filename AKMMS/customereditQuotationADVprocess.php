<?php
    include('mysession.php');
    if (!session_id()) {
        session_start();
    }
    include('dbconnect.php');

    // Order Information
    $fbid = $_POST['fbid'];
    $q_itemDesc = $_POST['q_itemDesc'];
    $q_ordID = $_POST['q_ordID'];
    $q_quantity = $_POST['q_quantity'];
    $q_price = $_POST['q_price'];
    $q_discount = $_POST['q_discount'];
    $q_tax = $_POST['q_tax'];
    $q_totalcost = $_POST['q_totalcost'];

    if (!empty($fbid)) {
        $sql = "UPDATE tb_quotation
                SET q_ordID='$q_ordID', q_itemDesc='$q_itemDesc', q_quantity='$q_quantity', 
                    q_price='$q_price', q_discount='$q_discount', q_tax='$q_tax', q_totalcost='$q_totalcost'
                WHERE q_id='$fbid'";
    } else {
        $sql = "INSERT INTO tb_quotation (q_ordID, q_itemDesc, q_quantity, q_price, q_discount, q_tax, q_totalcost) 
        VALUES ('$q_ordID', '$q_itemDesc', '$q_quantity', '$q_price', '$q_discount', '$q_tax', '$q_totalcost')";
    }

    mysqli_query($con, $sql);

    // Close the database connection
    mysqli_close($con);

    include 'headerNav.php';
?>



<div class="container" style="margin-top: 20px; padding: 20px;">
    <table class="table">
        <tr>
            <td><strong>Order ID :</strong></td>
            <td><?php echo $q_ordID; ?></td>
        </tr>
        <tr>
            <td><strong>Item Description :</strong></td>
            <td><?php echo $q_itemDesc; ?></td>
        </tr>

        <tr>
            <td><strong>Quantity :</strong></td>
            <td><?php echo $q_quantity; ?></td>
        </tr>

        <tr>
            <td><strong>Unit Price (RM) :</strong></td>
            <td><?php echo $q_price; ?></td>
        </tr>

        <tr>
            <td><strong>Discount (RM) :</strong></td>
            <td><?php echo $q_discount; ?></td>
        </tr>

        <tr>
            <td><strong>Tax (RM) :</strong></td>
            <td><?php echo $q_tax; ?></td>
        </tr>

        <tr>
            <td><strong>Total Cost Inc. Tax (RM) :</strong></td>
            <td><?php echo $q_totalcost; ?></td>
        </tr>

    </table>
    <a class="btn btn-danger" href="customerQuotationADV.php">Back</a>
</div>



<?php include 'footer.php'; ?>

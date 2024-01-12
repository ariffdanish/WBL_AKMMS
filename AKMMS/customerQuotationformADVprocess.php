<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('headerNav.php');
include('dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $q_ordID = $_POST['q_ordID'];
    $q_itemDesc = $_POST['q_itemDesc'];
    $q_codeID = $_POST['q_codeID'];
    $q_quantity = $_POST['q_quantity'];
    $q_price = $_POST['q_price'];
    $q_discount = $_POST['q_discount'];
    $q_tax = $_POST['q_tax'];

    // Calculate total cost including tax
    $q_totalcost = $q_quantity * ($q_price - $q_discount) * (1 + ($q_tax / 100));

    // Insert data into tb_quotation table
    $insertQuotationSQL = "INSERT INTO tb_quotation (q_ordID, q_itemDesc, q_codeID, q_quantity, q_price, q_discount, q_tax, q_totalcost)
                           VALUES ('$q_ordID', '$q_itemDesc', '$q_codeID', '$q_quantity', '$q_price', '$q_discount', '$q_tax', '$q_totalcost')";
    $resultQuotation = mysqli_query($con, $insertQuotationSQL);

    if ($resultQuotation) {
        // Deduct the quantity from tb_item
        $updateItemSQL = "UPDATE tb_item SET i_Quantity = i_Quantity - $q_quantity WHERE i_CodeID = '$q_codeID'";
        $resultUpdateItem = mysqli_query($con, $updateItemSQL);
    }
}

mysqli_close($con);
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

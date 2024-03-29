<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('headerNav.php');
include('dbconnect.php');

// Order Information
$Ord_name = $_POST['Ord_name'];
$Ord_cid = $_POST['Ord_cid'];
$Ord_date = $_POST['Ord_date'];
$Ord_type = $_POST['Ord_type'];

// Check if order name already exists for the specified customer
$sqlCheck = "SELECT COUNT(*) as count FROM tb_order WHERE Ord_name = '$Ord_name' AND Ord_cid = '$Ord_cid'";
$resultCheck = mysqli_query($con, $sqlCheck);
$rowCheck = mysqli_fetch_assoc($resultCheck);

if ($rowCheck['count'] > 0) {
    // If order name already exists for the specified customer, display an alert and a back button
    ?>

    <div class="container" style="margin-top: 20px; padding: 20px; text-align: center;">
        <div class="alert alert-danger" role="alert">
            Order name already exists for this customer ! 
        </div>
        <a class="btn btn-danger" href="customerorderformADV.php">Back</a>
    </div>

    <?php
} else {
    // Insert into tb_order using the obtained c_idnum
    $sql = "INSERT INTO tb_order (Ord_name, Ord_cid, Ord_date, Ord_type) 
            VALUES ('$Ord_name', '$Ord_cid', '$Ord_date', '$Ord_type')";

    mysqli_query($con, $sql);

    // Close the database connection
    mysqli_close($con);
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
        <a class="btn btn-danger" href="customerorderADV.php">Back</a>
    </div>

    <?php include 'footer.php';
}
?>

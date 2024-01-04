<?php

include('mysession.php');
if (!session_id()) {
    session_start();
}

//Get booking ID from URL
if (isset($_GET['icode'])) {
    $icode = $_GET['icode'];
}
include('dbconnect.php');

//Retrieve booking data
$sqlr ="SELECT i_Code, i_Name, i_Desc, i_Quantity, i_Price
            FROM tb_item
            WHERE i_Code= '$icode'";
//Execute
$resultr = mysqli_query($con, $sqlr);
$rowr = mysqli_fetch_array($resultr);


include 'headerNav.php';
?>

<div class="container-fluid">
    <h3 class="text-dark mb-4">Modify Item</h3>
    <div class="card shadow">
        <div class="card-header py-3">

        <form method="POST" action="itemmodifyprocess.php">

            <?php
            $sql = "SELECT * FROM tb_item";
            $result = mysqli_query($con, $sql);
            ?>

            <div class="form-group">
                <label for="icode" class="form-label mt-4">Enter Item Code</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Code'] . '" name="icode" class="form-control" id="ic" placeholder="Same as the Selected Item" required>'
                ?>
            </div>

            <div class="form-group">
                <label for="iname" class="form-label mt-4">Enter Item New Name</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Name'] . '" name="iname" class="form-control" id="ic" placeholder="New Item Name" required>'
                ?>
            </div>

            <div class="form-group">
                <label for="idesc" class="form-label mt-4">Enter Item New Description</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Desc'] . '" name="idesc" class="form-control" id="ic" placeholder="New Item Description" required>'
                ?>
            </div>

            <div class="form-group">
            <label for="iquantity" class="form-label mt-4">Add Item Quantity</label>
            <?php
                echo '<input type="text" value="0" name="iquantity" class="form-control" id="ic" placeholder="Add Quantity to the Item" oninput="validateQuantity(this)" required>';
            ?>
            </div>

            <div class="form-group">
                <label for="iprice" class="form-label mt-4">Update Item Price</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Price'] . '" name="iprice" class="form-control" id="ic" placeholder="Update Price of Item" required>'
                ?>
            </div>

            <br>
            <div class="mb-3 d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-warning">Modify</button>
            <button type="reset" class="btn btn-dark">Reset</button>
            <a type="cancel" class="btn btn-danger" href="browseitem.php">Cancel</a>
            </div>
            </form>
            </div>
        </div>
</div><br><br><br>
<?php include 'footer.php';?>

<script>
    function validateQuantity(input) {
        // Parse the input value as a number
        var quantity = parseInt(input.value);

        // Check if the quantity is a number and not negative
        if (isNaN(quantity) || quantity < 0) {
            // If it's negative or not a number, set the value to 0
            input.value = 0;
        }
    }
</script>
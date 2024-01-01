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
$sqlr = "SELECT * FROM tb_item LEFT JOIN tb_order ON tb_item.i_Code = tb_order.i_Code";

//Execute
$resultr = mysqli_query($con, $sqlr);
$rowr = mysqli_fetch_array($resultr);


include 'headerNav.php';
?>

<div class="container">

    <form method="POST" action="itemmodifyprocess.php">

        <fieldset><br>
            <legend>Modify Item</legend>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Select item</label>
                <?php
                echo '<input type="hidden" value="' . $rowr['i_Code'] . '"name"icode">';
                $sql = "SELECT * FROM tb_item";
                $result = mysqli_query($con, $sql);

                echo '<select class="form-select" name="icode" id="exampleSelect1">';
                while ($row = mysqli_fetch_array($result)) {

                    if ($row['i_Code'] == $rowr['i_Code']) {
                        echo "<option selected ='selected' value '" . $row['i_Code'] . "'>" . $row['i_Name'] . ", " . $row['i_Desc'] . ", " . $row['i_Quantity'] . ", RM" . $row['i_Price'] . "</option>";
                    } else {
                        echo "<option value = '" . $row['i_Code'] . "'>" . $row['i_Name'] . ", " . $row['i_Desc'] . ", " . $row['i_Quantity'] . ", RM" . $row['i_Price'] . "</option>";
                    }
                }
                echo '</select>';
                ?>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Enter Code</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Code'] . '" name="icode" class="form-control" id="ic" placeholder="Item Code" required>'
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Enter Item's New Name</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Name'] . '" name="iname" class="form-control" id="ic" placeholder="New Item Name" required>'
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Enter Item's New Description</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Desc'] . '" name="idesc" class="form-control" id="ic" placeholder="New Item Description" required>'
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Update Item Quantity</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Quantity'] . '" name="iquantity" class="form-control" id="ic" placeholder="Add Quantity to the Item" required>'
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Update Item Price</label>
                <?php
                echo '<input type="text" value="' . $rowr['i_Price'] . '" name="iprice" class="form-control" id="ic" placeholder="Update Price of Item" required>'
                ?>
            </div>

            <br>

            <button type="submit" class="btn btn-warning">Modify</button>
            <button type="reset" class="btn btn-dark">Reset</button>

        </fieldset><br><br>
    </form>
    <br><br>
</div><br><br><br>
<?php include 'footer.php';?>
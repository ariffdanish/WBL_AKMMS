<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}

// Get item code from URL
if (isset($_GET['icode'])) {
    $icode = $_GET['icode'];
}
include('dbconnect.php');

// Retrieve item data
$sqlr = "SELECT i_Code, i_Name, i_Desc, i_Category, i_Material, i_Quantity, i_Price
        FROM tb_item
        WHERE i_Code= '$icode'";

// Execute
$resultr = mysqli_query($con, $sqlr);
$rowr = mysqli_fetch_array($resultr);

include 'headerNav.php';
?>

<div class="container-fluid">
    <h3 class="text-dark mb-4">Modify Item</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <form method="POST" action="itemmodifyprocess.php">

                <div class="form-group">
                    <label for="icode" class="form-label mt-4">Enter Item Code</label>
                    <?php
                    echo '<input type="text" value="' . $rowr['i_Code'] . '" name="icode" class="form-control" id="ic" placeholder="Same as the Selected Item" required>';
                    ?>
                </div>

                <div class="form-group">
                    <label for="iname" class="form-label mt-4">Enter Item New Name</label>
                    <?php
                    echo '<input type="text" value="' . $rowr['i_Name'] . '" name="iname" class="form-control" id="ic" placeholder="New Item Name" required>';
                    ?>
                </div>

                <div class="form-group">
                    <label for="idesc" class="form-label mt-4">Enter Item New Description</label>
                    <?php
                    echo '<input type="text" value="' . $rowr['i_Desc'] . '" name="idesc" class="form-control" id="ic" placeholder="New Item Description" required>';
                    ?>
                </div>

                <div class="form-group">
                    <label for="icategory" class="form-label mt-4">Update Item Category</label>
                    <?php
                    // Assuming you have a query to fetch categories from the database
                    $sqlCategory = "SELECT DISTINCT i_Category FROM tb_item";
                    $resultCategory = mysqli_query($con, $sqlCategory);

                    echo '<select class="form-select" id="icategory" placeholder="Select" name="icategory">';
                    while ($categoryRow = mysqli_fetch_assoc($resultCategory)) {
                        $selected = ($rowr['i_Category'] == $categoryRow['i_Category']) ? 'selected' : '';
                        echo "<option $selected>{$categoryRow['i_Category']}</option>";
                    }
                    echo '</select>';
                    ?>
                </div>

                <div class="form-group">
                    <label for="imaterial" class="form-label mt-4">Update Item Material</label>
                    <?php
                    // Assuming you have a query to fetch materials from the database
                    $sqlMaterial = "SELECT DISTINCT i_Material FROM tb_item";
                    $resultMaterial = mysqli_query($con, $sqlMaterial);

                    echo '<select class="form-select" id="imaterial" placeholder="Select" name="imaterial">';
                    while ($materialRow = mysqli_fetch_assoc($resultMaterial)) {
                        $selected = ($rowr['i_Material'] == $materialRow['i_Material']) ? 'selected' : '';
                        echo "<option $selected>{$materialRow['i_Material']}</option>";
                    }
                    echo '</select>';
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
                    echo '<input type="text" value="' . $rowr['i_Price'] . '" name="iprice" class="form-control" id="ic" placeholder="Update Price of Item" required>';
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

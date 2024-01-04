<?php include 'headerNav.php'; ?>

<div class="container-fluid">
    <h3 class="text-dark mb-4">View Item Details</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Item Info</p>
        </div>
        <div class="card-body">
            <?php
            // Connect to DB
            include('dbconnect.php');

            // Retrieve selected item data
            if (isset($_GET['icode'])) {
                $itemCode = $_GET['icode'];

                $sqlSelect = "SELECT * FROM tb_item WHERE i_Code = '$itemCode'";
                $result = mysqli_query($con, $sqlSelect);

                if ($row = mysqli_fetch_assoc($result)) {
                    echo "<p><strong>Code :</strong> " . $row['i_Code'] . "</p>";
                    echo "<p><strong>Name :</strong> " . $row['i_Name'] . "</p>";
                    echo "<p><strong>Description :</strong> " . $row['i_Desc'] . "</p>";
                    echo "<p><strong>Category :</strong> " . $row['i_Category'] . "</p>";
                    echo "<p><strong>Height :</strong> " . number_format($row['i_Height'], 2) . " cm</p>";
                    echo "<p><strong>Width :</strong> " . number_format($row['i_Width'], 2) . " cm</p>";
                    echo "<p><strong>Depth :</strong> " . number_format($row['i_Depth'], 2) . " cm</p>";
                    echo "<p><strong>Length :</strong> " . number_format($row['i_Length'], 2) . " cm</p>";
                    echo "<p><strong>Weight :</strong> " . number_format($row['i_Weight'], 2) . " kg</p>";
                    echo "<p><strong>Material :</strong> " . $row['i_Material'] . "</p>";
                    echo "<p><strong>Quantity :</strong> " . $row['i_Quantity'] . "</p>";
                    echo "<p><strong>Price :</strong> RM" . number_format($row['i_Price'], 2) . " per unit</p>";

                    // Option buttons to modify or delete
                    echo '<div class="mb-3 d-flex justify-content-center gap-2">';
                    echo '<button class="btn btn-warning" onclick="modifyItem(\'' . $row['i_Code'] . '\')">Modify</button>';
                    echo '&nbsp;';
                    echo '<button class="btn btn-danger" onclick="deleteItem(\'' . $row['i_Code'] . '\')">Delete</button>';
                    echo '&nbsp;';
                    echo '<a type="cancel" class="btn btn-dark" href="browseitem.php">Back</a>';
                    echo '</div>';
                } else {
                    echo "<p>Item not found.</p>";
                }
            } else {
                echo "<p>No item code provided.</p>";
            }

            // Close DB Connection
            mysqli_close($con);
            ?>
        </div>
    </div>
</div>

<script>
    // JavaScript function to confirm item deletion
    function deleteItem(itemCode) {
        var confirmDelete = confirm("Are you sure you want to delete this item?");
        if (confirmDelete) {
            // If user confirms, redirect to deleteitem.php with the item code
            window.location.href = 'deleteitem.php?icode=' + itemCode;
        }
    }

    // JavaScript function to redirect to itemmodify.php with item code
    function modifyItem(itemCode) {
        window.location.href = 'itemmodify.php?icode=' + itemCode;
    }
</script>

<?php include 'footer.php'; ?>

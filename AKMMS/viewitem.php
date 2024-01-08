<?php
include ('mysession.php');
if(!session_id())
{
    session_start();
}
// Include database connection
include('dbconnect.php');

// Check if the item code is provided in the URL
if (isset($_GET['icode'])) {
    // Get the item code from the URL
    $itemCode = $_GET['icode'];

    // Query to retrieve all details of the selected item
    $sqlSelect = "SELECT * FROM tb_item WHERE i_Code = '$itemCode'";
    $result = mysqli_query($con, $sqlSelect);

    // Check if the query was successful
    if ($result) {
        // Fetch the item details
        $itemDetails = mysqli_fetch_assoc($result);
    } else {
        // Handle the case where the query failed
        echo "Error: " . mysqli_error($con);
        exit();
    }
} else {
    // Handle the case where item code is not provided
    echo "Item code not provided!";
    exit();
}

// Close the database connection
mysqli_close($con);
?>

<!-- HTML to display the item details -->
<?php include 'headerNav.php'; ?>

<div class="container">
    <h3 class="text-dark mb-4">Item Details</h3>

    <table class="table">
        <tbody>
            <tr>
                <th>Item Code</th>
                <td><?php echo $itemDetails['i_Code']; ?></td>
            </tr>
            <tr>
                <th>Item Added</th>
                <td><?php echo $itemDetails['i_Date']; ?></td>
            </tr>
            <tr>
                <th>Item Name</th>
                <td><?php echo $itemDetails['i_Name']; ?></td>
            </tr>
            <tr>
                <th>Item Description</th>
                <td><?php echo $itemDetails['i_Desc']; ?></td>
            </tr>
            <tr>
                <th>Item Category</th>
                <td><?php echo $itemDetails['i_Category']; ?></td>
            </tr>
            <tr>
                <th>Item Material</th>
                <td><?php echo $itemDetails['i_Material']; ?></td>
            </tr>
            <tr>
                <th>Item Quantity</th>
                <td><?php echo $itemDetails['i_Quantity']; ?></td>
            </tr>
            <tr>
                <th>Item Price (RM)</th>
                <td><?php echo number_format($itemDetails['i_Price'], 2); ?></td>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>";
                echo '<button class="btn btn-warning" onclick="modifyItem(\'' . $row['i_Code'] . '\')">Modify</button>';
                echo '&nbsp;';
                echo '<button class="btn btn-danger" onclick="deleteItem(\'' . $row['i_Code'] . '\')">Delete</button>';
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
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



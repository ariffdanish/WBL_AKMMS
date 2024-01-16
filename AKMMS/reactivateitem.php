<?php
// Connect to DB
include('dbconnect.php');

// Check if the item code is provided in the URL
if (isset($_GET['icode'])) {
    // Get the item code from the URL
    $itemCode = $_GET['icode'];

    // Reactivate the item in the database
    $reactivateQuery = "UPDATE tb_item SET i_Status = '1' WHERE i_Code = '$itemCode'";
    $resultReactivate = mysqli_query($con, $reactivateQuery);

    if ($resultReactivate) {
        // Success message (you can customize this)
        echo "Item reactivated successfully";
    } else {
        // Error message (you can customize this)
        echo "Error reactivating item: " . mysqli_error($con);
    }
} else {
    // Invalid request
    echo "Invalid request";
}

// Close the database connection
mysqli_close($con);
?>

<?php
// Include your database connection here
include("dbconnect.php");

// Check if the parameters are set
if (isset($_GET['icode']) ) {
    $itemcode = $_GET['icode'];
    
    // Update the item status in the database
    $updateQuery = "UPDATE tb_item SET i_Status = '2' WHERE i_Code = '$itemcode'";
    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        // Success message (you can customize this)
        echo "Item removed successfully";
    } else {
        // Error message (you can customize this)
        echo "Error removing item: " . mysqli_error($con);
    }
} else {
    // Invalid request
    echo "Invalid request";
}

// Close the database connection
mysqli_close($con);
?>
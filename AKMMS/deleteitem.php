<?php
// Connect to DB
include('dbconnect.php');

if (isset($_GET['icode'])) {
    $icode = $_GET['icode'];

    // SQL to delete the item with the specified code
    $sqlDelete = "DELETE FROM tb_item WHERE i_Code = '$icode'";
    
    // Execute the SQL query
    if (mysqli_query($con, $sqlDelete)) {
        echo "Item deleted successfully.";
    } else {
        echo "Error deleting item: " . mysqli_error($con);
    }
    
    // Close DB Connection
    mysqli_close($con);
} else {
    echo "Item code not provided.";
}

// Redirect back to browseitem.php
header('Location: browseitem.php');
?>

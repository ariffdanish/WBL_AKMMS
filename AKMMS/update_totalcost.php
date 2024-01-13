<?php
// Include your database connection here
include("dbconnect.php");

// Check if the parameters are set
if (isset($_GET['q_id'])) {
    $q_id = $_GET['q_id']; // Fix: Use $q_id instead of $employeeId
    
    // Update the total cost in the database
    $updateQuery = "UPDATE tb_quotation SET q_totalcost = 0 WHERE q_id = '$q_id'";
    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        // Success message (you can customize this)
        echo "Total cost updated successfully";
    } else {
        // Error message (you can customize this)
        echo "Error updating total cost: " . mysqli_error($con);
    }
} else {
    // Invalid request
    echo "Invalid request";
}

// Close the database connection
mysqli_close($con);
?>

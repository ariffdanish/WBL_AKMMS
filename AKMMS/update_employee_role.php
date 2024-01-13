<?php
// Include your database connection here
include("dbconnect.php");

// Check if the parameters are set
if (isset($_GET['e_id']) ) {
    $employeeId = $_GET['e_id'];
    
    // Update the employee role in the database
    $updateQuery = "UPDATE tb_employee SET e_role = '3' WHERE e_id = '$employeeId'";
    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        // Success message (you can customize this)
        echo "Employee role updated successfully";
    } else {
        // Error message (you can customize this)
        echo "Error updating employee role: " . mysqli_error($con);
    }
} else {
    // Invalid request
    echo "Invalid request";
}

// Close the database connection
mysqli_close($con);
?>

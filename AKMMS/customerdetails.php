<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
include 'headerNav.php';

// Check if the customer ID is provided and valid
if (isset($_GET['id'])) {
    $customerId = $_GET['id'];

    // Perform a soft delete by updating c_is_deleted to 1
    $updateSql = "UPDATE tb_customer SET c_is_deleted = 1 WHERE c_id = '$customerId'";
    $updateResult = mysqli_query($con, $updateSql);

    if (!$updateResult) {
        // Handle the error if the update query fails
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Fetch non-deleted records
$sql = "SELECT * FROM tb_customer WHERE c_is_deleted = 0";
$result = mysqli_query($con, $sql);
?>

<div class="container-fluid">
<div class="card shadow p-3 mb-4 bg-primary text-white">
    <div class="d-sm-flex justify-content-center align-items-center">
        <h6 class="text-white mb-0 font-weight-bold bold-and-centered">CUSTOMER DETAILS</h6>
        <!--<a class="btn btn-primary" type="add" href="customerdetailsform.php"><i class="fas fa-plus"></i> Add Customer</a>--> 
    </div>
</div>

    <div class="row mt-4">
        <div class="card shadow p-3">
            <div class="table-responsive">
                <div class="d-sm-flex justify-content-center align-items-center mb-4"> <!-- Changed justify-content to center -->
                    <a class="btn btn-primary" type="add" href="customerdetailsform.php"><i class="fas fa-plus"></i> Add Customer</a>
                </div>
                <table class="table table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">IC Number / No. Branch</th>
                            <th scope="col">Name</th>
                            <th scope="col">Telephone No</th>
                            <th scope="col">Address</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $count . "</td>";
                            echo "<td>" . $row['c_idnum'] . "</td>";
                            echo "<td>" . $row['c_name'] . "</td>";
                            echo "<td>" . $row['c_phone'] . "</td>";
                            echo "<td>" . $row['c_address'] . "</td>"; 
                            echo "<td>" . $row['c_email'] . "</td>"; 


                            echo "<td class='text-center'>";
                            echo "<a href='customercancel.php?id=" . $row['c_id'] . "' class='btn btn-danger mr-2' onclick='return confirmDelete()'><i class='fas fa-times'></i></a>&nbsp ";
                            //echo "<a href='customerQuotationADV.php?id=" . $row['c_id'] . "' class='btn btn-primary'><i class='fas fa-file'></i> Order</a> ";
                            echo "<a href='customeredit.php?id=" . $row['c_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a> ";
                            echo "</td>";
                            echo "</tr>";
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }
</script>

<?php mysqli_close($con);?>
<?php include 'footer.php'; ?>

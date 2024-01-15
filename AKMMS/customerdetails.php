<?php
include('mysession.php');

// Check if session is not started
if (!session_id()) {
    session_start();
}

include('dbconnect.php');
include('headerNav.php');

// Handle search criteria
if (isset($_GET['searchName']) && !empty($_GET['searchName'])) {
    $searchName = mysqli_real_escape_string($con, $_GET['searchName']);
    $sql = "SELECT * FROM tb_customer WHERE c_is_deleted = 0 AND c_name LIKE '%$searchName%'";
} elseif (isset($_GET['searchPhone']) && !empty($_GET['searchPhone'])) {
    $searchPhone = mysqli_real_escape_string($con, $_GET['searchPhone']);
    $sql = "SELECT * FROM tb_customer WHERE c_is_deleted = 0 AND c_phone LIKE '%$searchPhone%'";
} else {
    $sql = "SELECT * FROM tb_customer WHERE c_is_deleted = 0";
}

$result = mysqli_query($con, $sql);
?>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="card shadow p-3">
            <div class="card shadow p-3 mb-4 bg-primary text-white">
                <div class="d-sm-flex justify-content-center align-items-center">
                    <h6 class="text-white mb-0 font-weight-bold bold-and-centered">CUSTOMER DETAILS</h6>
                </div>
            </div>

            <div class="row mb-3">
                <label for="search" class="col-sm-3 col-form-label">Search Customer:</label>
                <div class="col-sm-6">
                    <form method="get" action="" id="searchForm" onsubmit="return validateForm()">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchName" name="searchName" placeholder="Enter customer name">
                            <input type="text" class="form-control ms-2" id="searchPhone" name="searchPhone" placeholder="Enter phone number">
                        </div>
                </div>
                <div class="col-sm-3">
                    <input type="submit" class="btn btn-primary ms-2" name="search" value="Search">
                    </form>
                    <a class="btn btn-primary" type="add" href="customerdetailsform.php"><i class="fas fa-plus"></i> Add Customer</a>
                </div>
            </div>

            <?php
            if (mysqli_num_rows($result) == 0) {
                echo "<div class='alert alert-info text-center' role='alert'>";
                echo "No matching records found.";
                echo "</div>";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-primary text-center">
                            <tr>
                                <th scope="col">ID</th>
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
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td style='text-align: center;'>" . $row['c_id'] . "</td>";
                                echo "<td>" . $row['c_idnum'] . "</td>";
                                echo "<td>" . $row['c_name'] . "</td>";
                                echo "<td>" . $row['c_phone'] . "</td>";
                                echo "<td>" . $row['c_address'] . "</td>";
                                echo "<td>" . $row['c_email'] . "</td>";
                                echo "<td class='text-center'>";
                                echo "<a href='customercancel.php?id=" . $row['c_id'] . "' class='btn btn-danger mr-2' onclick='return confirmDelete()'><i class='fas fa-times'></i></a>&nbsp ";
                                echo "<a href='customeredit.php?id=" . $row['c_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a> ";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }
</script>

<?php
mysqli_close($con);
include 'footer.php';
?>

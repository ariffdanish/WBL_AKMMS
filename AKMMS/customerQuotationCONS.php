<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
include('headerNav.php');
?>

<div class="container-fluid">
<div class="card shadow p-3 mb-4 bg-primary text-white">
    <div class="d-sm-flex justify-content-center align-items-center">
        <h6 class="text-white mb-0 font-weight-bold bold-and-centered">CUSTOMER ORDER DETAILS</h6>
    </div>
</div>


    <div class="row mt-4">
        <div class="card shadow p-3">

            <div class="row mb-3">
                <label for="ctype" class="col-sm-3 col-form-label">Select Order:</label>
                <div class="col-sm-6">
                    <?php
                    $sql = "SELECT * FROM tb_order
                            WHERE tb_order.Ord_type = '2'";
                    $result = mysqli_query($con, $sql);

                    echo '<form method="post" action="">';
                    echo '<select class="form-select" id="Ord_id" placeholder="Select" name="Ord_id">';
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['Ord_id'] . "'>" . $row['Ord_name'] . "</option>";
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-sm-3">';
                    echo '<input type="submit" class="btn btn-primary ms-2" name="search" value="Search">&nbsp';
                    echo '</form>';
                    echo '<a class="btn btn-primary" type="add" href="customerQuotationformCONS.php"><i class="fas fa-plus"></i> Add Item</a>';

                    if (isset($_POST['search'])) {
                        $selectedOrder = $_POST['Ord_id'];
                        $quotationSql = "SELECT * FROM tb_quotation WHERE q_ordID = $selectedOrder AND is_deleted = 0";
                        $quotationResult = mysqli_query($con, $quotationSql);
                    }
                    ?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Item Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price (RM)</th>
                            <th scope="col">Discount (RM)</th>
                            <th scope="col">Amount Discount (RM)</th>
                            <th scope="col">Tax Amount (RM)</th>
                            <th scope="col">Total Inc. Tax (RM)</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($quotationResult) && mysqli_num_rows($quotationResult) > 0) {
                            $count = 1;
                            while ($row = mysqli_fetch_array($quotationResult)) {
                                echo "<tr>";
                                echo "<td style='text-align: center;'>" . $count . "</td>";
                                echo "<td>" . $row['q_itemDesc'] . "</td>";
                                echo "<td>" . $row['q_quantity'] . "</td>";
                                echo "<td>" . $row['q_price'] . "</td>";
                                echo "<td>" . $row['q_discount'] . "</td>";
                                echo "<td>" . $row['q_discount'] . "</td>";
                                echo "<td>" . $row['q_tax'] . "</td>";
                                echo "<td>" . $row['q_totalcost'] . "</td>";

                                echo "<td style='text-align: center;'>";
                                echo "<a href='customercancelQuotationCONS.php?id=" . $row['q_id'] . "' class='btn btn-danger mr-2' onclick='confirmDelete(\"" . $row['q_id'] . "\")'><i class='fas fa-times'></i></a>&nbsp ";
                                echo "<a href='customereditQuotationCONS.php?id=" . $row['q_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a> ";
                                echo "</td>";

                                echo "</tr>";
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>
    <a class="btn btn-danger" href="customerorderCONS.php">Back</a>
</div>


    <script>
    // JavaScript function to confirm item deletion
    // JavaScript function to confirm item deletion
function confirmDelete(q_id) {
    var confirmDelete = confirm("Are you sure you want to delete this quotation?");
    if (confirmDelete) {
        // If the user confirms, send an AJAX request to update_totalcost.php
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'update_totalcost.php?q_id=' + q_id, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Item successfully deleted
                alert("Quotation with ID " + q_id + " has been removed.");
                // Reload the page to reflect the changes
                location.reload();
            } else {
                // Display an error message if deletion fails
                alert("Error: Unable to delete the quotation.");
            }
        };

        xhr.send();
    }
}

    </script>


<?php include 'footer.php'; ?>

<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
include('headerNav.php');
?>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="card shadow p-3">
            <div class="card shadow p-3 mb-4 bg-primary text-white">
                <div class="d-sm-flex justify-content-center align-items-center">
                    <h6 class="text-white mb-0 font-weight-bold bold-and-centered">PAYMENT MANAGEMENT</h6>
                </div>
            </div>
        
            <div class="row mb-3">
                <label for="ctype" class="col-sm-3 col-form-label">Select Order:</label>
                <div class="col-sm-6">
                    <form method="post" action="">
                        <select class="form-select" id="Ord_id" placeholder="Select" name="Ord_id">
                            <?php
                            $sql = "SELECT * FROM tb_order
                                    WHERE tb_order.Ord_is_deleted=0";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['Ord_id'] . "'>" . $row['Ord_id'] . " - " . $row['Ord_name'] . "</option>";
                            }
                            ?>
                        </select>
                </div>
                <div class="col-sm-3">
                    <input type="submit" class="btn btn-primary ms-2" name="search" value="Search">
                    </form>
                    <a class="btn btn-primary" type="add" href="paymentform.php">Payment</a>
                </div>
            </div>

            <div class="table-responsive">
                <?php
                if (isset($_POST['search'])) {
                    $selectedOrder = $_POST['Ord_id'];
                    $quotationSql = "SELECT * FROM tb_payment 
                                     LEFT JOIN tb_paymentstatus ON tb_payment.p_status = tb_paymentstatus.PS_id
                                     WHERE p_ordID = $selectedOrder";
                    $quotationResult = mysqli_query($con, $quotationSql);

                    if (mysqli_num_rows($quotationResult) > 0) {
                        // Display payment records
                        echo "<table class='table table-hover table-bordered'>";
                        echo "<thead class='table-primary text-center'>";
                        echo "<tr>";
                        echo "<th scope='col'>No</th>";
                        echo "<th scope='col'>Status Payment</th>";
                        echo "<th scope='col'>Amount Payment (RM)</th>";
                        echo "<th scope='col'>Date of Payment</th>";
                        echo "<th scope='col'>Proof of Payment</th>";
                        echo "<th scope='col'></th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        $count = 1;
                        while ($row = mysqli_fetch_array($quotationResult)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $count . "</td>";
                            echo "<td>" . $row['PS_desc'] . "</td>";
                            echo "<td>" . $row['p_amount'] . "</td>";
                            echo "<td>" . $row['p_date'] . "</td>";
                            echo "<td>" . $row['p_proof'] . "</td>";
                            echo "<td style='text-align: center;'>";
                            echo "<a href='paymentedit.php?id=" . $row['p_id'] . "' class='btn btn-primary mr-2'><i class='fas fa-edit'></i> </a>";
                            echo "</td>";
                            echo "</tr>";
                            $count++;
                        }

                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        // No payment records found
                        echo "<div class='alert alert-info' role='alert'>No payment records found for the selected order.</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
include('headerNav.php');
?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0 bold-and-centered">Payment Management</h3>
        <a class="btn btn-primary" type="add" href="paymentform.php">Payment</a>
    </div>

    <div class="row mt-4">
        <div class="card shadow p-3">

            <div class="row mb-3">
                <label for="ctype" class="col-sm-3 col-form-label">Select Order:</label>
                <div class="col-sm-6">
                    <form method="post" action="">
                        <select class="form-select" id="Ord_id" placeholder="Select" name="Ord_id">
                            <?php
                            $sql = "SELECT * FROM tb_order";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['Ord_id'] . "'>" . $row['Ord_name'] . "</option>";
                            }
                            ?>
                        </select>
                </div>
                <div class="col-sm-3">
                    <input type="submit" class="btn btn-primary ms-2" name="search" value="Search">
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Status Payment</th>
                            <th scope="col">Amount Payment (RM)</th>
                            <th scope="col">Date of Payment</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['search'])) {
                            $selectedOrder = $_POST['Ord_id'];
                            $quotationSql = "SELECT * FROM tb_payment 
                                             LEFT JOIN tb_paymentstatus ON tb_payment.p_status = tb_paymentstatus.PS_id
                                             WHERE p_ordID = $selectedOrder";
                            $quotationResult = mysqli_query($con, $quotationSql);
                            $count = 1;

                            while ($row = mysqli_fetch_array($quotationResult)) {
                                echo "<tr>";
                                echo "<td style='text-align: center;'>" . $count . "</td>";
                                echo "<td>" . $row['PS_desc'] . "</td>";
                                echo "<td>" . $row['p_amount'] . "</td>";
                                echo "<td>" . $row['p_date'] . "</td>";
                                echo "<td style='text-align: center;'>";
                                echo "<a href='customereditCONS.php?id=" . $row['p_id'] . "' class='btn btn-primary mr-2'><i class='fas fa-edit'></i> </a>";
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
    </div>
</div>

<?php include 'footer.php'; ?>

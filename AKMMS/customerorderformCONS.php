<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('headerNav.php');
include('dbconnect.php');
?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-12">
            <div class="row justify-content-center">

                <!-- Order Information Card -->
                <div class="col-lg-6 ">
                    <div class="card shadow">
                        <div class="card-header bg-gradient-primary text-white text-center">
                            <h3 class="mb-0">Order Information</h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="customerorderformCONSprocess.php" class="user">

                                <!-- Customer Type Dropdown -->
                                <div class="row mb-3">
                                    <label for="ctype" class="col-sm-3 col-form-label">Customer Type:</label>
                                    <div class="col-sm-9">
                                        <?php
                                        $sql = "SELECT * FROM tb_customer";
                                        $result = mysqli_query($con, $sql);

                                        echo '<select class="form-select" id="Ord_cid" placeholder="Select" name="Ord_cid">';
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['c_id'] . "'>" . $row['c_name'] . "</option>";
                                        }

                                        echo '</select>';
                                        ?>
                                    </div>
                                </div>

                                <!-- Order Date Input -->
                                <div class="row mb-3">
                                    <label for="orderDate" class="col-sm-3 col-form-label">Order Date:</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="date" id="Ord_date" name="Ord_date" required>
                                    </div>
                                </div>

                                <!-- Order Name Input -->
                                <div class="row mb-3">
                                    <label for="orderName" class="col-sm-3 col-form-label">Order Name:</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="Ord_name" name="Ord_name" required>
                                    </div>
                                </div>

                                <!-- Order Type Dropdown -->
                                <div class="row mb-3">
                                    <label for="orderType" class="col-sm-3 col-form-label">Order Type:</label>
                                    <div class="col-sm-9">
                                        <?php
                                        $sql = "SELECT * FROM tb_ordertype
                                                WHERE tb_ordertype.OT_id='2'";
                                        $result = mysqli_query($con, $sql);

                                        echo '<select id="Ord_type" name="Ord_type" class="form-control" required>';
                                        while ($row = mysqli_fetch_array($result)) {
                                            $selected = ($row['OT_id'] == '2') ? 'selected' : '';
                                            echo "<option value='" . $row['OT_id'] . "' $selected>" . $row['OT_desc'] . "</option>";
                                        }

                                        echo '</select>';
                                        ?>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mb-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                    <button type="reset" class="btn btn-dark mx-2">Reset</button>
                                    <a class="btn btn-danger" href="customerorderCONS.php">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

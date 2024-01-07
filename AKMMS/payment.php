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
        <!--<a class="btn btn-primary" type="add" href="customerQuotationformADV.php"><i class="fas fa-plus"></i> Add Item</a>--> 
    </div>


    <div class="row mt-4">
        <div class="card shadow p-3">

            <div class="row mb-3">
                <label for="ctype" class="col-sm-3 col-form-label">Select Order:</label>
                <div class="col-sm-6">
                    <?php
                    $sql = "SELECT * FROM tb_order";
                    $result = mysqli_query($con, $sql);

                    echo '<form method="post" action="">';
                    echo '<select class="form-select" id="Ord_id" placeholder="Select" name="Ord_id">';
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['Ord_id'] . "'>" . $row['Ord_name'] . "</option>";
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-sm-3">';
                    echo '<input type="submit" class="btn btn-primary ms-2" name="search" value="Search">';
                    echo '</form>';

                    /*if (isset($_POST['search'])) {
                        $selectedOrder = $_POST['Ord_id'];
                        $quotationSql = "SELECT * FROM tb_quotation WHERE q_ordID = $selectedOrder";
                        $quotationResult = mysqli_query($con, $quotationSql);
                    }*/
                    ?>
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
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $count . "</td>";
                            //echo "<td>" . $row['c_name'] . "</td>";
                            //echo "<td>" . $row['Ord_name'] . "</td>";
                            //echo "<td>" . $row['Ord_date'] . "</td>"; 
                            //echo "<td>" . $row['Ord_date'] . "</td>"; 
                            //echo "<td style='text-align: center;'>";
                            //echo "<a href='customercancelCONS.php?id=" . $row['Ord_id'] . "' class='btn btn-danger mr-2' onclick='return confirmDelete()'><i class='fas fa-times'></i> </a>&nbsp ";
                            //echo "<a href='customereditCONS.php?id=" . $row['Ord_id'] . "' class='btn btn-primary mr-2'><i class='fas fa-edit'></i> </a>";
                            // echo "<a href='customerQuotationADV.php?ord_id={$row['Ord_id']}' class='btn btn-primary mr-2'><i class='fas fa-file-alt'></i> Quotation</a>";
                            // echo "<a href='Invoice.php?ord_id={$row['Ord_id']}' class='btn btn-primary mr-2'><i class='fas fa-file-invoice'></i> Invoice</a>";
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



<?php include 'footer.php'; ?>

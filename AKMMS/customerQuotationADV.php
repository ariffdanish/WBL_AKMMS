<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

$sql = "SELECT * FROM tb_order
        LEFT JOIN tb_customer ON tb_order.Ord_cid = tb_customer.c_id
        WHERE tb_order.Ord_type = '1'";

        
$result = mysqli_query($con, $sql);

// Display Result
include 'headerNav.php';
?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <a class="btn btn-primary" type="add" href="customerQuotationformADV.php"><i class="fas fa-plus"></i> Add Quotation</a>
    </div>

    <div class="row mt-4">
        <div class="card shadow p-3">
            
        <div class="mb-3">
            <label for="ctype" class="form-label">Select Customer</label>
            <select class="form-select" id="Ord_cid" placeholder="Select" name="Ord_cid">';
                <option>###</option>
            </select>
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
                        </tr>
                    </thead>
                    <tbody>

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


<?php include 'footer.php'; ?>


                        <!--<?php
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $count . "</td>";
                            echo "<td>" . $row['Ord_name'] . "</td>";
                            echo "<td>" . $row['c_name'] . "</td>";
                            //echo "<td>" . $row['c_address'] . "</td>"; // Adjust column name accordingly
                            echo "<td class='text-center'>";
                            echo "<a href='customercancelADV.php?id=" . $row['Ord_id'] . "' class='btn btn-danger' onclick='return confirmDelete()'><i class='fas fa-times'></i></a> ";
                            echo "<a href='customereditADV.php?id=" . $row['Ord_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i> Edit</a> ";
                            echo "<a href='Quotation.php?ord_id={$row['Ord_id']}' class='btn btn-primary'><i class='fas fa-file-alt'></i> Quotation</a> ";
                            echo "<a href='Invoice.php?ord_id={$row['Ord_id']}' class='btn btn-primary'><i class='fas fa-file-invoice'></i> Invoice</a> ";
                            echo "</td>";
                            echo "</tr>";
                            $count++;
                        }
                        ?>-->
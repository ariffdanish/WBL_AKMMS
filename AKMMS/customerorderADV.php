<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');


$sql = "SELECT * FROM tb_order
        LEFT JOIN tb_customer ON tb_order.Ord_cid = tb_customer.c_id";
        
$result = mysqli_query($con, $sql);

// Display Result
include 'headerNav.php';
?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Customer Order Details</h3>
        <a class="btn btn-primary" type="add" href="customerorderformADV.php"><i class="fas fa-plus"></i> Add Order</a>
    </div>

    <div class="row mt-4">
        <div class="card shadow p-3">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Order Name</th>
                            <th scope="col">Customer</th>
                            <!--<th scope="col">Status Payment</th>--> 
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $count . "</td>";
                            echo "<td>" . $row['Ord_name'] . "</td>";
                            echo "<td>" . $row['c_name'] . "</td>";
                            //echo "<td>" . $row['c_address'] . "</td>"; // Adjust column name accordingly
                            echo "<td class='text-center'>";
                            echo "<a href='customercancelADV.php?id=" . $row['Ord_id'] . "' class='btn btn-danger'><i class='fas fa-times'></i></a> ";
                            echo "<a href='customeredit.php?id=" . $row['Ord_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i> Edit</a> ";
                            echo "<a href='Quotation.php?ord_id={$row['Ord_id']}' class='btn btn-primary'><i class='fas fa-edit'></i> Quotation</a> ";
                            echo "<a href='Invoice.php?ord_id={$row['Ord_id']}' class='btn btn-primary'><i class='fas fa-edit'></i> Invoice</a> ";


                            echo "<a href='customercancelADV.php?id=" . $row['Ord_id'] . "' class='btn btn-danger' onclick='return confirmDelete()'><i class='fas fa-times'></i></a> ";
                            echo "<a href='customereditADV.php?id=" . $row['Ord_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i> Edit</a> ";
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


<?php include 'footer.php'; ?>

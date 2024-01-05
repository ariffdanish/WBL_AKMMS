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
    <h3 class="text-dark mb-0 bold-and-centered">Customer Order Details</h3>
        <a class="btn btn-primary" type="add" href="customerorderformADV.php"><i class="fas fa-plus"></i> Add Order</a>
    </div>

        <div class="card shadow p-3">
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
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $count . "</td>";
                            echo "<td>" . $row['Ord_name'] . "</td>";
                            echo "<td>" . $row['Ord_itemQuantity'] . "</td>";
                            echo "<td>" . $row['Ord_itemPrice'] . "</td>";
                            echo "<td>" . $row['Ord_itemDiscount'] . "</td>"; 
                            echo "<td>" . $row['Ord_itemDiscount'] . "</td>"; 
                            echo "<td>" . $row['Ord_itemTax'] . "</td>"; 
                            echo "<td>" . $row['Ord_itemTax'] . "</td>";  

                            echo "<td>";
                            echo "<div class='btn-group'>";
                            echo "<a href='customercancelADV.php?id=" . $row['Ord_id'] . "' class='btn btn-danger mr-2' onclick='return confirmDelete()'><i class='fas fa-times'></i></a> ";
                            echo "<a href='customereditADV.php?id=" . $row['Ord_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a> ";
                            echo "</div>";                            
                            //echo "<a href='Quotation.php?ord_id={$row['Ord_id']}' class='btn btn-primary'><i class='fas fa-file-alt'></i> Quotation</a> ";
                            //echo "<a href='Invoice.php?ord_id={$row['Ord_id']}' class='btn btn-primary'><i class='fas fa-file-invoice'></i> Invoice</a> ";
                            echo "</td>";

                            echo "</tr>";
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
                
            </div>
            
        </div>
        <br><a class="btn btn-primary" type="add" href="customerdetails.php"><i class="fas fa-arrow"></i> Back</a>
    </div>
    
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}
</script>


<?php include 'footer.php'; ?>


   
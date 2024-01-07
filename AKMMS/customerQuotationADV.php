<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

$sql = "SELECT * FROM tb_quotation";
$result = mysqli_query($con, $sql);

// Display Result
include 'headerNav.php';
?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0 bold-and-centered">Customer Order Details</h3>
    <a class="btn btn-primary" type="add" href="customerQuotationformADV.php"><i class="fas fa-plus"></i> Add Quotation</a>
    </div>

    <div class="row mt-4">
        <div class="card shadow p-3">
            
        <!--<div class="row mb-3">
            <label for="ctype" class="col-sm-3 col-form-label">Select Order:</label>
            <div class="col-sm-9">
            <?php 
                $sql="SELECT * FROM tb_order";
                $result=mysqli_query($con,$sql);
        
                echo'<select class="form-select" id="Ord_id" placeholder="Select" name="Ord_id">';
                while($row=mysqli_fetch_array($result))
                {
                    echo"<option value='".$row['Ord_id']."'>".$row['Ord_name']."</option>";
                }
                
                echo'</select>';
            ?>
            </div>
        </div>--> 

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
                    $sql = "SELECT * FROM tb_quotation";
                    $result = mysqli_query($con, $sql);
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $count . "</td>";
                            echo "<td>" . $row['q_itemDesc'] . "</td>";
                            echo "<td>" . $row['q_quantity'] . "</td>";
                            echo "<td>" . $row['q_price'] . "</td>";
                            echo "<td>" . $row['q_discount'] . "</td>"; 
                            echo "<td>" . $row['q_discount'] . "</td>"; 
                            echo "<td>" . $row['q_tax'] . "</td>"; 
                            echo "<td>" . $row['q_totalcost'] . "</td>";  

                            echo "<td>";
                            echo "<a href='customercancelQuotationADV.php?id=" . $row['q_id'] . "' class='btn btn-danger mr-2' onclick='return confirmDelete()'><i class='fas fa-times'></i></a>&nbsp ";
                            echo "<a href='customereditQuotationADV.php?id=" . $row['q_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a> ";                        
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
    </div>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}
</script>


<?php include 'footer.php'; ?>

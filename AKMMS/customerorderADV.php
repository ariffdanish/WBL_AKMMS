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
    <h3 class="text-dark mb-0 bold-and-centered">Customer Order Details (Advertisment)</h3>
    <div class="d-flex">
    <a class="btn btn-primary mr-4" type="add" href="customerorderformADV.php"><i class="fas fa-plus"></i> Add Order</a>
    <a class="btn btn-primary" type="add" href="customerQuotationADV.php"><i class="fas fa"></i>Quotation</a>
    </div>
</div>


        <div class="card shadow p-3">

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Order</th>
                            <th scope="col">Date</th>  
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $count . "</td>";
                            echo "<td>" . $row['c_name'] . "</td>";
                            echo "<td>" . $row['Ord_name'] . "</td>";
                            echo "<td>" . $row['Ord_date'] . "</td>"; 

                            echo "<td style='text-align: center;'>";
                            echo "<div>";
                            echo "<a href='customercancelADV.php?id=" . $row['Ord_id'] . "' class='btn btn-danger mr-2' onclick='return confirmDelete()'><i class='fas fa-times'></i> </a>";
                            echo "<a href='customereditADV.php?id=" . $row['Ord_id'] . "' class='btn btn-primary mr-2'><i class='fas fa-edit'></i> </a>";
                            // echo "<a href='customerQuotationADV.php?ord_id={$row['Ord_id']}' class='btn btn-primary mr-2'><i class='fas fa-file-alt'></i> Quotation</a>";
                            // echo "<a href='Invoice.php?ord_id={$row['Ord_id']}' class='btn btn-primary mr-2'><i class='fas fa-file-invoice'></i> Invoice</a>";
                            echo "</div>";
                            echo "</td>";
                            
                            
                            echo "</tr>";
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <br><a class="btn btn-primary" type="add" href="customerdetails.php"><i class="fas fa-arrow"></i>Back</a>
    </div>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}

function loadOrders() {
    var customerId = document.getElementById("Ord_cid").value;
    var url = "get_orders.php?customerId=" + customerId; // Replace with the actual PHP file to fetch orders
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("orderTableBody").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", url, true);
    xhttp.send();
}
</script>


<?php include 'footer.php'; ?>


   
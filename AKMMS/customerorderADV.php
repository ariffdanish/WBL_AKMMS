<?php
  include ('mysession.php');
  if(!session_id())
  {
    session_start();
  }
  include ('dbconnect.php');
  // Display Result
include 'headerNav.php';

$sql = "SELECT * FROM tb_order
        LEFT JOIN tb_customer ON tb_order.Ord_cid = tb_customer.c_id
        WHERE tb_order.Ord_type = '1'";

$result = mysqli_query($con, $sql);
?>

<div class="container-fluid">

    <div class="card shadow p-3">
    <div class="card shadow p-3 mb-4 bg-primary text-white">
        <div class="d-sm-flex justify-content-center align-items-center">
            <h6 class="text-white mb-0 font-weight-bold bold-and-centered">CUSTOMER ORDER DETAILS ADVERTISEMENT</h6>
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order</th>
                        <th scope="col">Date</th>
                        <!--<th scope="col">Payment</th>--> 
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    while($row=mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" .$count. "</td>";
                        echo "<td>".$row['c_name']. "</td>";
                        echo "<td>".$row['Ord_name']. "</td>";
                        echo "<td>".$row['Ord_date']. "</td>";
                        echo "<td class='text-center'>";
                        echo "<div class='btn-group'>";
                        echo "<a href='customereditADV.php?id=" . $row['Ord_id'] . "' class='btn btn-primary mr-2'><i class='fas fa-edit'></i></a>&nbsp";
                        echo "<button class='btn btn-primary dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <i class='fas fa-file-alt'></i> Print
                            </button>";
                        echo "<div class='dropdown-menu'>";
                        echo "<a class='dropdown-item text-white' href='#' onclick='printDocument(\"Quotation.php\", " . $row['Ord_cid'] . ")'>Quotation</a>";
                        echo "<a class='dropdown-item text-white' href='#' onclick='printDocument(\"Invoice.php\", " . $row['Ord_cid'] . ")'>Invoice</a>";
                        echo "<a class='dropdown-item text-white' href='#' onclick='printDocument(\"Deliverynotes.php\", " . $row['Ord_cid'] . ")'>Delivery Notes</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                        $count++;
                    }
                    ?> 
                </tbody>
            </table>
            <div class="d-sm-flex justify-content-center align-items-center mb-4"> <!-- Changed justify-content to center -->
                    <a class="btn btn-primary mr-4" href="customerorderformADV.php"><i class="fas fa-plus"></i> Add Order</a>&nbsp
                    <a class="btn btn-primary" href="customerQuotationADV.php"><i class="fas fa"></i>Quotation</a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }
    function printDocument(targetFile, Ord_cid) {
        // You can include other necessary parameters here
        var targetUrl = targetFile + '?Ord_cid=' + Ord_cid;
        var printWindow = window.open(targetUrl, '_blank');

        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>


<?php include 'footer.php'; ?>

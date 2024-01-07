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
<<<<<<< Updated upstream
=======



>>>>>>> Stashed changes
?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0 bold-and-centered">Customer Order Details (Advertisement)</h3>
        <div class="d-flex">
            <a class="btn btn-primary mr-4" href="customerorderformADV.php"><i class="fas fa-plus"></i> Add Order</a>&nbsp
            <a class="btn btn-primary" href="customerQuotationADV.php"><i class="fas fa"></i> Quotation</a>
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
                        <th scope="col">Payment</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $count = 1;
                        while($row=mysqli_fetch_array($result))
                        {
                          echo"<tr>";
                          echo"<td>" .$count. "</td>";
                          echo"<td>".$row['c_name']. "</td>";
                          echo"<td>".$row['Ord_name']. "</td>";
                          echo"<td>".$row['Ord_date']. "</td>";
<<<<<<< Updated upstream
                          echo"<td>".$row['Ord_date']. "</td>";
                          echo "<td style='text-align: center;'>";
=======
                          echo "<td style='text-align: initial;'>";
>>>>>>> Stashed changes
                            echo "<a href='customercancelADV.php?id=".$row['Ord_id']. "' class='btn btn-danger mr-2' onclick='return confirmDelete()'><i class='fas fa-times'></i> </a>&nbsp ";
                            echo "<a href='customereditADV.php?id=".$row['Ord_id']. "' class='btn btn-primary'><i class='fas fa-edit'></i></a> ";
                            echo '<a href="#"><button class="btn btn-primary" onclick="printDocument(\'Quotation.php\', ' . $row['Ord_cid'] . ')">Quotation</button></a>';
                            echo '<a href="#"><button class="btn btn-primary" onclick="printDocument(\'Invoice.php\', ' . $row['Ord_cid'] . ')">Invoice</button></a>';
                            echo '<a href="#"><button class="btn btn-primary" onclick="printDocument(\'Deliverynotes.php\', ' . $row['Ord_cid'] . ')">Delivery Notes</button></a>';


                            
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

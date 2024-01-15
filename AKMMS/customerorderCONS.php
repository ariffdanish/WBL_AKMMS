<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
include 'headerNav.php';

// Handle search criteria
$searchCondition = "";

if (isset($_GET['searchName']) && !empty($_GET['searchName'])) {
    $searchName = mysqli_real_escape_string($con, $_GET['searchName']);
    $searchCondition .= " AND tb_customer.c_name LIKE '%$searchName%'";
}

if (isset($_GET['searchDate']) && !empty($_GET['searchDate'])) {
    $searchDate = mysqli_real_escape_string($con, $_GET['searchDate']);
    $searchCondition .= " AND tb_order.Ord_date LIKE '%$searchDate%'";
}

$sql = "SELECT * FROM tb_order
        LEFT JOIN tb_customer ON tb_order.Ord_cid = tb_customer.c_id
        WHERE tb_order.Ord_type = '2' AND Ord_is_deleted = 0 " . $searchCondition;

$result = mysqli_query($con, $sql);
?>

<div class="container-fluid">
    <div class="card shadow p-3">
        <div class="card shadow p-3 mb-4 bg-primary text-white">
            <div class="d-sm-flex justify-content-center align-items-center">
                <h6 class="text-white mb-0 font-weight-bold bold-and-centered">CUSTOMER ORDER DETAILS CONSTRUCTION</h6>
            </div>
        </div>

        <div class="row mb-3">
            <label for="search" class="col-sm-3 col-form-label">Search Order:</label>
            <div class="col-sm-6">
                <form method="get" action="" id="searchForm" onsubmit="return validateForm()">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchName" name="searchName" placeholder="Enter customer name">
                        <input type="date" class="form-control ms-2" id="searchDate" name="searchDate" placeholder="Select a date">
                    </div>
            </div>
            <div class="col-sm-3">
                <input type="submit" class="btn btn-primary ms-2" name="search" value="Search">
                </form>
                <a class="btn btn-primary mr-4" href="customerorderformCONS.php">Add</a>
                <a class="btn btn-primary" href="customerQuotationCONS.php"><i class="fas fa"></i>Quotation</a>
            </div>
        </div>

        <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<div class='alert alert-info text-center' role='alert'>";
            echo "No matching records found.";
            echo "</div>";
        } else {
        ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Ord ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Order</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row=mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $row['Ord_id']. "</td>";
                            echo "<td>".$row['c_name']. "</td>";
                            echo "<td>".$row['Ord_name']. "</td>";
                            echo "<td>".$row['Ord_date']. "</td>";
                            echo "<td class='text-center'>";
                            echo "<div class='btn-group'>";
                            echo "<a href='customercancelCONS.php?id=" . $row['Ord_id'] . "' class='btn btn-danger mr-2' onclick='return confirmDelete()'><i class='fas fa-times'></i></a>&nbsp";
                            echo "<a href='customereditCONS.php?id=" . $row['Ord_id'] . "' class='btn btn-primary mr-2'><i class='fas fa-edit'></i></a>&nbsp";
                            echo "<button class='btn btn-primary dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-file-alt'></i> Print
                                </button>";
                            echo "<div class='dropdown-menu'>";
                            echo "<a class='dropdown-item text-white' href='#' onclick='printDocument(\"Quotation.php\", " . $row['Ord_id'] . ")'>Quotation</a>";
                            echo "<a class='dropdown-item text-white' href='#' onclick='printDocument(\"Invoice.php\", " . $row['Ord_id'] . ")'>Invoice</a>";
                            echo "<a class='dropdown-item text-white' href='#' onclick='printDocument(\"Deliverynotes.php\", " . $row['Ord_id'] . ")'>Delivery Notes</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }
    function printDocument(targetFile, Ord_id) {
        // You can include other necessary parameters here
        var targetUrl = targetFile + '?Ord_id=' + Ord_id;
        var printWindow = window.open(targetUrl, '_blank');

        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>

<?php include 'footer.php'; ?>

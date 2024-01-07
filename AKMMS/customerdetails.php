<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
include 'headerNav.php';

$sql = "SELECT * FROM tb_customer";
$result = mysqli_query($con, $sql);
?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0 bold-and-centered">Customer Details</h3>
        <a class="btn btn-primary" type="add" href="customerdetailsform.php"><i class="fas fa-plus"></i> Add Customer</a>
    </div>

    <div class="row mt-4">
        <div class="card shadow p-3">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">IC Number / No. Branch</th>
                            <th scope="col">Name</th>
                            <th scope="col">Telephone No</th>
                            <th scope="col">Address</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $count . "</td>";
                            echo "<td>" . $row['c_idnum'] . "</td>";
                            echo "<td>" . $row['c_name'] . "</td>";
                            echo "<td>" . $row['c_phone'] . "</td>";
                            echo "<td>" . $row['c_address'] . "</td>"; 
                            echo "<td>" . $row['c_email'] . "</td>"; 


                            echo "<td class='text-center'>";
                            //echo "<a href='customerQuotationADV.php?id=" . $row['c_id'] . "' class='btn btn-primary'><i class='fas fa-file'></i> Order</a> ";
                            echo "<a href='customeredit.php?id=" . $row['c_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a> ";
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

<?php mysqli_close($con);?>
<?php include 'footer.php'; ?>

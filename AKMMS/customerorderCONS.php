<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

// Display Result
include 'headerNav.php';
?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Customer Order Details</h3>
        <a class="btn btn-primary" type="add" href="customerdetailsformCONS.php">Add Order</a>
    </div>

    <div class="row mt-4">
        <table class="table table-hover">
            <thead>
                <tr class="table-dark">
                    <th scope="col">No</th>
                    <th scope="col">Order Name</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
        </table>
    </div>

</div>

<?php include 'footer.php'; ?>

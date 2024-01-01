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
                            <th scope="col">Status Payment</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

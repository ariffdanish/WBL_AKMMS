<?php include 'headerNav.php';?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Customer Details</h3>
        <a class="btn btn-primary" type="add" href="customerdetailsform.php">Add</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6 text-nowrap">
                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                    <label class="form-label">Show&nbsp;
                        <select class="d-inline-block form-select form-select-sm">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>&nbsp;
                    </label>
                </div>
            </div>

        <div class="row mt-4">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Telephone No</th>
                        <th scope="col">Order Name</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">####</th>
                        <td>####</td>
                        <td>####</td>
                        <td>####</td>
                        <td>
                            <a><button type="button" class="btn btn-danger">X</button></a>
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <button type="button" class="btn btn-primary btn-sm">Select</button>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle show " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                                    <div class="dropdown-menu show btn-sm" aria-labelledby="btnGroupDrop1" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item" href="#">Quotation</a>
                                        <a class="dropdown-item" href="#">Invoice</a>
                                        <a class="dropdown-item" href="#">Delivery Order</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php';?>

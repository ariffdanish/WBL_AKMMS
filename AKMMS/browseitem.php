<?php include 'headerNav.php';?>

<div class="container-fluid">
    <h3 class="text-dark mb-4">Search for Item Above</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Item Info</p>
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
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter">
                        <label class="form-label">
                            <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Search">
                            <button class="btn btn-primary btn-sm" onclick="searchItems()">Search</button>
                        </label>
                    </div>
                </div>
            </div>

            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                Item Details
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price (RM)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connect to DB
                        include('dbconnect.php');

                        // Retrieve data from tb_item
                        $sqlSelect = "SELECT i_Name, i_Code, i_Desc, i_Quantity, i_Price FROM tb_item";
                        $result = mysqli_query($con, $sqlSelect);

                        // Display retrieved data
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['i_Code'] . "</td>";
                            echo "<td>" . $row['i_Name'] . "</td>";
                            echo "<td>" . $row['i_Desc'] . "</td>";
                            echo "<td>" . $row['i_Quantity'] . "</td>";
                            echo "<td>" . $row['i_Price'] . "</td>";
                            echo "<td>";
                            echo '<button class="btn btn-warning" onclick="modifyItem(\'' . $row['i_Code'] . '\')">Modify</button>';
                            echo '&nbsp;';
                            echo '<button class="btn btn-danger" onclick="deleteItem(\'' . $row['i_Code'] . '\')">Delete</button>';
                            echo "</td>";
                            echo "</tr>";
                        }

                        // Close DB Connection
                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    // JavaScript function to confirm item deletion
    function deleteItem(itemCode) {
        var confirmDelete = confirm("Are you sure you want to delete this item?");
        if (confirmDelete) {
            // If user confirms, redirect to deleteitem.php with the item code
            window.location.href = 'deleteitem.php?icode=' + itemCode;
        }
    }

    // JavaScript function to redirect to itemmodify.php with item code
    function modifyItem(itemCode) {
        window.location.href = 'itemmodify.php?icode=' + itemCode;
    }

    // JavaScript function to search items
    function searchItems() {
        var searchInput = document.getElementById('searchInput').value;
        // Redirect to browseitem.php with search query as a parameter
        window.location.href = 'browseitem.php?search=' + searchInput;
    }
</script>

<?php include 'footer.php';?>

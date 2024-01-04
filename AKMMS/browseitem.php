<?php include 'headerNav.php';?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Inventory AK MAJU</h3>
        <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                        <label class="form-label, justify-content-center gap-2">Show&nbsp;
                            <select class="d-inline-block form-select-sm">
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;
                        </label>
                    </div>
                </div>
            </div>
        <div class="col-md-6">
            <div class="text-md-end dataTables_filter" id="dataTable_filter">
                <label class="form-label">
                    <input type="search" class="form-control, justify-content-center gap-2" id="searchInput" placeholder="Find An Item">
                    <button class="btn btn-primary" onclick="searchItems()">Search</button>
                </label>
            </div>
        </div>
        <a class="btn btn-primary" type="add" href="additem.php"><i class="fas fa-plus"></i> Add Item</a>
    </div>

    <div class="row mt-4">
        <div class="card shadow p-3">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price (RM)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connect to DB
                        include('dbconnect.php');

                        // Retrieve data from tb_item
                        $sqlSelect = "SELECT i_Name, i_Code, i_Desc, i_Quantity, i_Price FROM tb_item";

                        // If search query is provided, filter the results
                        if (isset($_GET['search'])) {
                            $searchInput = mysqli_real_escape_string($con, $_GET['search']);
                            $sqlSelect .= " WHERE i_Code LIKE '%$searchInput%' OR i_Name LIKE '%$searchInput%'";
                        }

                        $result = mysqli_query($con, $sqlSelect);

                        // Display retrieved data
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><a href='viewitemprocess.php?icode=" . $row['i_Code'] . "'>" . $row['i_Code'] . "</a></td>";
                            echo "<td>" . $row['i_Name'] . "</td>";
                            echo "<td>" . $row['i_Desc'] . "</td>";
                            echo "<td class='text-center'>" . $row['i_Quantity'] . "</td>";
                            echo "<td class='text-center'>" . number_format($row['i_Price'], 2) . "</td>";
                            echo "<td class='text-center'>";
                            echo '<button class="btn btn-warning" onclick="modifyItem(\'' . $row['i_Code'] . '\')">Modify</button>';
                            echo '&nbsp;';
                            echo '<button class="btn btn-danger" onclick="deleteItem(\'' . $row['i_Code'] . '\')">Delete</button>';
                            echo "</td>";
                            echo "</tr>";
                        }

                        // Display message if no matching items found
                        if (mysqli_num_rows($result) == 0 && isset($_GET['search'])) {
                            echo "<tr><td colspan='6'>No matching items found.</td></tr>";
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
            // If user confirms, send an AJAX request to deleteitem.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'deleteitem.php?icode=' + itemCode, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Item successfully deleted
                    alert("Item with code " + itemCode + " has been removed.");
                    // Reload the page to reflect the changes
                    location.reload();
                } else {
                    // Display an error message if deletion fails
                    alert("Error: Unable to delete the item.");
                }
            };

            xhr.send();
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

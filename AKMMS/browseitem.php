<?php include 'headerNav.php';?>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Inventory AK MAJU</h3>
        <div class="row">
            <div class="col-md-6 text-nowrap">
                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                    <form method="GET">
                        <label class="form-label, justify-content-center gap-2">Show&nbsp;
                            <select class="d-inline-block form-select-sm" name="itemsPerPage" onchange="this.form.submit()">
                                <option value="5" <?php if (isset($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == '5') echo 'selected'; ?>>5</option>
                                <option value="10" <?php if (isset($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == '10') echo 'selected'; ?>>10</option>
                                <option value="20" <?php if (isset($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == '20') echo 'selected'; ?>>20</option>
                                <option value="50" <?php if (isset($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == '50') echo 'selected'; ?>>50</option>
                            </select>&nbsp;
                        </label>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="text-md-end dataTables_filter" id="dataTable_filter">
                <label class="form-label">
                    <input type="search" class="form-control, justify-content-center gap-2" id="searchInput" placeholder="Find An Item">
                    <a class="btn btn-primary" onclick="searchItems()">Search</a>
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

                        // If sorting order is provided, order the results
                        if (isset($_GET['sort'])) {
                            $sortOrder = ($_GET['sort'] == 'asc') ? 'ASC' : 'DESC';
                            $sqlSelect .= " ORDER BY i_Name $sortOrder";
                        }

                        // If items per page is provided, limit the results
                        if (isset($_GET['itemsPerPage'])) {
                            $itemsPerPage = (int)$_GET['itemsPerPage'];

                            // Get the total number of items
                            $resultTotal = mysqli_query($con, "SELECT COUNT(*) as total FROM tb_item");
                            $rowTotal = mysqli_fetch_assoc($resultTotal);
                            $totalItems = $rowTotal['total'];

                            // Calculate total pages
                            $totalPages = ceil($totalItems / $itemsPerPage);

                            // Get current page, default to 1
                            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                            // Validate current page value
                            if ($currentPage < 1) {
                                $currentPage = 1;
                            } elseif ($currentPage > $totalPages) {
                                $currentPage = $totalPages;
                            }

                            // Calculate the offset for the query
                            $offset = ($currentPage - 1) * $itemsPerPage;
                            $sqlSelect .= " LIMIT $offset, $itemsPerPage";
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

                        // Pagination links
                        // Display message if no matching items found
                        if (mysqli_num_rows($result) == 0 && isset($_GET['search'])) {
                            echo "<tr><td colspan='6'>No matching items found.</td></tr>";
                        } else {
                            // Pagination links
                            echo "<tr><td colspan='6'><div class='pagination justify-content-center'>";
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<a href='browseitem.php?itemsPerPage=$itemsPerPage&page=$i&sort=" . ($_GET['sort'] ?? 'asc') . "' class='btn btn-outline-primary" . ($i == $currentPage ? ' active' : '') . "'>$i</a>";
                            }
                            echo "</div></td></tr>";
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

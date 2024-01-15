<?php 
include ('mysession.php');
if(!session_id())
{
    session_start();
}
include 'headerNav.php';?>

<div class="container-fluid">
    

    <div class="row mt-4">
    <div class="card shadow p-3">
    <div class="card shadow p-3 mb-4 bg-primary text-white">
        <div class="d-sm-flex justify-content-center align-items-center">
            <h6 class="text-white mb-0 font-weight-bold bold-and-centered">INVENTORY AND STOCK AK MAJU RESOURCES</h6>
        </div>
    </div>
                <div class="row mb-3">
                    <label for="icategory" class="col-sm-3 col-form-label">Select Item Category:</label>
                    <div class="col-sm-6">
                        <form method="post" action="">
                            <select class="form-select justify-content-center align-items-center" id="i_Category" name="i_Category">
                                <option value="Advertising" <?php echo isset($_POST['i_Category']) && $_POST['i_Category'] == 'Advertising' ? 'selected' : ''; ?>>Advertising</option>
                                <option value="Construction" <?php echo isset($_POST['i_Category']) && $_POST['i_Category'] == 'Construction' ? 'selected' : ''; ?>>Construction</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="submit" class="btn btn-primary ms-2" name="search" value="Search">
                        </form>
                    </div>
                </div>
                <div class="d-sm-flex justify-content-center align-items-center mb-4"> <!-- Changed justify-content to center -->  
                    <div class="col-sm-2 col-form-label">
                        <label><input type="search" class="form-control" id="searchInput" placeholder="Search Item"></label>
                    </div>&nbsp &nbsp
                    <a class="btn btn-primary" onclick="searchItems()">Search</a>&nbsp &nbsp
                    <a class="btn btn-primary align-items-right" type="add" href="additem.php"><i class="fas fa-plus"></i> Add Item</a>
                </div>

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

                    if (isset($_POST['search'])) {
                        // Category search
                        $selectedCategory = mysqli_real_escape_string($con, $_POST['i_Category']);
                        $sqlSearch = "SELECT i.i_Code, i.i_Name, i.i_Desc, i.i_Quantity, i.i_Price, i.i_Status
                            FROM tb_item i
                            LEFT JOIN tb_itemstatus s ON i.i_Status = s.i_StatusID
                            WHERE i.i_Status IN ('1') AND i.i_Category = '$selectedCategory'";
                    } elseif (isset($_GET['search'])) {
                        // Item code or name search
                        $searchInput = mysqli_real_escape_string($con, $_GET['search']);
                        $sqlSearch = "SELECT i.i_Code, i.i_Name, i.i_Desc, i.i_Quantity, i.i_Price, i.i_Status
                            FROM tb_item i
                            LEFT JOIN tb_itemstatus s ON i.i_Status = s.i_StatusID
                            WHERE i.i_Status IN ('1') AND (i.i_Code LIKE '%$searchInput%' OR i.i_Name LIKE '%$searchInput%')";
                    } else {
                        // Retrieve data from tb_item without search filter
                        $sqlSearch = "SELECT i.i_Code, i.i_Name, i.i_Desc, i.i_Quantity, i.i_Price, i.i_Status
                            FROM tb_item i
                            LEFT JOIN tb_itemstatus s ON i.i_Status = s.i_StatusID
                            WHERE i.i_Status IN ('1')";
                    }

                    $result = mysqli_query($con, $sqlSearch);

                    if ($result && mysqli_num_rows($result) > 0) {
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
                            echo '&nbsp;';
                            echo '<button class="btn btn-danger" onclick="deleteItem(\'' . $row['i_Code'] . '\')">Delete</button>';
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
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
        var confirmDelete = confirm("Are you sure you want to remove this item?");
        if (confirmDelete) {
            // If user confirms, send an AJAX request to deleteitem.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'updateitemstatus.php?icode=' + itemCode, true);

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

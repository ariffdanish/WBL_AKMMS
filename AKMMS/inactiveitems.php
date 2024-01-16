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

                        // Fetch inactive items
                        $sqlInactiveItems = "SELECT i.i_Code, i.i_Name, i.i_Desc, i.i_Quantity, i.i_Price, i.i_Status
                        FROM tb_item i
                        LEFT JOIN tb_itemstatus s ON i.i_Status = s.i_StatusID
                        WHERE i.i_Status = '2'";
                        $resultInactiveItems = mysqli_query($con, $sqlInactiveItems);

                        if ($resultInactiveItems && mysqli_num_rows($resultInactiveItems) > 0) {
                            while ($row = mysqli_fetch_assoc($resultInactiveItems)) {
                                echo "<tr>";
                                echo "<td>" . $row['i_Code'] . "</td>";
                                echo "<td>" . $row['i_Name'] . "</td>";
                                echo "<td>" . $row['i_Desc'] . "</td>";
                                echo "<td class='text-center'>" . $row['i_Quantity'] . "</td>";
                                echo "<td class='text-center'>" . number_format($row['i_Price'], 2) . "</td>";
                                echo "<td class='text-center'>";
                                echo '<button class="btn btn-success" onclick="confirmReactivate(\'' . $row['i_Code'] . '\')">Reactivate</button>';
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No inactive items found.</td></tr>";
                        }

                        // Close DB Connection
                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>
                <?php
                echo '<div class="mb-3 d-flex justify-content-center gap-2">';
                echo '&nbsp;';
                echo '<a type="cancel" class="btn btn-dark" href="browseitem.php">Back</a>';
                echo '</div>';
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to confirm item reactivation
    function confirmReactivate(itemCode) {
        var confirmReactivate = confirm("Are you sure you want to reactivate this item?");
        if (confirmReactivate) {
            // If user confirms, send an AJAX request to reactivateitem.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'reactivateitem.php?icode=' + itemCode, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Item successfully reactivated
                    alert("Item with code " + itemCode + " has been reactivated.");
                    // Reload the page to reflect the changes
                    location.reload();
                } else {
                    // Display an error message if reactivation fails
                    alert("Error: Unable to reactivate the item.");
                }
            };

            xhr.send();
        }
    }
</script>

<?php include 'footer.php';?>

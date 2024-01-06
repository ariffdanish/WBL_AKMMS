<?php
include('mysession.php');

// Start session if not already started
if (!session_id()) {
    session_start();
}

include('dbconnect.php');

function displayHeader() {
    include 'headerNav.php';
    echo <<<HTML
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0 bold-and-centered">Customer Details</h3>
            <a class="btn btn-primary" type="add" href="customerdetailsform.php">
                <i class="fas fa-plus"></i> Add Customer
            </a>
        </div>
    HTML;
}

function displayFooter() {
    echo '</div>';
    include 'footer.php';
}

function displayTable($result) {
    echo <<<HTML
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
    HTML;

    $count = 1;
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td style='text-align: center;'>" . $count . "</td>";
        echo "<td>" . htmlspecialchars($row['c_idnum']) . "</td>";
        echo "<td>" . htmlspecialchars($row['c_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['c_phone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['c_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['c_email']) . "</td>";

        echo "<td class='text-center'>";
        echo "<a href='customeredit.php?id=" . $row['c_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a> ";
        echo "</td>";
        echo "</tr>";
        $count++;
    }

    echo <<<HTML
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    HTML;
}

// Main code
try {
    $sql = "SELECT * FROM tb_customer";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        throw new Exception("Error executing the query: " . mysqli_error($con));
    }

    displayHeader();
    displayTable($result);
    displayFooter();
} catch (Exception $e) {
    // Handle exceptions (e.g., log the error, display a user-friendly message)
    echo "An error occurred: " . $e->getMessage();
} finally {
    mysqli_close($con);
}
?>

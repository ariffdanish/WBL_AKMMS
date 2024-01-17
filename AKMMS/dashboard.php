<?php 
    include ('mysession.php');
    if(!session_id())
    {
      session_start();
    }
include 'headerNav.php';
include 'dbconnect.php';
?>
<style>
    .table-container {
        max-height: 200px; /* Set the maximum height before enabling the scrollbar */
        overflow-y: auto; /* Enable vertical scrollbar when the content exceeds the height */
    }
</style>
<?php
// Assuming you have a database connection established

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-01');
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-t');

// Query to get the total earnings for the specified date range
$queryMonthly = "SELECT SUM(q_totalcost) AS totalEarnings FROM tb_quotation 
                 WHERE tb_quotation.q_ordID IN (
                     SELECT tb_order.Ord_id FROM tb_order 
                     WHERE tb_order.Ord_date BETWEEN '$startDate' AND '$endDate'
                 )";
$resultMonthly = mysqli_query($con, $queryMonthly);

// Check if the query was successful
if ($resultMonthly) {
    $rowMonthly = mysqli_fetch_assoc($resultMonthly);
    $totalEarningsMonthly = $rowMonthly['totalEarnings'];
} else {
    // Handle the error if the query fails
    $totalEarningsMonthly = 0;
}

// Query to get the total earnings for the current year
// Assuming you have received user input for start and end years, you can replace the hardcoded values below
// Assuming you have received user input for the year, replace the hardcoded value below
$selectedYear = isset($_POST['selected_year']) ? $_POST['selected_year'] : date('Y');

// Query to get the total earnings for the specified year
$queryYearly = "SELECT SUM(q_totalcost) AS totalEarnings FROM tb_quotation 
                WHERE YEAR((SELECT Ord_date FROM tb_order WHERE tb_order.Ord_id = tb_quotation.q_ordID)) = $selectedYear";
$resultYearly = mysqli_query($con, $queryYearly);

// Check if the query was successful
if ($resultYearly) {
    $rowYearly = mysqli_fetch_assoc($resultYearly);
    $totalEarningsYearly = $rowYearly['totalEarnings'];
} else {
    // Handle the error if the query fails
    $totalEarningsYearly = 0;
}



$monthlySalesData = array();
for ($i = 1; $i <= 12; $i++) {
    $query = "SELECT SUM(q_totalcost) AS monthlyEarnings FROM tb_quotation 
              WHERE MONTH((SELECT Ord_date FROM tb_order WHERE tb_order.Ord_id = tb_quotation.q_ordID)) = $i 
              AND YEAR((SELECT Ord_date FROM tb_order WHERE tb_order.Ord_id = tb_quotation.q_ordID)) = $currentYear";

    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $monthlyEarnings = $row['monthlyEarnings'];
        $monthlySalesData[] = $monthlyEarnings ? $monthlyEarnings : 0;
    } else {
        // Handle the error if the query fails
        $monthlySalesData[] = 0;
    }
}

$querys = "SELECT i.i_Code, SUM(o.q_quantity) as totalQuantity
          FROM tb_quotation o
          JOIN tb_item i ON o.q_codeID = i.i_CodeID
          JOIN tb_order ord ON o.q_ordID = ord.Ord_id
          WHERE YEAR(ord.Ord_date) = $currentYear
          GROUP BY q_codeID
          ORDER BY totalQuantity DESC
          LIMIT 3";


$results = mysqli_query($con, $querys);

// Check if the query was successful
if ($results) {
    $labels = $data = $backgroundColor = array();

    while ($row = mysqli_fetch_assoc($results)) {
        $labels[] = $row['i_Code'];
        $data[] = $row['totalQuantity'];
        // You can customize the colors as needed
        $backgroundColor[] = '#' . substr(md5(rand()), 0, 6);
    }
} else {
    // Handle the error if the query fails
    $labels = $data = $backgroundColor = array();
}
?>




<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0 dashboard-heading fw-bold">DASHBOARD AK MAJU RESOURCES</h3>
        <div >
                                
            </div>
            <div >
            <span class="text-uppercase text-align:right text-primary fw-bold h10 mb-1">Last updated: </span>
                <span class="text-dark text-align:right fw-bold h10 mb-0"><?php echo date("Y-m-d H:i:s"); ?></span>
            </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Report
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item text-white" href="#" onclick="printDocument3('financialreport.php')">Financial Report</a>
                <a class="dropdown-item text-white" href="#" onclick="printDocument2('salesreport.php')">Sales Report (Current Month)</a>
                <a class="dropdown-item text-white" href="#" onclick="printDocument1('inventoryreport.php')">Inventory Report</a>
            </div>
        </div>
    </div>

<script>
    function printDocument1() {
        // You can replace 'target_file.php' with the filename you want to print
        var targetFile = 'inventoryreport.php';
        
        var printWindow = window.open(targetFile, '_blank');
        
        printWindow.onload = function() {
            printWindow.print();
        };
    }
    function printDocument2() {
        // You can replace 'target_file.php' with the filename you want to print
        var targetFile = 'salesreport.php';
        
        var printWindow = window.open(targetFile, '_blank');
        
        printWindow.onload = function() {
            printWindow.print();
        };

    }
    function printDocument3() {
        // You can replace 'target_file.php' with the filename you want to print
        var targetFile = 'financialreport.php';
        
        var printWindow = window.open(targetFile, '_blank');
        
        printWindow.onload = function() {
            printWindow.print();
        };
        
    }
</script>
        
    </div>
    <?php
// Assuming you have a database connection established

// Get the current month and last month
$currentMonth = date('Y-m');
$lastMonth = date('Y-m', strtotime('-1 month'));

// Query to calculate total sales for the current month
$queryCurrentMonth = "SELECT SUM(q.q_totalcost) AS totalSalesCurrentMonth
                      FROM tb_quotation q
                      JOIN tb_order o ON q.q_ordID = o.Ord_id
                      WHERE MONTH(o.Ord_date) = MONTH(CURDATE())
                        AND YEAR(o.Ord_date) = YEAR(CURDATE())";

$resultCurrentMonth = mysqli_query($con, $queryCurrentMonth);
$rowCurrentMonth = mysqli_fetch_assoc($resultCurrentMonth);
$totalSalesCurrentMonth = $rowCurrentMonth['totalSalesCurrentMonth'];

// Query to calculate total sales for the last month
$queryLastMonth = "SELECT SUM(q.q_totalcost) AS totalSalesLastMonth
                   FROM tb_quotation q
                   JOIN tb_order o ON q.q_ordID = o.Ord_id
                   WHERE MONTH(o.Ord_date) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
                     AND YEAR(o.Ord_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))";

$resultLastMonth = mysqli_query($con, $queryLastMonth);
$rowLastMonth = mysqli_fetch_assoc($resultLastMonth);
$totalSalesLastMonth = $rowLastMonth['totalSalesLastMonth'];

// Calculate the sales growth
$salesGrowth = $totalSalesCurrentMonth - $totalSalesLastMonth;

// Output the result


?>




    
    <div class="card shadow p-3">
    <div class="row">
        <!-- Monthly Earnings -->

        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                <span>Sales Growth (<?php echo date('F'); ?>)</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0">
                                <span style="color: <?php echo ($salesGrowth < 0) ? 'red' : 'green'; ?>">RM<?php echo number_format($salesGrowth, 2); ?></span>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 mb-4">
    <div class="card shadow border-start-primary py-2">
        <div class="card-body">
            <!-- Toggleable form with date input -->
            <div id="dateFormContainer">
                <form id="dateForm" method="post" action="" style="display: none;">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" required>

                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" required>

                    <button type="submit">Submit</button>
                </form>
            </div>

            <div class="row align-items-center no-gutters">
                <div class="col me-2">
                    <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                        <span id="monthly-earnings">Monthly Earnings (<?php echo date('F Y', strtotime($startDate)); ?> - <?php echo date('F Y', strtotime($endDate)); ?>)</span>
                    </div>
                    <div class="text-dark fw-bold h5 mb-0">
                        <span>RM<?php echo number_format($totalEarningsMonthly, 2); ?></span>
                    </div>
                </div>
                <div class="col-auto" id="calendarIcon">
                    <i class="fas fa-calendar fa-2x text-black" style="cursor: pointer;"></i>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Yearly Earnings -->
        <div class="col-md-6 col-xl-4 mb-4">
    <div class="card shadow border-start-primary py-2">
        <div class="card-body">
            <!-- Toggleable form with year input -->
            <div id="yearForm" style="display: none;">
                <form method="post" action="">
                    <label for="selected_year">Select Year:</label>
                    <select name="selected_year" id="selected_year" required>
                        <?php
                        $currentYear = date('Y');
                        for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
                            echo "<option value=\"$year\">$year</option>";
                        }
                        ?>
                    </select>

                    <button type="submit">Submit</button>
                </form>
            </div>

            <div class="row align-items-center no-gutters">
                <div class="col me-2">
                    <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                        <span id="yearly-earnings">Yearly Earnings Of <?php echo $selectedYear; ?></span>
                    </div>
                    <div class="text-dark fw-bold h5 mb-0">
                        <span>RM<?php echo number_format($totalEarningsYearly, 2); ?></span>
                    </div>
                </div>
                <div class="col-auto" id="yearIcon">
                    <i class="fas fa-calendar fa-2x text-black" style="cursor: pointer;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

        
        <div class="col-md-6 col-xl-4 mb-4">
    <div class="card shadow border-start-warning">
        <div class="card-body">
        <h6 class="text-uppercase text-primary fw-bold mb-3"><b>Pending Order Confirmation (Payment)</b></h6>
            <div class="table-container">
                <table class="table table-striped mb-0 table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><b>Order ID</b></th>
                            <th scope="col"><b>Customer Name</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryPendingPayments = "SELECT o.Ord_id, c.c_name
                                                FROM tb_order o
                                                LEFT JOIN tb_customer c ON o.Ord_cid = c.c_id
                                                WHERE o.Ord_id NOT IN (SELECT p_ordID FROM tb_payment)";
                        $resultPendingPayments = mysqli_query($con, $queryPendingPayments);

                        if ($resultPendingPayments && mysqli_num_rows($resultPendingPayments) > 0) {
                            while ($row = mysqli_fetch_assoc($resultPendingPayments)) {
                                echo "<tr>";
                                echo "<td>" . $row['Ord_id'] . "</td>";
                                echo "<td>" . $row['c_name'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No pending orders</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

<div class="col-md-6 col-xl-4 mb-4">
    <div class="card shadow border-start-warning">
        <div class="card-body">
        <h6 class="text-uppercase text-primary fw-bold mb-3"><b>Active Staff</b></h6>
            <div class="table-container">
                <table class="table table-striped mb-0">
                <thead>
    <tr>
        <th scope="col"><b>Staff ID</b></th>
        <th scope="col"><b>Staff Name</b></th>
       
        <th scope="col"><b>Action</b></th> <!-- New column for the delete button -->
    </tr>
</thead>
<tbody>
    <?php
    $querys = "SELECT e.e_id, e.e_name, e.e_tel,e.e_role
               FROM tb_employee e
               LEFT JOIN tb_emprole r ON e.e_role = r.role_id
               WHERE e.e_role IN ('1', '2')";

    $results = mysqli_query($con, $querys);

    
    if ($results && mysqli_num_rows($results) > 0) {
        while ($rows = mysqli_fetch_assoc($results)) {
            echo "<tr>";
            echo "<td>" . $rows['e_id'] . "</td>";
            echo "<td>" . $rows['e_name'] . "</td>";
            
            echo "<td>";
            echo '<button class="btn btn-danger" onclick="deleteItem(\'' . $rows['e_id'] . '\' )">Delete</button>';
            echo "</td>"; // Delete button
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No new staff</td></tr>";
    }
    ?>
    
    
    <script>
    // JavaScript function to confirm item deletion
    function deleteItem(e_id) {
        var confirmDelete = confirm("Are you sure you want to inactivate this staff?");
        if (confirmDelete) {
            // If user confirms, send an AJAX request to update_employee_role.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_employee_role.php?e_id=' + e_id, true);
    
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Item successfully deleted
                    alert("Staff with ID " + e_id + " has been removed.");
                    // Reload the page to reflect the changes
                    location.reload();
                } else {
                    // Display an error message if deletion fails
                    alert("Error: Unable to delete the staff.");
                }
            };
    
            xhr.send();
        }
    }
    </script>
    
</tbody>



                </table>
            </div>
        </div>
        
    </div>
</div>


<div class="col-md-6 col-xl-4 mb-4">
    <div class="card shadow border-start-warning">
        <div class="card-body">
        <h6 class="text-uppercase text-primary fw-bold mb-3"><b>Low Item Stock! Please Restock ASAP</b></h6>
            <div class="table-container">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col"><b>Item Code</b></th>
                            <th scope="col"><b>Item Name</b></th>
                            <th scope="col"><b>Quantity</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $querys = "SELECT i_Code, i_Name, i_Quantity
                                                FROM tb_item 
                                                WHERE i_Quantity < 20";
                        $results = mysqli_query($con, $querys);

                        if ($results && mysqli_num_rows($results) > 0) {
                            while ($rows = mysqli_fetch_assoc($results)) {
                                echo "<tr>";
                                echo "<td>" . $rows['i_Code'] . "</td>";
                                echo "<td>" . $rows['i_Name'] . "</td>";
                                echo "<td>" . $rows['i_Quantity'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No Item in low stock</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
        
        
        
        <!-- Earnings Overview Chart -->
        <div class="col-lg-7 col-xl-8 mb-4">
            <div class="card shadow mb-4">
                <!-- Chart Header -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary fw-bold m-0">Earnings Overview (<?php echo date('Y'); ?>)</h6>
                    <div class="dropdown no-arrow">
                        
                    </div>
                </div>
                <!-- Chart Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="monthlySalesChart" data-bss-chart='{
                            "type": "line",
                            "data": {
                                "labels": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                "datasets": [{
                                    "label": "Earnings",
                                    "fill": true,
                                    "data": <?php echo json_encode($monthlySalesData); ?>,
                                    "backgroundColor": "rgba(78, 115, 223, 0.05)",
                                    "borderColor": "rgba(78, 115, 223, 1)"
                                }]
                            },
                            "options": {
                                "maintainAspectRatio": false,
                                "legend": {
                                    "display": false,
                                    "labels": {
                                        "fontStyle": "normal"
                                    }
                                },
                                "title": {
                                    "fontStyle": "normal"
                                },
                                "scales": {
                                    "xAxes": [{
                                        "gridLines": {
                                            "color": "rgb(234, 236, 244)",
                                            "zeroLineColor": "rgb(234, 236, 244)",
                                            "drawBorder": false,
                                            "drawTicks": false,
                                            "borderDash": ["2"],
                                            "zeroLineBorderDash": ["2"],
                                            "drawOnChartArea": false
                                        },
                                        "ticks": {
                                            "fontColor": "#858796",
                                            "fontStyle": "normal",
                                            "padding": 20
                                        }
                                    }],
                                    "yAxes": [{
                                        "gridLines": {
                                            "color": "rgb(234, 236, 244)",
                                            "zeroLineColor": "rgb(234, 236, 244)",
                                            "drawBorder": false,
                                            "drawTicks": false,
                                            "borderDash": ["2"],
                                            "zeroLineBorderDash": ["2"]
                                        },
                                        "ticks": {
                                            "fontColor": "#858796",
                                            "fontStyle": "normal",
                                            "padding": 20
                                        }
                                    }]
                                }
                            }
                        }'></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4 mb-4">
    <div class="card shadow mb-4">
        <!-- Chart Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="text-primary fw-bold m-0">Top Three Items (<?php echo $currentYear; ?>)</h6>
            <div class="dropdown no-arrow">
                
            </div>
        </div>
        <!-- Chart Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="topItemsChart" data-bss-chart='{
                    "type": "doughnut",
                    "data": {
                        "labels": <?php echo json_encode($labels); ?>,
                        "datasets": [{
                            "label": "",
                            "backgroundColor": <?php echo json_encode($backgroundColor); ?>,
                            "borderColor": "#ffffff",
                            "data": <?php echo json_encode($data); ?>
                        }]
                    },
                    "options": {
                        "maintainAspectRatio": false,
                        "legend": {
                            "display": false,
                            "labels": {
                                "fontStyle": "normal"
                            }
                        },
                        "title": {
                            "fontStyle": "normal"
                        }
                    }
                }'></canvas>
            </div>
            <!-- Chart Legend -->
            <div class="text-center small mt-4">
                <?php for ($i = 0; $i < count($labels); $i++) : ?>
                    <span class="me-2">
                        <i class="fas fa-circle" style="color: <?php echo $backgroundColor[$i]; ?>"></i>&nbsp;<?php echo $labels[$i]; ?>
                    </span>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

            

        
                
                    

<!-- Top Three Items Chart -->



                       
            
                  



<script>
    // Function to add a new goal
    function addGoal() {
        const newGoalInput = document.getElementById('newGoalInput');
        const userGoalsList = document.getElementById('userGoalsList');

        if (newGoalInput.value.trim() !== '') {
            const newGoalId = 'goal' + (userGoalsList.childElementCount + 1);
            const newGoalHtml = `
    <li class="list-group-item d-flex justify-content-between align-items-center" id="${newGoalId}">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="goalCheckbox${newGoalId}" onchange="toggleGoal('${newGoalId}')">
            <label class="form-check-label fw-bold" for="goalCheckbox${newGoalId}">${newGoalInput.value}</label>
        </div>
        <button class="btn btn-danger btn-sm" onclick="deleteGoal('${newGoalId}')"><i class="fas fa-trash"></i></button>
    </li>
`;
            userGoalsList.insertAdjacentHTML('beforeend', newGoalHtml);
            newGoalInput.value = '';
            // Hide the modal after adding a goal
        }
    }

    // Function to delete a goal
    function deleteGoal(goalId) {
        const userGoal = document.getElementById(goalId);

        if (userGoal) {
            userGoal.parentNode.removeChild(userGoal);
        }
    }

    // Function to toggle goal status (tick/untick)
    function toggleGoal(goalId) {
        const checkbox = document.getElementById(`goalCheckbox${goalId}`);
        const goal = document.getElementById(goalId);

        if (checkbox.checked) {
            goal.classList.add('text-muted'); // Apply styles for ticked goal
        } else {
            goal.classList.remove('text-muted'); // Remove styles for unticked goal
        }
    }


   
    document.addEventListener('DOMContentLoaded', function () {
        var calendarIcon = document.getElementById('calendarIcon');
        var dateForm = document.getElementById('dateForm');

        if (calendarIcon && dateForm) {
            calendarIcon.addEventListener('click', function (event) {
                event.preventDefault(); // Prevents the default behavior of the link

                dateForm.style.display = dateForm.style.display === 'none' ? 'block' : 'none';
            });
        }
    });


    document.addEventListener('DOMContentLoaded', function () {
        var yearIcon = document.getElementById('yearIcon');
        var yearForm = document.getElementById('yearForm');

        if (yearIcon && yearForm) {
            yearIcon.addEventListener('click', function (event) {
                event.preventDefault(); // Prevents the default behavior of the link

                yearForm.style.display = yearForm.style.display === 'none' ? 'block' : 'none';
            });
        }
    });

</script>


<?php include 'footer.php';?>
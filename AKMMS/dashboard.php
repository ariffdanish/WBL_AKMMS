<?php 
    include ('mysession.php');
    if(!session_id())
    {
      session_start();
    }
include 'headerNav.php';
include 'dbconnect.php';
?>

<?php
// Assuming you have a database connection established

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Query to get the total earnings for the current month
$queryMonthly = "SELECT SUM(q_totalcost) AS totalEarnings FROM tb_quotation 
                 WHERE MONTH((SELECT Ord_date FROM tb_order WHERE tb_order.Ord_id = tb_quotation.q_ordID)) = $currentMonth 
                 AND YEAR((SELECT Ord_date FROM tb_order WHERE tb_order.Ord_id = tb_quotation.q_ordID)) = $currentYear";

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
$queryYearly = "SELECT SUM(q_totalcost) AS totalEarnings FROM tb_quotation 
                WHERE YEAR((SELECT Ord_date FROM tb_order WHERE tb_order.Ord_id = tb_quotation.q_ordID)) = $currentYear";
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

$querys = "SELECT Ord_itemMaterial, COUNT(*) as usageCount
          FROM tb_order o
          JOIN tb_item i ON o.Ord_itemMaterial = i.i_Code
          WHERE YEAR(o.Ord_date) = $currentYear
          GROUP BY Ord_itemMaterial
          ORDER BY usageCount DESC
          LIMIT 3";

$results = mysqli_query($con, $querys);

// Check if the query was successful
if ($results) {
    $labels = $data = $backgroundColor = array();

    while ($row = mysqli_fetch_assoc($results)) {
        $labels[] = $row['Ord_itemMaterial'];
        $data[] = $row['usageCount'];
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
                <a class="dropdown-item text-black" href="#" onclick="printDocument1('inventoryreport.php')">Inventory Report</a>
                <a class="dropdown-item text-black" href="#" onclick="printDocument2('salesreport.php')">Sales Report</a>
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
    <!-- Earnings Cards and User Goals -->
    
    
    <div class="row">
        <!-- Monthly Earnings -->

        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                <span>Sales Growth</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0">
                                <span>RM<?php echo number_format($salesGrowth, 2); ?></span>
                                
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                <span>Current Monthly Earnings</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0">
                                <span>RM<?php echo number_format($totalEarningsMonthly, 2); ?></span>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yearly Earnings -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                <span>Yearly Earnings</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0">
                                <span>RM<?php echo number_format($totalEarningsYearly, 2); ?></span>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <!-- Earnings Overview Chart -->
        <div class="col-lg-7 col-xl-8 mb-4">
            <div class="card shadow mb-4">
                <!-- Chart Header -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary fw-bold m-0">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                            <i class="fas fa-ellipsis-v text-gray-400"></i>
                        </button>
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
                <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                    <i class="fas fa-ellipsis-v text-gray-400"></i>
                </button>
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

            

        <div class="col-md-6 col-xl-4 mb-4">
    <div class="card shadow border-start-warning">
        <div class="card-body">
        <h6 class="text-uppercase text-primary fw-bold mb-3"><b>Pending Orders</b></h6>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
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
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col"><b>Staff ID</b></th>
                            <th scope="col"><b>Staff Name</b></th>
                            <th scope="col"><b>Contact Info</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $querys = "SELECT e.e_id, e.e_name, e.e_tel
                                                FROM tb_employee e
                                                LEFT JOIN tb_emprole r ON e.e_role = r.role_id";
                        $results = mysqli_query($con, $querys);

                        if ($results && mysqli_num_rows($results) > 0) {
                            while ($rows = mysqli_fetch_assoc($results)) {
                                echo "<tr>";
                                echo "<td>" . $rows['e_id'] . "</td>";
                                echo "<td>" . $rows['e_name'] . "</td>";
                                echo "<td>" . $rows['e_tel'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No new staff</td></tr>";
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
        <h6 class="text-uppercase text-primary fw-bold mb-3"><b>Alert! : Low Stock</b></h6>
            <div class="table-responsive">
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
                                                WHERE i_Quantity < 10";
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
</script>








<?php include 'footer.php';?>
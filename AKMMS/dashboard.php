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
                                <span>Monthly Earnings</span>
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

        <!-- User Goals -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                <span>User Goals</span>
                            </div>
                            <!-- Goals List -->
                            <ul class="list-group" id="userGoalsList">
                                <!-- Example Goal (You can loop through user goals here) -->
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="goal1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="goalCheckbox1" onchange="toggleGoal('goal1')">
                                        <label class="form-check-label" for="goalCheckbox1">Example Goal 1</label>
                                    </div>
                                    <button class="btn btn-danger btn-sm" onclick="deleteGoal('goal1')"><i class="fas fa-trash"></i></button>
                                </li>
                                <!-- Add more goal items here -->
                            </ul>

                            <!-- Add New Goal Form -->
                            <form class="mt-3">
    <div class="input-group">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGoalsModal">
            Add New Goals
        </button>
    </div>
</form>

                        </div>
                       
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addGoalsModal" tabindex="-1" aria-labelledby="addGoalsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGoalsModalLabel">Add New Goals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="addGoal(); return false;">
                    <div class="mb-3">
                        <label for="newGoalInput" class="form-label">New Goal</label>
                        <input type="text" class="form-control" id="newGoalInput" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Goal</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Charts -->
    <div class="row">
        <div class="col-lg-7 col-xl-8">
            <!-- Earnings Overview Chart -->
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

        <!-- Top Three Items Chart -->
        <div class="col-lg-5 col-xl-4">
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
    </div>
</div>
                       
            
                  



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
<?php include 'headerNav.php';?>
<?php
// Assuming you have a database connection established
include 'dbconnect.php';
// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Query to get the total earnings for the current month
$queryMonthly = "SELECT SUM(Ord_totalcost) AS totalEarnings FROM tb_Order WHERE MONTH(Ord_date) = $currentMonth AND YEAR(Ord_date) = $currentYear";
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
$queryYearly = "SELECT SUM(Ord_totalcost) AS totalEarnings FROM tb_Order WHERE YEAR(Ord_date) = $currentYear";
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
    $query = "SELECT SUM(Ord_totalcost) AS monthlyEarnings FROM tb_Order WHERE MONTH(Ord_date) = $i AND YEAR(Ord_date) = $currentYear";
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
$querys = "SELECT Ord_itemName, COUNT(*) as usageCount
          FROM tb_Order o
          JOIN tb_item i ON o.Ord_itemName = i.i_Name
          WHERE YEAR(Ord_date) = $currentYear
          GROUP BY Ord_itemName
          ORDER BY usageCount DESC
          LIMIT 3";

$results = mysqli_query($con, $querys);

// Check if the query was successful
if ($results) {
    $labels = $data = $backgroundColor = array();

    while ($row = mysqli_fetch_assoc($results)) {
        $labels[] = $row['Ord_itemName'];
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
                        <h3 class="text-dark mb-0">Dashboard</h3>
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>

                    <div class="row">
    <!-- Monthly Earnings -->
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Monthly Earnings</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>RM<?php echo number_format($totalEarningsMonthly, 2); ?></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Yearly Earnings -->
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Yearly Earnings</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>RM<?php echo number_format($totalEarningsYearly, 2); ?></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>


                        

    <div class="row">
    <div class="col-lg-7 col-xl-8">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary fw-bold m-0">Earnings Overview</h6>
                <div class="dropdown no-arrow">
                    <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                        <i class="fas fa-ellipsis-v text-gray-400"></i>
                    </button>
                </div>
            </div>
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
</div>

<div class="col-lg-5 col-xl-4">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="text-primary fw-bold m-0">Top Three Items (<?php echo $currentYear; ?>)</h6>
            <div class="dropdown no-arrow">
                <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                    <i class="fas fa-ellipsis-v text-gray-400"></i>
                </button>
            </div>
        </div>
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
            <div class="text-center small mt-4">
                <?php for ($i = 0; $i < count($labels); $i++) : ?>
                    <span class="me-2"><i class="fas fa-circle" style="color: <?php echo $backgroundColor[$i]; ?>"></i>&nbsp;<?php echo $labels[$i]; ?></span>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
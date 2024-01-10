<?php
include ('mysession.php');
if(!session_id())
{
    session_start();
}
// Include your database connection file
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Your existing head content here -->
    <title>AKMMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Browse Item</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">

    <style type="text/css">
    body {
        font-family: Verdana;
    }

    div.invoice {
        border: 1px solid #ccc;
        padding: 10px;
        max-width: 570pt; /* Set a maximum width for the invoice */
        margin: auto; /* Center the invoice */
    }

    .logo-and-company {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo-container {
        text-align: center;
        margin-right: 20px;
    }

    .logo {
        max-width: 100px; /* Set the maximum width of your logo */
    }

    .company-address {
        flex-grow: 1;
    }

    .invoice-title {
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
    }

    .line {
        border-top: 2px solid #000;
        margin-top: 5px;
    }

    .details-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-top: 20px;
    }

    div.customer-address,
    div.invoice-details {
        border: 1px solid #ccc;
        width: 48%; /* Adjust the width as needed */
        padding: 10px;
    }

    .clear-fix {
        clear: both;
        float: none;
    }

    table {
        width: 100%;
        border-collapse: collapse; /* Add this line to collapse table borders */
        margin-top: 20px; /* Add margin to the table */
    }

    th,
    td {
        border: 1px solid #ccc; /* Add border to table cells */
        padding: 8px;
        text-align: left;
    }

    .text-center,
    .text-right {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }
</style>
</head>

<body>
    <div class="invoice">
        <!-- Your existing HTML structure here -->
        <div class="logo-and-company">
            <div class="logo-container">
                <img src="../AKMMS/akmaju.jpeg" alt="AK Maju Logo" class="logo">
            </div>
            <div class="company-address">
                AK Maju Resources
                <br />
                20 (Jalan Tengku Ahmad)
                <br />
                85000 Segamat, Johor Malaysia
                <br />
            </div>
        </div>

        <div class="invoice-title">SALES REPORT</div>
        <div class="line"></div>
        <!-- ... Previous code ... -->

        <table border='1' cellspacing='0'>
    <tr>
        <th width=250>Description</th>
        <th width=150 class='text-center'>Quantity Sold</th>
        <th width=150 class='text-center'>Total Amount</th>
       
    </tr>


    <?php
    $totalSales = 0;
    
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
    // Use the existing connection from your connection file
    $query = "SELECT o.Ord_name, q.q_quantity,q.q_itemDesc,q_totalcost, i.i_Name, i.i_Quantity, i.i_Material,q.q_tax
            FROM tb_order o
            INNER JOIN tb_quotation q ON o.Ord_id = q.q_ordID
            INNER JOIN tb_item i ON q.q_codeID = i.i_CodeID";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $description = $row['Ord_name'] . " - " . $row['q_itemDesc'];
            $quantitySold = $row['q_quantity'];
            $totalAmount = $row['q_totalcost'];

            echo("<tr>");
            echo("<td>$description</td>");
            echo("<td class='text-center'>$quantitySold</td>");
            echo("<td class='text-center'>$totalAmount</td>");
            
            echo("</tr>");

            // Accumulate total sales

            $totalSales += $totalAmount;
            $tax = $row['q_tax'];
        }

        // Display total sales and apply VAT
        
        $sum = $tax + $totalSales;


        echo("<tr>");
       echo("<br>");
        echo("<td colspan='2' class='text-right'><b>Total Sales:</b></td>");
        echo("<td class='text-center'><b>RM $totalSales</b></td>");
        echo("</tr>");
        echo("<tr>");
        
        echo("<td></td>");
        echo("<td class='text-center'><b>Final Amount (Tax inc):</b></td>");
        echo("<td class='text-center'><b>RM $sum</b></td>");
        echo("</tr>");
        echo("<td></td>");
        echo("<td class='text-center'><b>Sales Growth (Current Month):</b></td>");
        echo("<td class='text-center'><b>RM $salesGrowth </b></td>");
    } else {
        echo("<tr><td colspan='4'>No data available</td></tr>");
    }
    
    
    // Close the result set
    mysqli_free_result($result);

    // Close the database connection
    mysqli_close($con);
    ?>
</table>

    </div>
</body>

</html>

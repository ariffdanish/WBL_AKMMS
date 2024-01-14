<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
// Include your database connection file
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AK MAJU RESOURCES</title>
    <link rel="icon" type="image/x-icon" href="akmaju.jpeg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    
    <style type="text/css">
        /* Your existing styles */
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
            </div> <!-- Logo and company information -->
        </div>

        <div class="invoice-title">FINANCIAL REPORT</div>
        <div class="line"></div>

        <table border='1' cellspacing='0'>
            <tr>
                <th width=250>Description</th>
                <th width=150 class='text-center'>Quantity Sold</th>
                <th width=150 class='text-center'>Unit Price</th>
                <th width=150 class='text-center'>Total Amount</th>
            </tr>

            <?php
            $totalSales = 0;
            $totalCost = 0;

            $query = "SELECT o.Ord_name, q.q_quantity, q.q_itemDesc, q.q_totalcost, i.i_Name, i.i_Quantity, i.i_Material, q.q_tax,q.q_price
                    FROM tb_order o
                    INNER JOIN tb_quotation q ON o.Ord_id = q.q_ordID
                    INNER JOIN tb_item i ON q.q_codeID = i.i_CodeID";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $description = $row['Ord_name'] . " - " . $row['q_itemDesc'];
                    $quantitySold = $row['q_quantity'];
                    $unitPrice = $row['q_price'];
                    $totalAmount = $row['q_totalcost'];
                   

                    echo("<tr>");
                    echo("<td>$description</td>");
                    echo("<td class='text-center'>$quantitySold</td>");
                    echo("<td class='text-center'>" . number_format($unitPrice, 2) . "</td>");
                    echo("<td class='text-center'>" . number_format($totalAmount, 2) . "</td>");
                    echo("</tr>");

                    // Accumulate total sales and cost
                    $totalSales += $totalAmount;
                    $totalCost += ($unitPrice * $quantitySold);
                }

                // Display total sales, total cost, and net profit
                $netProfit = $totalSales - $totalCost;

                echo("<tr>");
                echo("<td colspan='3' class='text-right'><b>Total Sales:</b></td>");
                echo("<td class='text-center'><b>RM " . number_format($totalSales, 2) . "</b></td>");
                echo("</tr>");
                echo("<tr>");
                echo("<td colspan='3' class='text-right'><b>Total Cost:</b></td>");
                echo("<td class='text-center'><b>RM " . number_format($totalCost, 2) . "</b></td>");
                echo("</tr>");
                echo("<tr>");
                echo("<td colspan='3' class='text-right'><b>Net Profit:</b></td>");
                echo("<td class='text-center'><b>RM " . number_format($netProfit, 2) . "</b></td>");
                echo("</tr>");
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

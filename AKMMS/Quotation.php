<?php
include ('mysession.php');
if(!session_id())
{
    session_start();
}
// Include your database connection file
include 'dbconnect.php';
$ordId = isset($_GET['Ord_cid']) ? intval($_GET['Ord_cid']) : 0;
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

        <div class="invoice-title">QUOTATION</div>
        <div class="line"></div>

        <div class="details-container">
            <div class="customer-address">
                <?php
                // Fetch customer address for the specified Ord_id
                $queryCustomerAddress = "SELECT DISTINCT c_name FROM tb_customer WHERE c_id =$ordId ";
                $resultCustomerAddress = mysqli_query($con, $queryCustomerAddress);

                if ($resultCustomerAddress && mysqli_num_rows($resultCustomerAddress) > 0) {
                    $row = mysqli_fetch_assoc($resultCustomerAddress);
                    $customer_address = $row['c_name'];

                    echo "To:<br />";
                    echo "$customer_address";
                } else {
                    echo "No customer address available";
                }
                ?>
            </div>

            <div class="invoice-details">
                <?php
                // Fetch invoice details for the specified Ord_id
                $queryInvoiceDetails = "SELECT Ord_id, DATE_FORMAT(CURDATE(), '%d/%m/%Y') AS formatted_date FROM tb_order WHERE Ord_cid = $ordId ORDER BY Ord_id DESC LIMIT 1";
                $resultInvoiceDetails = mysqli_query($con, $queryInvoiceDetails);

                if ($resultInvoiceDetails && mysqli_num_rows($resultInvoiceDetails) > 0) {
                    $row = mysqli_fetch_assoc($resultInvoiceDetails);
                    $invoice_number = $row['Ord_id'];
                    $invoice_date = $row['formatted_date'];

                    echo "Quotation No: $invoice_number<br />";
                    echo "Date: $invoice_date";
                } else {
                    echo "No invoice data available";
                }
                ?>
            </div>
        </div>

        <!-- ... Rest of the HTML and PHP code ... -->

        <div class="clear-fix"></div>

        <table border='1' cellspacing='0'>
        <tr>
                <th width=250>Description</th>
                <th width=50>Quantity</th>
                <th class='text-center'width=50>Unit price (RM)</th>
                <th class='text-center'width=50>DISC AMOUNT (RM)</th>
                <th class='text-center'width=50>TAX AMOUNT (RM)</th>
                <th class='text-center'width=50>Total INCL. TAX (RM)</th>
            </tr>

            <?php
            $total = 0;
            

            // Use the existing connection from your connection file
            $queryItems = "SELECT q.q_itemDesc, q.q_quantity, q.q_price,q.q_discount,q.q_tax 
               FROM tb_quotation q
               JOIN tb_order o ON q.q_ordID = o.Ord_id
               WHERE o.Ord_cid = $ordId";

            $resultItems = mysqli_query($con, $queryItems);

            if ($resultItems && mysqli_num_rows($resultItems) > 0) {
                while ($row = mysqli_fetch_assoc($resultItems)) {
                    $description = $row['q_itemDesc'];
                    $amount = $row['q_quantity'];
                    $unit_price = ($row['q_price']);
                    $disc = ($row['q_discount']);
                    $tax = ($row['q_tax']);
                    $total_price = (($amount * $unit_price)-$disc+$tax);
                    $total += $total_price;
                    echo("<tr>");
                    echo("<td>$description</td>");
                    echo("<td class='text-center'>$amount</td>");
                    echo("<td class='text-right'> $unit_price</td>");
                    echo("<td class='text-right'> $disc</td>");
                    echo("<td class='text-right'> $tax</td>");
                    echo("<td class='text-right'> $total_price</td>");
                    echo("</tr>");
                }
            }

      
echo("<tr>");
echo("<td></td>");
echo("<td></td>");
echo("<td colspan='3' class='text-right'><b>GRAND TOTAL</b></td>");
echo("<td class='text-right'><b>RM" . number_format((($total)), 2) . "</b></td>"); // Corrected line
echo("</tr>");


            // Close the result set
            mysqli_free_result($resultCustomerAddress);
            mysqli_free_result($resultInvoiceDetails);
            mysqli_free_result($resultItems);

            // Close the database connection
            mysqli_close($con);
            ?>
            <!-- The rest of your PHP code remains unchanged -->
        </table>
    </div>
</body>

</html>

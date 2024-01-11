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

        <div class="invoice-title">DELIVERY NOTES</div>
        <div class="line"></div>

        <div class="details-container">
            <div class="customer-address">
                <?php
                $query = "SELECT DISTINCT c_address FROM tb_customer WHERE c_id = $ordId";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $customer_address = $row['c_address'];

                    echo "To:<br />";
                    echo "$customer_address";
                } else {
                    echo "No customer address available";
                }
                ?>
            </div>

            <div class="invoice-details">
                <?php
               $queryInvoiceDetails = "SELECT Ord_id, DATE_FORMAT(CURDATE(), '%d/%m/%Y') AS formatted_date FROM tb_order WHERE Ord_cid = $ordId ORDER BY Ord_id DESC LIMIT 1";
               $resultInvoiceDetails = mysqli_query($con, $queryInvoiceDetails);

               if ($resultInvoiceDetails && mysqli_num_rows($resultInvoiceDetails) > 0) {
                   $row = mysqli_fetch_assoc($resultInvoiceDetails);
                   $invoice_number = $row['Ord_id'];
                   $invoice_date = $row['formatted_date'];

                   echo "Order No: $invoice_number<br />";
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
                <th class='text-center' width=320>Quantity</th>
                
            </tr>

            <?php
            $total = 0;
    

            // Use the existing connection from your connection file
            $query = "SELECT o.Ord_name, q.q_quantity 
            FROM tb_order o
            JOIN tb_quotation q ON o.Ord_id = q.q_ordID 
            WHERE o.Ord_cid = $ordId";
  

$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $total = 0; // Initialize total outside the while loop

    while ($row = mysqli_fetch_assoc($result)) {
        $description = $row['Ord_name'];
        $amount = $row['q_quantity'];
        $total_price = number_format($amount, 2); // Format the amount

        $total += $amount; // Accumulate the total without formatting

        echo("<tr>");
        echo("<td class='text-left'>$description</td>");
        echo("<td class='text-center'>$amount</td>");
        echo("</tr>");
    }

    // Display the grand total row outside the while loop
    echo("<tr>");
    echo("<td colspan='3' class='text-center'><b>GRAND TOTAL: " . number_format($total) . "</b></td>");
   
    echo("</tr>");
}
            

       

            // Close the result set
            mysqli_free_result($result);

            // Close the database connection
            mysqli_close($con);
            ?>
            <!-- The rest of your PHP code remains unchanged -->
        </table>
    </div>
</body>

</html>

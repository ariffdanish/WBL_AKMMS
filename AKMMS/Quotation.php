<?php
// Include your database connection file
include 'dbconnect.php';
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
            width: 570pt;
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
        }

        th {
            text-align: left;
        }

        td {}

        .text-left {
            text-align: left;
        }

        .text-center {
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
                $query = "SELECT DISTINCT Ord_address FROM tb_order";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $customer_address = $row['Ord_address'];

                    echo "To:<br />";
                    echo "$customer_address";
                } else {
                    echo "No customer address available";
                }
                ?>
            </div>

            <div class="invoice-details">
                <?php
                $query = "SELECT Ord_id, DATE_FORMAT(CURDATE(), '%d/%m/%Y') AS formatted_date FROM tb_order ORDER BY Ord_id DESC LIMIT 1";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $invoice_number = $row['Ord_id'];
                    $invoice_date = $row['formatted_date'];

                    echo "Invoice N°: $invoice_number<br />";
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
                <th width=80>Amount</th>
                <th width=100>Unit price</th>
                <th width=100>Total price</th>
            </tr>

            <?php
            $total = 0;
            $vat = 0.06;

            // Use the existing connection from your connection file
            $query = "SELECT Ord_name, Ord_itemName, Ord_itemQuantity, Ord_itemPrice FROM tb_order";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $description = $row['Ord_name'] . " - " . $row['Ord_itemName'];
                    $amount = $row['Ord_itemQuantity'];
                    $unit_price = number_format($row['Ord_itemPrice'], 2);
                    $total_price = number_format($amount * $unit_price, 2);
                    $total += $total_price;
                    echo("<tr>");
                    echo("<td>$description</td>");
                    echo("<td class='text-center'>$amount</td>");
                    echo("<td class='text-right'>€$unit_price</td>");
                    echo("<td class='text-right'>€$total_price</td>");
                    echo("</tr>");
                }
            }

            echo("<tr>");
echo("<td colspan='3' class='text-right'>Sub total</td>");
echo("<td class='text-right'>RM" . number_format($total, 2) . "</td>");
echo("</tr>");
echo("<tr>");
echo("<td colspan='3' class='text-right'>VAT</td>");
echo("<td class='text-right'>RM" . number_format(($total * (1 + $vat)), 2) . "</td>"); // Corrected line
echo("</tr>");
echo("<tr>");
echo("<td colspan='3' class='text-right'><b>TOTAL</b></td>");
echo("<td class='text-right'><b>RM" . number_format((($total * (1 + $vat)) + $total), 2) . "</b></td>");
echo("</tr>");


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

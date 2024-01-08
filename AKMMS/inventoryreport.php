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
        <!-- Your existing styles here -->
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

        <div class="invoice-title">INVENTORY REPORT</div>
        <div class="line"></div>
        <!-- ... Previous code ... -->

        <table border='1' cellspacing='0'>
            <tr>
                <th width=250 class='text-left'>Description</th>
               
                <th width=80 class='text-center'>Used Quantity</th>
                <th width=80 class='text-center'>Remaining Quantity</th>
            </tr>

            <?php
            $total = 0;
          

            // Use the existing connection from your connection file
            $query = "SELECT o.Ord_name, q.q_quantity, i.i_Name, i.i_Quantity, i.i_Material, i.i_Code
            FROM tb_order o
            INNER JOIN tb_item i ON o.Ord_itemMaterial = i.i_Code
            INNER JOIN tb_quotation q ON o.Ord_id = q.q_ordID";
  
$result = mysqli_query($con, $query);

$latestItems = array(); // To keep track of the latest occurrence of each item
$allItems = array(); // To store all items from the tb_item table

// Fetch all items from tb_item
$queryAllItems = "SELECT i_Name, i_Code,i_Quantity FROM tb_item";
$resultAllItems = mysqli_query($con, $queryAllItems);

if ($resultAllItems && mysqli_num_rows($resultAllItems) > 0) {
    while ($rowAllItems = mysqli_fetch_assoc($resultAllItems)) {
        $descriptionAllItems = $rowAllItems['i_Name'] . " - " . $rowAllItems['i_Code'];
        $allItems[] = $descriptionAllItems;
    }
}

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $description = $row['i_Name'] . " - " . $row['i_Code'];

        // Update values for the latest occurrence of the item
        $latestItems[$description] = [
            'usedQuantity' => $row['q_quantity'],
            'remainingQuantity' => $row['i_Quantity'] - $row['q_quantity'],
        ];

        // Store all items for comparison later
        $allItems[] = $description;
    }

    // Display the latest occurrences
    foreach ($latestItems as $description => $values) {
        echo("<tr>");
        echo("<td>$description</td>");
        echo("<td class='text-center'>" . $values['usedQuantity'] . "</td>");
        echo("<td class='text-center'>" . $values['remainingQuantity'] . "</td>");
        echo("</tr>");
    }
    $queryAllItems = "SELECT i_Name, i_Code, i_Quantity FROM tb_item";
    $resultAllItems = mysqli_query($con, $queryAllItems);

    if ($resultAllItems && mysqli_num_rows($resultAllItems) > 0) {
        while ($rowAllItems = mysqli_fetch_assoc($resultAllItems)) {
            $descriptionAllItems = $rowAllItems['i_Name'] . " - " . $rowAllItems['i_Code'];

            // Check if the item has not been displayed
            if (!isset($latestItems[$descriptionAllItems])) {
                echo("<tr>");
                echo("<td>$descriptionAllItems</td>");
                echo("<td class='text-center'>0</td>");
                echo("<td class='text-center'>" . $rowAllItems['i_Quantity'] . "</td>");
                echo("</tr>");
            }
        }
    }
} else {
    echo("<tr><td colspan='3'>No data available</td></tr>");
}
    // Display the items that have not been displayed
    


  

            // Close the result set
            mysqli_free_result($result);

            // Close the database connection
            mysqli_close($con);
            ?>
        </table>
    </div>
</body>

</html>

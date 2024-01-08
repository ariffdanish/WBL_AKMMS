<?php
include ('mysession.php');
if(!session_id())
{
    session_start();
}

// Replace these with your actual database credentials
include 'dbconnect.php';

// Function to generate notifications for tb_item
function generateItemNotifications($con) {
    $query = "SELECT * FROM tb_item WHERE i_Quantity < 5";
    $result = $con->query($query);

    while ($row = $result->fetch_assoc()) {
        $notification = "Low stock for item: " . $row['i_Name']. "_".$row['i_Code'];
        insertNotification($con, $notification);
        
    }
}

function generateOrderNotifications($con) {
    // Retrieve the timestamp of the last processed order from tb_inbox
    $lastProcessedOrderTimestampQuery = "SELECT MAX(inb_timestamp) AS lastProcessedOrderTimestamp FROM tb_inbox";
    $lastProcessedOrderTimestampResult = $con->query($lastProcessedOrderTimestampQuery);
    $lastProcessedOrderTimestamp = $lastProcessedOrderTimestampResult->fetch_assoc()['lastProcessedOrderTimestamp'];

    // Retrieve orders placed after the last processed order
    $newOrdersQuery = "SELECT * FROM tb_order WHERE Ord_date > '$lastProcessedOrderTimestamp' ORDER BY Ord_id";
    $newOrdersResult = $con->query($newOrdersQuery);

    while ($row = $newOrdersResult->fetch_assoc()) {
        $notification = "New order placed with ID: " . $row['Ord_id'];
        insertNotification($con, $notification);
        
    }

    
}


// Function to insert notification into tb_inbox with a check for duplicates
function insertNotification($con, $notification) {
    // Check if the notification already exists
    $existingQuery = "SELECT COUNT(*) AS count FROM tb_inbox WHERE inb_decs = '$notification'";
    $existingResult = $con->query($existingQuery);
    $existingCount = $existingResult->fetch_assoc()['count'];

    if ($existingCount == 0) {
        // Insert the notification if it doesn't exist
        $timestamp = date('Y-m-d H:i:s');
        $query = "INSERT INTO tb_inbox (inb_timestamp, inb_decs) VALUES ('$timestamp', '$notification')";
        $con->query($query);
    } 
}

// Generate notifications for tb_item
generateItemNotifications($con);

// Generate notifications for tb_order
generateOrderNotifications($con);

// Display all unique notifications from tb_inbox

$query = "SELECT * FROM tb_inbox GROUP BY inb_decs ORDER BY inb_timestamp DESC LIMIT 5";

$result = $con->query($query);

echo '<div id="notificationList">';

while ($row = $result->fetch_assoc()) {
    echo '<a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image me-3">
                <!-- Add an image/icon if needed -->
            </div>
            <div class="fw-bold">
                <div class="text-gray-600 small">' . $row['inb_timestamp'] . '</div>
                <span class="text-gray-900">' . $row['inb_decs'] . '</span>
            </div>
        </a>';
}

echo '</div>';

// Update notification count
$notificationCountQuery = "SELECT COUNT(DISTINCT inb_decs) AS count FROM tb_inbox";
$notificationCountResult = $con->query($notificationCountQuery);
$notificationCount = $notificationCountResult->fetch_assoc()['count'];

echo '<script>
        document.getElementById("notificationCount").innerText = ' . $notificationCount . ';
      </script>';

// Close the database connection

$con->close();

?>

<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

// retrieve data from form and session
$fbid = $_POST['fbid'];
$cidnum = $_POST['cidnum'];
$cname = $_POST['cname'];
$cphone = $_POST['cphone'];
$caddress = $_POST['caddress'];
$cemail = $_POST['cemail'];
$ctype = $_POST['ctype'];

// Update or Insert based on the presence of $fbid
if (!empty($fbid)) {
    $sql = "UPDATE tb_customer
            SET c_idnum='$cidnum', c_name='$cname', c_phone='$cphone', c_address='$caddress', c_email='$cemail', c_type='$ctype'
            WHERE c_id='$fbid'";
} else {
    $sql = "INSERT INTO tb_customer(c_idnum, c_name, c_phone, c_address, c_email, c_type)
            VALUES('$cidnum', '$cname', '$cphone', '$caddress', '$cemail', '$ctype')";
}

mysqli_query($con, $sql);

mysqli_close($con);

// Display Result
include 'headerNav.php';
?>

<div class="container" style="margin-top: 20px; padding: 20px;">
    <table class="table">
        <tr>
            <td><strong>Customer ID:</strong></td>
            <td><?php echo $cidnum; ?></td>
        </tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td><?php echo $cname; ?></td>
        </tr>
        <tr>
            <td><strong>Tel. No:</strong></td>
            <td><?php echo $cphone; ?></td>
        </tr>
        <tr>
            <td><strong>Address:</strong></td>
            <td><?php echo $caddress; ?></td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td><?php echo $cemail; ?></td>
        </tr>
        <tr>
            <td><strong>Type:</strong></td>
            <td><?php echo $ctype; ?></td>
        </tr>
    </table>
    <a class="btn btn-danger" href="customerdetails.php">Back</a>
</div>

<?php include 'footer.php'; ?>

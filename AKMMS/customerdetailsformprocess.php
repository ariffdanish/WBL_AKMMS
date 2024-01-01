<?php
include('mysession.php');
if (!session_id()) 
{
    session_start();
}
if(isset($_GET['id']))
{
    $fbid=$_GET['id'];
}
include('dbconnect.php');

// retrieve data from form and session
$cidnum = $_POST['cidnum'];
$cname = $_POST['cname'];
$cphone = $_POST['cphone'];
$caddress = $_POST['caddress'];
$cemail = $_POST['cemail'];
$ctype = $_POST['ctype'];
$ctypeOrd = $_POST['ctypeOrd'];

// Insert New Customer
$sql = "INSERT INTO tb_customer(c_idnum, c_name, c_phone, c_address, c_email, c_type, c_typeOrd)
        VALUES('$cidnum', '$cname', '$cphone', '$caddress', '$cemail', '$ctype', '$ctypeOrd')";

$result=mysqli_query($con,$sql);

$sqlr ="SELECT c_id, c_idnum, c_name, c_phone, c_address, c_email, c_type, c_typeOrd 
        FROM tb_customer
        WHERE c_id=$fbid";

$resultr=mysqli_query($con,$sqlr);
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
        <tr>
            <td><strong>Order:</strong></td>
            <td><?php echo $ctypeOrd; ?></td>
        </tr>
    </table>
    <a class="btn btn-danger" href="customerdetails.php">Back</a>
</div>



<?php include 'footer.php'; ?>

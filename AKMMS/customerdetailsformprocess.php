<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

// retrieve data from form and session
$cname = $_POST['cname'];
$cphone = $_POST['cphone'];
$caddress = $_POST['caddress'];
$cemail = $_POST['cemail'];
$ctype = $_POST['ctype'];
$suid = $_SESSION['suid'];

// Insert New Customer
$sql = "INSERT INTO tb_customer(c_id, c_name, c_address, c_email, c_type)
        VALUES('$suid', '$cname', '$caddress', '$cemail', '$ctype')";

//EXECUTE SQL
$result=mysqli_query($con,$sql);

//RETRIEVE row/data
$row=mysqli_fetch_array($result);

//Redirect to corresponding page
$count=mysqli_num_rows($result); //count data
if($count==1)
{
	$_SESSION['c_ic']=session_id();
	$_SESSION['suic']=$fic;

	//user available
	if($row['c_type']=='Personnel')  //Staff
	{
		$sql = "INSERT INTO tb_personnel(personnel_tel)
        VALUES ('')";
	}
	else
	{
    $sql = "INSERT INTO tb_agency(agency_tel)
    VALUES ('')";
	}
}


mysqli_close($con);

// Display Result
include 'headerNav.php';
?>

<div class="container"><br>
    <h5>Customer ID: <?php echo $suid; ?></h5><br>
    <h5>Name: <?php echo $cname; ?></h5><br>
    <h5>Tel. No: <?php echo $cphone; ?></h5><br>
    <h5>Address: <?php echo $caddress; ?></h5><br>
    <h5>Email: <?php echo $cemail; ?></h5><br>
    <h5>From: <?php echo $ctype; ?></h5><br>
</div>

<?php include 'footer.php'; ?>

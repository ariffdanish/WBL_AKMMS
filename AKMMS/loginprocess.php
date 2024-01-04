<?php
session_start();

//connect to DB
include('dbconnect.php');

//retrieve data from registration form
$fid=$_POST['fid'];
$fpwd=$_POST['fpwd'];



//CRUD Operations
//RETRIEVE -SQL retrieve statement
$sql=" SELECT * FROM tb_employee
		WHERE e_id='$fid' AND e_pwd='$fpwd'";


//EXECUTE SQL
$result=mysqli_query($con,$sql);

//RETRIEVE row/data
$row=mysqli_fetch_array($result);

//Redirect to corresponding page
$count=mysqli_num_rows($result); //count data
if($count==1)
{
	$_SESSION['e_id']=session_id();
	$_SESSION['suid']=$fid;

	//user available
	if($row['e_role']=='Admin')  //Admin
	{
		header('Location:index.php');
	}
	else
	{
		header('Location:index.php');
	}
}
else
{
	//User not available/exist
	//Add script to let user know either username or password wrong
	header('Location:login.php');
}

//CLOSE DB Connection
mysqli_close($con);

?>
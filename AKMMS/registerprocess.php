<?php
//connect to DB
include('dbconnect.php');

//retrieve data from registration form
$fname=$_POST['fname'];
$fid=$_POST['fid'];
$femail=$_POST['femail'];
$ftel=$_POST['ftel'];
$fpwd=$_POST['fpwd'];
$ftype=$_POST['ftype'];

//CRUD Operations
//CREATE-SQL Insert statement
$sql="INSERT INTO tb_employee(e_id,e_name,e_email,e_tel,e_pwd,e_role)
		VALUES('$fid','$fname','$femail','$ftel','$fpwd','$ftype')";

//EXECUTE SQL
mysqli_query($con,$sql);

//CLOSE DB Connection
mysqli_close($con);

//Redirect to next page
header('Location:login.php');

?>
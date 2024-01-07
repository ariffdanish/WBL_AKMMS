<?php
//connect to DB
include('dbconnect.php');

//retrieve data from add item form
$icode=$_POST['icode'];
$idate=$_POST['idate'];
$iname=$_POST['iname'];
$idesc=$_POST['idesc'];
$icategory=$_POST['icategory'];
$imaterial=$_POST['imaterial'];
$iquantity=$_POST['iquantity'];
$iprice=$_POST['iprice'];

//CRUD Operations
//CREATE-SQL Insert statement
$sqlp="INSERT INTO tb_item(i_Code,i_Date,i_Name,i_Desc,i_Category,i_Material,i_Quantity,i_Price)
		VALUES('$icode','$idate','$iname','$idesc','$icategory','$imaterial','$iquantity','$iprice')";

//EXECUTE SQL
mysqli_query($con, $sqlp);

//CLOSE DB Connection
mysqli_close($con);

//Redirect to next page
header('Location:browseitem.php');

?>
<?php
include ('mysession.php');
if(!session_id())
{
	session_start();
}
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
$istatus= 1 ;

//CRUD Operations
//CREATE-SQL Insert statement
$sqlp="INSERT INTO tb_item(i_Code, i_Date, i_Name, i_Desc, i_Category, i_Material, i_Quantity, i_Price, i_Status)
		VALUES('$icode','$idate','$iname','$idesc','$icategory','$imaterial','$iquantity','$iprice','$istatus')";

//EXECUTE SQL
mysqli_query($con, $sqlp);

//CLOSE DB Connection
mysqli_close($con);

// Display Result
include 'headerNav.php';

?>
<div class="container" style="margin-top: 20px; padding: 20px;">
    <table class="table">
		<h4>New item has been successfully added.</h4>
		<tr>
            <td><strong>Date Added: </strong></td>
            <td><?php echo $idate; ?></td>
        </tr>
        <tr>
            <td><strong>Code: </strong></td>
            <td><?php echo $icode; ?></td>
        </tr>
        <tr>
            <td><strong>Name: </strong></td>
            <td><?php echo $iname; ?></td>
        </tr>
        <tr>
            <td><strong>Description: </strong></td>
            <td><?php echo $idesc; ?></td>
        </tr>
        <tr>
            <td><strong>Category: </strong></td>
            <td><?php echo $icategory; ?></td>
        </tr>
        <tr>
            <td><strong>Type: </strong></td>
            <td><?php echo $imaterial; ?></td>
        </tr>
        <tr>
            <td><strong>Quantity: </strong></td>
            <td><?php echo $iquantity; ?></td>
        </tr>
        <tr>
            <td><strong>Price: </strong></td>
            <td><?php echo "RM" . number_format($iprice, 2) . " per unit"; ?></td>
        </tr>
        <tr>
            <td><strong>Status: </strong></td>
            <td><?php echo "Active"; ?></td>
        </tr>
    </table>
    <a class="btn btn-danger" href="browseitem.php">Back</a>
</div>

<?php include 'footer.php'; ?>
<?php 
  include ('mysession.php');
  if(!session_id())
  {
    session_start();
  }
  if(isset($_GET['id']))
  {
    $fcid=$_GET['id'];
  }

  include ('dbconnect.php');

$sql = "UPDATE tb_order
SET Ord_is_deleted = 1
WHERE Ord_id = '$fcid'";


$result=mysqli_query($con,$sql);
mysqli_close($con);

header('location:customerorderADV.php');
?>
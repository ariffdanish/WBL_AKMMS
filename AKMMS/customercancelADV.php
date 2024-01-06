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

$sql="DELETE FROM tb_quotation
      WHERE q_id='$fcid'";

$result=mysqli_query($con,$sql);
mysqli_close($con);

header('location:customerQuotationADV.php');
?>
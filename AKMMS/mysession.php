<?php
if(!session_id())
{
	session_start();
}
if(isset($_SESSION['e_id']) !=session_id())
{
	header('Location:index.php');
}
?>
<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}

if(isset($_GET['logout']))
{
	$uid = $_SESSION['id'];
	$qu = "delete from cart where user_ID='$uid'";
	$res=mysqli_query($con,$qu);

	if($res)
	{
		echo "Record deleted successfully";
	}
	else
		echo "Error deleting record: " . $conn->error;

	session_destroy();
	unset($_SESSION['user']);
	unset($_SESSION['id']);
	header("Location: index.php");
}
?>

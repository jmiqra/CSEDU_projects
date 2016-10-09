<?php

include_once 'dbconnect.php';
$newpass = $_POST['newpass'];
$newpass1 = $_POST['newpass1'];
$post_email = $_POST['email'];
$code = $_GET['code'];

if($newpass == $newpass1)
{
	//$enc_pass=md5($newpass);
	$sel_c1 = "update user set Password='$newpass' where e_mail='$post_email'";
	$run_c1 = mysqli_query($con, $sel_c1);

	$sel_c1 = "update user set passreset='0' where customer_email='$post_email'";
	$run_c1 = mysqli_query($con, $sel_c1);

	//mysql_query("UPDATE customers SET customer_pass='$newpass' WHERE customer_email='$post_email'");
	//mysql_query("UPDATE customers SET customer_passreset='0' WHERE customer_email='$post_email'");

	//echo "Your password has been updated.<p><a href='http://localhost/loginform.inc.php?'Click here to login<a/>";
	echo "<script>alert('Your password has been updated !')</script>";
    echo "<script>window.open('sign_up.php','_self')</script>";
}
else
{
	echo "<script>alert('Passwords must match.')</script>";
    echo "<script>window.open('forgot_pass.php?forgot_pass2&code=$code&email=$post_email','_self')</script>";
}
//echo "Passwords must match <a href='forgot_pass2.php?code=$code&email=$post_email'>Click here to enter.<a/>";



?>

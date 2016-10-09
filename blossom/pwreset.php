<?php

require 'dbconnect.php';

$newpw = $_POST['newpw'];
$newpw1 = $_POST['newpw1'];
$post_user = $_POST['user'];
$code = $_GET['code'];

if($newpw == $newpw1)
{
	//$enc_pass=md5($newpass);
	mysql_query("UPDATE UserName SET pass='$newpw' WHERE userName='$post_user'");
	mysql_query("UPDATE UserName SET passreset='0' WHERE userName='$post_user'");
	
	echo "Your password has been updated.<p><a href='http://localhost/blossom/sign_in.php?'Click here to login<a/>";
}
else
echo "Passwords must match <a href='forgotpw.php?code=$code&user=$post_user'>Click here to enter.<a/>";

?>

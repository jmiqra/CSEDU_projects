<html>

<head>
<title>Forgot Password</title>
</head>

<body style='text-align:center;
	margin-top:100px;
	font-family:Verdana, Geneva, sans-serif;
	font-size:20px;
	background: #DA81F2;'>
<?php

require 'dbconnect.php';

if($_GET['code'])
{
	$get_user = $_GET['user'];
	$get_code = $_GET['code'];
	$query = mysql_query("SELECT * FROM UserName WHERE userName = '$get_user'");

	while($row = mysql_fetch_assoc($query))
	{
		$db_code = $row['passreset']; 
		$db_user = $row['user']; 
	}
	if($get_user == $db_user && $get_code==$db_code)
	{
		echo 
		"<form action = 'pwreset.php?code=$get_code' method = 'POST'>
			<h3>Enter a new password </h3><br> <input type='pass' name = 'newpw'> <p>
			<h3>Re-enter your password</h3> <br> <input type='pass' name = 'newpw1'> <p>
			<input type='hidden' value='$db_user' name = 'user'> <p>
			<input type='submit' value='Update Password!' <p>
		</form>";
	}
}

if(!$_GET['code'])
{
	echo 
	"<form action = 'forgotpw.php' method = 'POST' style='color:#154291;'>
	<h1>Forgot Password</h1><br>
	<h2>Enter your Username</h2> 

	<input type='text' name = 'user' style='width:30%;
	height:45px;
	border:solid #e1e1e1 1px;
	border-radius:3px;
	padding-left:10px;
	font-family:Verdana, Geneva, sans-serif;
	font-size:16px;
	background:#f9f9f9;
	transition-duration:0.5s;
	box-shadow: inset 0px 0px 1px rgba(0,0,0,0.4);'> 
	<p>

	<h2>Enter your email </h2> 

	<input type='text' name = 'email' style='width:30%;
	height:45px;
	border:solid #e1e1e1 1px;
	border-radius:3px;
	padding-left:10px;
	font-family:Verdana, Geneva, sans-serif;
	font-size:16px;
	background:#f9f9f9;
	transition-duration:0.5s;
	box-shadow: inset 0px 0px 1px rgba(0,0,0,0.4);'> 
	<p>
	
	<input type='submit' value='Submit' name = 'submit' style='width:30%;
	height:45px;
	border:0px;
	background:rgba(12,45,78,11);
	background:-moz-linear-gradient(top, #595959 , #515151);
	border-radius:3px;
	box-shadow: 1px 1px 1px rgba(1,0,0,0.2);
	color:#f9f9f9;
	font-family:Verdana, Geneva, sans-serif;
	font-size:18px;
	font-weight:bolder;
	text-transform:uppercase;'> <p>

	</form>";

	if(isset($_POST['submit']))
	{
		$user = $_POST['user'];
		$email = $_POST['email'];

		$query = mysql_query("SELECT * FROM UserName WHERE userName = '$user'");
		$numrow = mysql_num_rows($query);

		if($numrow!=0)
		{
			while($row = mysql_fetch_assoc($query))
			{
				$db_email = $row['email']; 
			}
			if($email = $db_email)
			{
				$code = rand(1000,10000);
				$to=$db_email;
		                $subject='Password Recovery';
				$headers='From: Demouser PC <blah@example.com>';
		                $body=" 
					Click the link below.
					<br>
					http://localhost/Iqra/pwreset.php?code=$code&user=$user";

				mysql_query("UPDATE UserName SET passreset='$code' WHERE userName='$user'");
			
				mail($to, $subject, $body, $headers);

				echo "Check Your Email";	             
			}
			else
			{
				echo "Email is incorrect";
			}
	}
		else
		{
			echo "That username doesn't exist";
		}
	}
}
?>
</body>
</html>


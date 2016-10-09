
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> Log-IN </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/navigation.css">
  <style type="text/css">
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/st1.css">
    <link rel="stylesheet" href="css/brown.css">
  <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/bgreen.css">
  <link rel="stylesheet" href="image/logo1.css" type="text/css">
   <script src="js/jquery-1.11.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</head>
</head>
<body background="image/acc.jpg">

	<div class="container">
	<div class = "row" >
    <div class = "col-md-6">
      <img src="image/nn.png" alt="flower">
    </div>
      
    <div class = "col-md-6">
       <div id='green'>
    <ul>
   <li class='active'><a href="home.php"><span><img src="image/h.jpg" alt="Home">
    <a href=></a></span></a></li>
   <li><a href='useacc.php'><span><img src="image/u.png" alt="User Account"</span></a></li>
   <li><a href='cart.php'><span><img src="image/c.jpeg" alt="View Cart"</span></a></li>
   <li><a href="Contact.php"><span><img src="image/c.png" alt="Contact Us"</span></a></li>
   <li><a href="custom.php"><span>Custom</span></a></li>
   <li>
   <?php

    //session_start();
    include_once 'dbconnect.php';

    if(isset($_SESSION['user']))
    {
    echo"<a href='logout.php?logout'><span>Log-out</span></a>";
    }
    ?>
  </li>
    </ul>
       </div>
    </div>
 
</div>

<div clas="row">
	<div class="col-md-12">
<center>
<div id="login-form">
<h1>Forgot your password?</h1>
<form method="post">
<table align="center" width=700 border="0">
	
<?php

	
	include_once 'dbconnect.php';

	

	echo
	"<form action = 'forgot_pass.php' method = 'POST'>

	Enter your email <br> <input type='text' name = 'email'> <p>
	<input type='submit' value='Submit' name = 'submit'> <p>

	</form>";

	if(isset($_POST['submit']))
	{
		//$username = $_POST['username'];
		$email = $_POST['email'];

		//$query = mysqli_query("SELECT * FROM customers WHERE customer_email = '$email'");
		//$numrow = mysql_num_rows($query);

		$sel_c = "select * from user where e_mail = '$email'";

		$run_c = mysqli_query($con, $sel_c);

		$check_c = mysqli_num_rows($run_c);

		if($check_c!=0)
		{
			while($row_c = mysqli_fetch_array($run_c))
			{
				$db_email = $row_c['e_mail'];
			}
			if($email = $db_email)
			{
				$code = rand(10000,1000000);
				$to=$db_email;
		        $subject='Password Recovery';
				$headers='From: Web Engineering Lab <something.@whatever.org>';
		                $body="
					This is an automated mail. Please do not reply to this.

					Click the link below or paste it into your browser.

					http://localhost/blossom/pass_reset_complete.php?forgot_pass2&code=$code&email=$email";

				//mysql_query("UPDATE customers SET customer_passreset='$code' WHERE customer_email='$email'");
				$sel_c1 = "update user set passreset='$code' where e_mail='$email'";

				$run_c1 = mysqli_query($con, $sel_c1);

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
			echo "That Customer doesn't exist";
		}

	}



?>
</div>
</div>

</table>
</form>
</div>
</center>
</body>
</html>






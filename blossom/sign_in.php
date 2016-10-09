<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['btn-login']))
{
	$user = mysqli_real_escape_string($con,$_POST['user']);
	$pass = mysqli_real_escape_string($con,$_POST['pass']);
  //echo $user;
	
	$user = trim($user);
	$pass = trim($pass);
  $op = array('cost' => 12);

	 $res = "select *  FROM user where User_name='$user'";
     $result = mysqli_query($con, $res);
   if($result) 
   {
  	$row=mysqli_fetch_array($result);
  	
  	$count = $result->num_rows; // if uname/pass correct it returns must be 1 row
    //$suppw = $pass;
    $stopw = $row['Password'];


  	
  	if($count == 1 && password_verify($pass,$stopw))
    {
  		  $_SESSION['user'] = $row['User_name'];
  		  $_SESSION['id']=$row['User_ID'];
        $_SESSION['image']=$row['user_image'];
  		  header("Location: home.php");
    }
  	else
  	{
  		?>
          <script>alert('Password Seems Wrong !');</script>
          <?php
  	}
	}
  else
  {
    ?>
        <script>alert('Username Seems Wrong !');</script>
        <?php
  }
}
?>
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
  
   <li><a href='cart.php'><span><img src="image/c.jpeg" alt="View Cart"</span></a></li>
   <li><a href="contact.php"><span><img src="image/c.png" alt="Contact Us"</span></a></li>
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


<center>
<div id="login-form">
<h1>Welcome! Log In Here</h1>
<form method="post">
<table align="center" width=700 border="0">
	<tr>
<td height="20"><h3>Not have an account ?</h3><b> <a href="sign_up.php">Sign Up Here</a></b></td>
</tr>
<tr>
<td height="50"><input type="text" name="user" placeholder="Your Name" required size="40"/></td>
</tr>
<tr>
<td height="50"><input type="password" name="pass" placeholder="Your Password" required size="40"/></td>
</tr>


<tr>
<td height="30"><a href="forgot_pass.php">Forgot Password ? Click here</a></td>
</tr>
<tr>
<td height="70"><button type="submit" name="btn-login">Sign In</button></td>
</tr>

</table>
</form>
</div>
</center>
</body>
</html>

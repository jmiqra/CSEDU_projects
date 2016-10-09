<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['id']))
{
  header("Location: index.php");
}
function pay()
{

if(isset($_POST['submit']))
{
   $con = new mysqli("localhost","root","jmi1944","blossom");

     if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
         }
	$uid = $_SESSION['id'];
	$address = $_POST['address'];
	
	$uid = trim($uid);
	$address = trim($address);
	
    $sql = "select * from cart where user_ID='$uid'";
         $result = mysqli_query($con, $sql);
     
      //if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {

       //$uID = $row['pro_id'];
       $cartid = $row['cart_ID'];
       }
       $order = "select * from ordertable where cart_id='$cartid'";

        $insert_order = "insert into ordertable (location) 
        values ('$address') where cart_id='$cartid'";
        
        
        $insert_pro = mysqli_query($con,$insert_order);

        if($insert_pro)
        {
            echo "<h2>Your Address '$address' received successfully. You will get your order in 3 days.</h2>";
            echo "<script>window.open('pay.php','_self')</script>";
        }
        echo "not inserted";

	//if($res)
	//{
		
	//}
	//else
		//echo "Error receiving address: " . $conn->error;	
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> Payment </title>
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
<body background = "image/bg.jpg">
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
   <li><a href='useracc.php'><span><img src="image/u.png" alt="User Account"</span></a></li>
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


<div class="row">
	<div class="col-md-6">

<h1>Welcome!


</h1>
<form method="post">
<table align="right" width="50">
	
<tr>
<h3>Enter your full Address here - </h3>
<td height="60"><input type="text" name="address" placeholder="Your Address" size="60"/></td>
</tr>
<tr>
<td align="right" height="60"><button type="submit" name="submit">Submit</button></td>
</tr>

</table>
</form>

</div>
</div>

<?php
pay();
?>


</div>
</body>
</html>


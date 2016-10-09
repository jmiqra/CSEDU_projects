<?php
session_start();
include_once 'dbconnect.php';

$user =$_SESSION['user'];
if(isset($_POST['submit']))
{
	$uid = $_SESSION['id'];
  
	$pass = $_POST['pass'];
	$nwpw = $_POST['newpass'];

	
	$uid = trim($uid);
	$pass = trim($pass);
	$nwpw = trim($nwpw);
	
	$qu="select * from user where User_ID='$uid' and Password='$pass'";

	$res = mysqli_query($con,$qu);


	$up="update user set Password='$nwpw' where Password='$pass' and User_ID='$uid'";
	$res_up=mysqli_query($con,$up);

	if($res_up)
	{
		echo "Record updated successfully";
	}
	else
		echo "Error updating record: " . $conn->error;
	
	
}

if(!isset($_SESSION['id']))
{
	header("Location: index.php");
}
     $uid = $_SESSION['id'];



if(isset($_POST['deactive']))
{
	$dl="delete from user where User_ID='$uid'";
	$res_dl=mysqli_query($con,$dl);
	if($res_dl)
	{
		echo "Record deleted successfully";
  session_destroy();
  unset($_SESSION['user']);
  unset($_SESSION['id']);
  header("Location: index.php");

	}
	else
		echo "Error deleting record: " . $con->error;
}

if(isset($_POST['submit1']))
{
  //$dl="delete from user where User_ID='$uid'";

  $user_image = $_FILES['user_image']['name'];
  $product_image_tmp = $_FILES['user_image']['tmp_name'];

  move_uploaded_file($product_image_tmp,"prod_image/$user_image");

   $up="update user set user_image='$user_image' where User_ID='$uid'";

  $res_im=mysqli_query($con,$up);


 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> User account </title>
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
<body background = "image/accq.jpg">
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
  
    <li><a href="logout.php?logout"><span>Log-out</span></a></li>
    <li><span>HI <?php
    echo $user;
    echo " ";
    $sql= "select * from user where user_ID= '$uid'";
     $result = mysqli_query($con, $sql);
     //echo $search;
    
    $row = $result->fetch_assoc();
    $pro_image = $row['user_image'];
      if($pro_image){

    echo "<img src = 'prod_image/$pro_image' class='img-circle' width=60 height =60>";
        }
   

    ?> !!!</span></li></br>
  
    </ul>
       </div>
    </div>
 
</div>


<div class="row">
	<div class="col-md-6">

<h1>Welcome!
<?php
echo $_SESSION['user'];
?>


</h1>
<form action ="useracc.php" method="post" enctype="multipart/form-data">
<table align="center" width="100">

   <tr align = "right">

     <td height="40"><b>your profile picture</b></td>
     <td height="40"><input type="file" name="user_image" /></td>
<td  height="60"><button class="but3" type="submit" name="submit1" size="30">Update you profile picture</button></td>


</tr>
	
<tr>
	<td>Do you want to change your password?<td></tr>
<td height="60"><input type="text" name="pass" placeholder="Your Password" /></td>
<tr>
</tr>

<tr>
<td height="60"><input type="text" name="newpass" placeholder="Your New Password" /></td>

</tr>

<tr>
<td align="right" height="60"><button type="submit" name="submit">Submit</button></td>
</tr>

<tr>
 <td align="right" height="150"><button class="but" type="checkbox" name="deactive">Deactivate Account</button></td>
<td align="right"><h4>(all your information will be deleted)</h4></td><br>

</tr>

</table>
</form>

</div>
</div>

</div>
</body>
</html>




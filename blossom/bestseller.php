
<!DOCTYPE html>

<?php
include("db/insert_cart.php");
include_once 'dbconnect.php';
if(isset($_SESSION['user']))
{
  $res = "select * from user where User_name=.$_SESSION[user] ";
$qu=mysqli_query($con,$res);

//$username= $qu['User_name'];
//$row = $qu->fetch_assoc());

$user = $_SESSION['user'];
$uid= $_SESSION['id'];
}

?>

<head>
  <title> Birthday </title>
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

<body background = "image/back1.jpg">
<div class = "container">
  
  
  <div class = "row" >
    <div class = "col-md-6">
      <img src="image/nn.png" alt="flower">
    </div>
      
    <div class = "col-md-6">
       <div id='green'>
    <ul>
   <li class='active'><a href="home.php"><span><img src="image/h.jpg" alt="Home">
    
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
  <li><span>HI <?php
     if(isset($_SESSION['user'])){
    echo $user;
    echo " ";
    $sql= "select * from user where user_ID= '$uid'";
     $result = mysqli_query($con, $sql);
     //echo $search;
    
    $row = $result->fetch_assoc();
    $pro_image = $row['user_image'];
      if($pro_image){

    echo "<img src = 'prod_image/$pro_image'  class='img-circle' width=60 height =60>";
        }
      }
   

    ?> !!!</span></li>
    </ul>
       </div>
    </div>
 
</div>


<p class="it">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav">
    <li><a href="bestseller.php">Best Sellers</a></li>
    <li>
      <a href="#">Special Days</a>
      <ul>
       
        <li><a href="birthday.php">Birthday</a></li>
        <li><a href="love.php">Anniversary</a></li>
        <li><a href="love.php">Valentines Day</a></li>
        <li><a href="parents.php">Mothers Day</a></li>
        <li><a href="wedding.php">Wedding Day</a></li>
      </ul>
    </li>
    <li>
      <a href="#">Special Purpose</a>
      <ul>
       
        <li><a href="thank.php">Congratulations</a></li>
        <li><a href="thank.php">Thank you</a></li>
        <li><a href="sympathy.php">Sorry</a></li>
        <li><a href="love.php">Love</a></li>
        <li><a href="sympathy.php">Get well soon</a></li>
      </ul>
    </li>
     <li>
      <a href="#">Special Persons</a>
      <ul>
        
        <li><a href="parents.php">Parents</a></li>
        <li><a href="sibling.php">Siblings</a></li>
        <li><a href="love.php">Wife-Husband</a></li>
        <li><a href="friends.php">Friends</a></li>
      </ul>
    </li>
    <li><a href="flowers.php">Flowers</a></li>
    <li>
      <a href="#">Decoration</a>
      <ul>
        <li><a href="wrapping.php">Wrapping Paper</a></li>
        <li><a href="ribbon.php">Ribbon</a></li>
        <li><a href="vase.php">Vase</a></li>
        <li><a href="card.php">Cards</a></li>
      </ul>
    </li>
  </ul>
</div>
</div>

</p>

<?php
cart();
?>

<div class="row" align="right">

    <form method = "POST" action="search.php" enctype="multipart/form-data">

<input type="text" name="query" placeholder="Search a product"/>
<input type = "submit" name="submit">
<?php
  //echo $search;
  $con = new mysqli('localhost','root','jmi1944','blossom');

if ($con->connect_error) 
  {
    die("Connection failed: " . $con->connect_error);
  } 
    
   
     $sql = "select * from products order by pro_sold desc";
     $result = mysqli_query($con, $sql);
     //echo $search;
    
  if ($result->num_rows > 0) 
  {
   $count=6;
    while($count>0) 
    {
      $row = $result->fetch_assoc();
      $pro_ID = $row['product_ID'];
      $pro_name = $row['name'];
      $pro_image = $row['image'];
      $pro_price = $row['price'];
      echo"
        <div class='col-md-4'>
          <div class='itm'>
          
          <h3>$pro_name</h3>
          
          <img src = 'prod_image/$pro_image' class='img-thumbnail' size='60'>
          <p><b>BDT $pro_price</b></p>
           <a href='search.php?add_cart=$row[product_ID]'><img src='image/add.png' alt='add to cart''></a>
         </div>
        </div>";
        $count--;
   }
 }
         
else 
  {
    echo "0 results";
  }
?>

</form>

  </div>
</div>   
</div>
</body>





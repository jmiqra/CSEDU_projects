<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
  header("Location: home.php");
}


?>
<!DOCTYPE html>
<head>
  <title> Contact </title>
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
    <link rel="stylesheet" href="css/ind.css">
  <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  
  <link rel="stylesheet" href="image/logo1.css" type="text/css">
   <script src="js/jquery-1.11.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</head>

<body background = "image/cn.jpg">
<div class = "container">

  <div class = "row" >
    <div class = "col-md-6">
       
      <img src="image/nn.png" alt="flower">
    

</div>
</div>

  <div class="row">
    <div class = "col-md-6">
       <div id='green'>
    <ul>
   <li class='active'><a href="index.php"><span>Home</span></a></li>
   <li><a href="sign_up.php"><span>Sign-Up</span></a></li>
   <li><a href="sign_in.php"><span>Log-in</span></a></li>
   <li><a href='contact.php'><span>Contact Us</span></a></li>
    </ul>
       </div>
    </div>
  </div><br>

  <div class="row">
    <div class="col-md-6">
      <h4>
        Blossom-Online floral shop.Unlike any other online floral shop, we are here to serve our 
customers, whether it be in a time of sadness such as a loved one
passing or a joyous time such as a new addition to your family with 
a child being born or your dream wedding.We try to deliver our flowers within 1 day (maximum 3 days) depending on the distance of the location.
      </h4>
    </div>
  </div><br>

  <div class="row">
    <div class="col-md-12">
    <h2>Contact us: </h2>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
    <h3>e-mail : amifaraj@gmail.com </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
    <h3>e-mail: jurdana.masuma@gmail.com </h3>
    </div>
  </div>


<p class="q">
  <div class="row">
    <div class="col-md-8">
      <img src="image/bk.png" alt="flower" >
    </div>
  </div>
</p>
</div>
</body>

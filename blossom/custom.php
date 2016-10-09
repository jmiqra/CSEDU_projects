
<!DOCTYPE html>

<?php

session_start();
include_once 'dbconnect.php';
include("db/dbhelper.php");

if(!isset($_SESSION['user']))
{
  header("Location: sign_in.php");
}
$res = "select * from user where User_name=.$_SESSION[user] ";
$qu=mysqli_query($con,$res);

$user = $_SESSION['user'];
$id= $_SESSION['id'];
$image = $_SESSION['image'];

?>

<head>
  <title> Custom </title>
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

  <style> 
.textbox { 
    -moz-border-radius-topright: 30px;
    -webkit-border-top-right-radius: 30px;
    border-top-right-radius: 30px;
    -moz-border-radius-bottomleft: 30px;
    -webkit-border-bottom-left-radius: 30px;
    border-bottom-left-radius: 30px;
    border: 1px solid #848484;
    outline:0; 
    height:25px; 
    width: 275px; 
    padding-right:15px; 
    padding-left:15px; 
  } 
</style>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>

  <link rel="stylesheet" href="css/ver.css">
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
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
    
</head>

<body background="image/accq.jpg">
<div class = "container">

  <div class = "row" >
    <div class = "col-md-6">
      <img src="image/nn.png" alt="nutella">
    </div>
      
    <div class = "col-md-6">
       <div id='green'>
    <ul>
   <li class='active'><a href="home.php"><span><img src="image/h.jpg" alt="Home">
    <a href=></a></span></a></li>
   <li><a href='useracc.php'><span><img src="image/u.png" alt="User Account"</span></a></li>
   <li><a href='cart.php'><span><img src="image/c.jpeg" alt="View Cart"</span></a></li>
   <li><a href='#'><span><img src="image/c.png" alt="Contact Us"</span></a></li>
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

    echo $user;
    echo " ";
    $sql= "select * from user where user_ID= '$id'";
     $result = mysqli_query($con, $sql);
     //echo $search;
    
    $row = $result->fetch_assoc();
    $pro_image = $row['user_image'];
    if($pro_image){
    echo "<img src = 'prod_image/$pro_image' class='img-thumbnail' width=60 height =60>";
      }  
   

    ?> !!!</span></li></br>
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

<div class="row">
    <div class="col-md-3">
      <div id="cssmenu">
        <ul>
          <li class='active'><a href='#'><span>Categories</span></a></li>
         <?php
            $db->get_cat();
            ?>

        <ul>
</div>
</div>

<form action="custom.php" method="post" enctype="multipart/form-data">

             <table align="center" width="700" bgcolor="AliceBlue">
            
                   <tr>
                
                <td><button class="button button2"><input type ="submit" name="Regular" value="Regular"/></button></td>
                <td><button class="button button2"><input type ="submit" name="Special" value="SPECIAL"/></button></td>
                 <td><button class="button button2"><input type ="submit" name="Premium" value="Premium"/></td></button></tr>

                
            <tr height="60"><br>
            <?php 

            if(isset($_POST['Regular'])):
             
            ?>

              
              <td>
              <select name="flower1">
           <option>Select Flower</option>
           <?php $db->get_flower(); 
                 
           ?>
    </select>
        </td>
        
         <td >
           <select name ="flower2">
            <option>Select flower</option>
           <?php $db->get_flower(); 
          
           ?>
    </select>
        </td>
        <tr>
         <td>
          <select name="Ribbon">
  <option>Select Ribbon color</option>
  <option value="RED">Red</option>
  <option value="BLUE">Blue</option>
  <option value="GREEN">Green</option>
  <option value="YELLOW">Yellow</option>
</select>
</td></tr><br>
       
       <tr>
            <td height="40"><b>Product Description</b></td><br>
            <td height="40"><b>(within 50 words)</td><br>
            <td height="40"><textarea name="product_desc" cols="20" rows="10" ></textarea></td>
        </tr><br>

                <tr>
         <td height="50"><b>Price : 1400 BDT</b></td>
       </tr>

                  <tr>
         <td height="50"><input type ="submit" name="Order" value="Order"/></td>
       </tr>

      
    
           
<?php else: ?>

   

    <?php 
              if(isset($_POST['Order']))
    {
       
         $con = new mysqli("localhost","root","jmi1944","blossom");

     if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
         }
       
        $product1= $_POST['flower1'];
        $product2= $_POST['flower2'];
        $ribbon = $_POST['Ribbon'];
        //$de
        //$type =  $_POST['Regular'];
      
        $desc = $_POST['product_desc'];
         $userid=$_SESSION['id'] ;
        
        //echo "$product1";
        //echo "$product2";
         //echo "$ribbon";
         //echo "$userid";
         //echo "$desc";

       
         $insert_product = "insert into custom (user_ID,product1,product2,rib1,description) 
        values ('$userid','$product1','$product2','$ribbon','$desc')";
        
        
        $insert_pro = mysqli_query($con,$insert_product);

         if($insert_pro)
        {
            echo "<script>alert('Order has been taken!')</script>";
            echo "<script>window.open('custom.php','_self')</script>";
        }
        echo "not inserted";

    }
   ?>
<?php endif; ?>


       <?php 

            if(isset($_POST['Special'])): ?>
             <tr height ="20">
              <td height="40">
              <select name="flower1">
           <option>Select Flower</option>
           <?php $db->get_flower(); ?>
    </select>
        </td>
         <td height="40">
           <select name="flower2"><option>Select flower</option>
           <?php $db->get_flower(); ?>
    </select>
        </td>

        <td height="40">
              <select name="flower3">
           <option size="50">Select Flower</option>
           <?php $db->get_flower(); ?>
    </select>
        </td>
      </tr><br>
        
        <tr height ="20">

        <td height="40">
          <select name="Ribbon1">
  <option>Select Ribbon color</option>
  <option value="RED">Red</option>
  <option value="BLUE">Blue</option>
  <option value="GREEN">Green</option>
  <option value="YELLOW">Yellow</option>
</select>
</td>

 <td height="40">
          <select name="Ribbon2">
  <option>Select Ribbon color</option>
  <option value="RED">Red</option>
  <option value="BLUE">Blue</option>
  <option value="GREEN">Green</option>
  <option value="YELLOW">Yellow</option>
</select>
</td></tr><br>

<tr height ="20">
<td>
              <select name="vase">
           <option>Select Vase</option>
           <?php $db->get_vase(); ?>
    </select>
        </td>
</tr><br>
     
       <tr height ="20">
                    <td height="40"><b>Product Description</b></td><br>
                    <td height="40"><textarea name="product_desc" cols="20" rows="10" size="50"></textarea></td>
       </tr>

                 <tr>
         <td height="50"><b>Price : 2500 BDT</b></td>
       </tr>


                  <tr>
         <td height="50"><input type ="submit" name="Order1" value="Order"/></td>
       </tr>
        
            <?php else: ?>

             <?php 
              if(isset($_POST['Order1']))
    {
       
         $con = new mysqli("localhost","root","jmi1944","blossom");

     if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
         }
       
        $product1= $_POST['flower1'];
        $product2= $_POST['flower2'];
         $product3= $_POST['flower3'];
          //$product2= $_POST['flower2'];
        $ribbon1 = $_POST['Ribbon1'];
        $ribbon2 = $_POST['Ribbon2'];
        $vase = $_POST['vase'];
        //$de
        //$type =  $_POST['Regular'];
      
        $desc = $_POST['product_desc'];
         $userid=$_SESSION['id'] ;

       
         $insert_product = "insert into custom (user_ID,product1,product2,product3,rib1,rib2,vase,description) 
        values ('$userid','$product1','$product2','$product3','$ribbon1','$ribbon2','$vase','$desc')";
        
        
        $insert_pro = mysqli_query($con,$insert_product);

         if($insert_pro)
        {
            echo "<script>alert('Order has been taken !')</script>";
            echo "<script>window.open('custom.php','_self')</script>";
        }
        echo "not inserted";

    }
   ?>
    
<?php endif; ?>


       </tr>  



        <?php 

            if(isset($_POST['Premium'])): ?>
             <tr>
              <td height="40">
              <select name="flower1">
           <option>Select Flower</option>
           <?php $db->get_flower(); ?>
    </select>
        </td>
         <td height="40">
           <select name="flower2"><option>Select flower</option>
           <?php $db->get_flower(); ?>
    </select>
        </td>

        <td height="40">
              <select name="flower3">
           <option>Select Flower</option>
           <?php $db->get_flower(); ?>
    </select>
        </td></tr>
        

        <td height="40">
          <select name="Ribbon1">
  <option>Select Ribbon color</option>
  <option value="RED">Red</option>
  <option value="BLUE">Blue</option>
  <option value="GREEN">Green</option>
  <option value="YELLOW">Yellow</option>
</select>
</td>

 <td height="40">
          <select name="Ribbon2">
  <option>Select Ribbon color</option>
  <option value="RED">Red</option>
  <option value="BLUE">Blue</option>
  <option value="GREEN">Green</option>
  <option value="YELLOW">Yellow</option>
</select>
</td> </tr>
  
  <tr>
       <td height="40">
              <select name="vase">
           <option>Select Vase</option>
           <?php $db->get_vase(); ?>
    </select>
        </td>

        <td height="40">
          <select name="deco">
  <option>Make it special</option>
  <option value="Mylar Balloon">Mylar Balloon</option>
  <option value="Latex Balloon">Latex Balloon</option>
  <option value="Card">Card</option>

</select>
</td>
</tr>
       <tr>
                    <td height="40"><b>Product Description</b></td><br>
                    <td height="40"><textarea name="product_desc" cols="20" rows="10" size="50"></textarea></td>
       </tr>

                 <tr>
         <td height="50"><b>Price : 3500 BDT</b></td>
       </tr>
                  <tr>
         <td height="50"><input type ="submit" name="Order2" value="Order"/></td>
       </tr>
        
            <?php else: ?>

             <?php 
              if(isset($_POST['Order2']))
    {
       
         $con = new mysqli("localhost","root","jmi1944","blossom");

     if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
         }
        $product1= $_POST['flower1'];
        $product2= $_POST['flower2'];
        $product3= $_POST['flower3'];
        $ribbon1 = $_POST['Ribbon1'];
        $ribbon2 = $_POST['Ribbon2'];
        $vase = $_POST['vase'];
        $dec = $_POST['deco'];
        $desc = $_POST['product_desc'];
         $userid=$_SESSION['id'] ;
         $insert_product = "insert into custom (user_ID,product1,product2,product3,rib1,rib2,vase,extra,description) 
        values ('$userid','$product1','$product2','$product3','$ribbon1','$ribbon2','$vase','$dec','$desc')";
  
        $insert_pro = mysqli_query($con,$insert_product);

         if($insert_pro)
        {
            echo "<script>alert('Order has been taken !')</script>";
            echo "<script>window.open('custom.php','_self')</script>";
        }
        echo "not inserted";
    }
   ?>
    
<?php endif; ?>

       </tr>  
     </table>
        </form>
</div>
</body>
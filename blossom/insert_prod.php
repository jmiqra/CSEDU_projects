<!DOCTYPE html>

<?php

session_start();
include("db/select_cat.php");
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
  header("Location: index.php");
}

$res = "select * from user where User_name=.$_SESSION[user] ";
$qu=mysqli_query($con,$res);

$user = $_SESSION['user'];
$id= $_SESSION['id'];
$image = $_SESSION['image'];


?>

    <head>

        <title> Inserting Product </title>

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
    <link rel="stylesheet" href="css/ver.css">
  <link rel="stylesheet" href="css/st1.css">
 
  <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/green.css">
   <link rel="stylesheet" href="css/new.css">

  <link rel="stylesheet" href="image/logo1.css" type="text/css">
   <script src="js/jquery-1.11.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>

    </head>

    <body background="image/acc.jpg">

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

  <div class="row">
    <div class="col-mod-6">


         <?php

    //session_start();

    include_once 'dbconnect.php';
      $totalorder;
      $user = $_SESSION['user'];


                  //local var
                  //$pro_ID;
     $sql = "select * from ordererd";
     $result = mysqli_query($con, $sql);
     
      $totalorder= $result->num_rows;

      $sql1 = "select * from custom";
     $result = mysqli_query($con, $sql1);
     
      $totalorder1= $result->num_rows;
     
      $re=strcmp($user,"Bazingaaa");
      //echo "$re";
      if($re==0)
    {
       echo"
       
      <div id='brown'> 
   
       <ul>
       <li>
       <a href='ordermanage.php'><span>Order</span></a></li>
       <li>( $totalorder )</li>

        

       <li><a href='Custommanage.php'><span>Customed Order</span></a></li>
       <li>( $totalorder1 ) </li>

       <li><a href='usermanage.php'><span>Manage User</span></a>
        <li><a href='insert_prod.php'><span>Insert Product</span></a>

        </li>
        </ul>
         </div> 
        ";
   
    }
    
?>
    </div>
</div></br>

<div class="row">
    <div class="col-md-12">

        <form action="insert_prod.php" method="post" enctype="multipart/form-data">

            <table align="center" width="700" border="2" bgcolor="AliceBlue">

                <tr align="center">
                    <td td colspan="5"><h2>Insert product here</h2></td>
                </tr>

                 <tr>
                    <td height="40"><b>Product Title</b></td>
                    <td height="40"><input type="text" name="product_title" size="40"/></td>
                </tr>
                

                <tr>
				<td height="50" align ="center"><b>Product_cat</b></td>
				<td height="50">
					<select name="prod_cat">

						<option>Select a category</option>
						<?php
						get_cat();
						?>
				</td>
			</tr>

			<tr>
                    <td height="40"><b>Product Price</b></td>
                    <td height="40"><input type="text" name="product_price"/></td>
                </tr>

			<tr>
                    <td height="40"><b>Product Description</b></td>
                    <td height="40"><textarea name="product_desc" cols="20" rows="10" ></textarea></td>
                </tr>

               

			<tr>
                    <td height="40"><b>Product Image</b></td>
                    <td height="40"><input type="file" name="product_image" /></td>
                </tr>

			<tr>
                    <td height="40"><b>Product Keywords</b></td>
                    <td height="40"><input type="text" name="product_keyword" size="50" required/></td>
                </tr>
			
			<tr align="center">
                    <td colspan="5"><input type="submit" name="insert_post" value="Insert Now"/></td>
                </tr>
            </table>

        </form>
</div>
</div>

     </div>
    </body>


<?php
    if(isset($_POST['insert_post']))
    {
        //Getting the text data from text fields
       
         $con = new mysqli("localhost","root","jmi1944","blossom");

     if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
         }
       
        $product_title = $_POST['product_title'];
        $product_cat = $_POST['prod_cat'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keyword = $_POST['product_keyword'];
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];

        move_uploaded_file($product_image_tmp,"prod_image/$product_image");

        $insert_product = "insert into products (name,category,image,price,description,keyword) 
        values ('$product_title','$product_cat','$product_image','$product_price','$product_desc','$product_keyword')";
        
        
        $insert_pro = mysqli_query($con,$insert_product);

        if($insert_pro)
        {
            echo "<script>alert('Product has been inserted !')</script>";
            echo "<script>window.open('insert_prod.php','_self')</script>";
        }
        echo "not inserted";

    }
   

?>



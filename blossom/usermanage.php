<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
  header("Location: index.php");
}

$res = "select * from user where User_name=.$_SESSION[user] ";
$qu=mysqli_query($con,$res);

//$username= $qu['User_name'];
//$row = $qu->fetch_assoc());

$user = $_SESSION['user'];
$id= $_SESSION['id'];


?>

<!DOCTYPE html>
<head>
  <title> Blossom </title>
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
    <link rel="stylesheet" href="css/new.css">
  <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/green.css">
  <link rel="stylesheet" href="image/logo1.css" type="text/css">
   <script src="js/jquery-1.11.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</head>

<body background = "image/cute.jpg">
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

    <form method = "POST" action="usermanage.php" enctype="multipart/form-data">

<input type="text" name="query" placeholder="Search a product"/>
<input type = "submit" name="submit">
    <?php

if(isset($_POST['submit']))
{
   

         
        $search = $_POST['query'];
        //echo $search;
        $con = new mysqli('localhost','root','jmi1944','blossom');


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
    
   
     $sql= "select * from products where keyword like '%$search%'";
     $result = mysqli_query($con, $sql);
     //echo $search;
    
      if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
      
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
             

               <a href='home.php?add_cart=$row[product_ID]'><img src='image/add.png' alt='add to cart''></a>

             </div>
          </div>";
          
   }
 }
         
else {
    echo "0 results";
}
}
?>

</form>

  </div>

<div classs="row">
  <div class="col-md-12">
   <form action="" method="post" enctype="multipart/form-data">

            <table align="center" width="1000" bgcolor="AliceBlue">

                <tr align="center">
                    <td td colspan="4"><h2>Here's your cart</h2></td>
                </tr>


                <tr align=" center">
                  <th height="20">Remove</th>
                  <th>User ID</th>
                  <th>User Name</th>
                  <th>User Image</th>
                </tr>

                <?php
      

                $con = new mysqli("localhost","root","jmi1944","blossom");

                if ($con->connect_error) {
               die("Connection failed: " . $con->connect_error);
                  }

                  //local var
                   //$userid=$_SESSION['id'] ;
                  //$pro_ID;
     $sql = "select * from user";
     $result = mysqli_query($con, $sql);
     
      //if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

       $user_ID = $row['User_ID'];
       $name = $row['User_name'];
       $image = $row['user_image'];

    ?>


    <tr align="left">
      <td><input type ="checkbox" name="remove[]" value=<?php echo $user_ID;?>/></td>
       <td><?php echo $user_ID;?><br></td>
      <td><?php echo $name;?><br></td>
      <td>
      <img src="prod_image/<?php echo $image;?>"width="60" height ="60"/>
      </td>
    
              </div>
            </div>
<?php } ?>

 <tr>
         <td height="50"><input type ="submit" name="Update" value="Update"/></td>
       </tr>

       </table>
        </form>

         <?php

function update()
{
    echo "<script><window.open('usermanage.php','_self)</script>";  
     $con = new mysqli("localhost","root","jmi1944","blossom");

                if ($con->connect_error) {
               die("Connection failed: " . $con->connect_error);
                  }
   

  if(isset($_POST['update']))
  {
         
        
    foreach($_POST['remove'] as $remove_id)
    {

      $delete = "delete from cart where User_Id='$remove_id'";

      $row = mysqli_query($con,$delete);

      if($row)
      {
        //echo "removed";
       
        echo "<script><window.open('usermanage.php')</script>";

      }
    }
  }
   
}

  echo @$update_cart = update();

//update();
?>   


</div>
</body>

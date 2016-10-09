
<!DOCTYPE html>
<?php
include("db/tot_price.php");
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
  header("Location: sign_in.php");
}
$res = "select * from user where User_name=.$_SESSION[user] ";
$qu=mysqli_query($con,$res);

$user = $_SESSION['user'];
$id= $_SESSION['id'];

?>

<head>
  <title> Order List </title>
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

  <link rel="stylesheet" href="css/ver.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/st1.css">
    <link rel="stylesheet" href="css/new.css">
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

<body background="image/pec.jpg">
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
    <div class="col-md-12">

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

  <form action="" method="post" enctype="multipart/form-data">

            <table align="center" width="1050" bgcolor="AliceBlue">

                <tr align="center">
                    <td height="50" colspan="4"><h2>Order List</h2></td>
                </tr>


                <tr align=" center">
                  <th height="50">Served</th>
                   <th height="50">Order_ID</th>
                  <th height="50">User_ID</th>
                  <th height="50">Flower_1</th>
                  <th height="50">Flower_2</th>
                  <th height="50">Flower_3</th>

                  <th height="50">Ribbon_1</th>
                  <th height="50">Ribbon_2</th>
                 
                  <th height="50">Vase</th>
                  <th height="50">Extra</th>
                  <th height="50">Description</th>
                  <th height="50">Location</th>
                </tr>
           
       
        <?php
        $total=0;

                $con = new mysqli("localhost","root","jmi1944","blossom");

                if ($con->connect_error) {
               die("Connection failed: " . $con->connect_error);
                  }

                 
     $sql = "select * from custom";
     $result = mysqli_query($con, $sql);


     
    while($row = $result->fetch_assoc()) {

       $userid = $row['user_ID'];
       $orderid= $row['order_ID'];
       $pro1=  $row['product1'];
       $pro2=$row['product2'];
       $pro3 =$row['product3'];
       $rib1=$row['rib1'];
       $rib2=$row['rib2'];
      
       $vase=$row['vase'];
       $ex=$row['extra'];
       $loc=$row['Location'];
       $desc=$row['description'];


       
    ?>
  
    
 
    <tr height="50" align="left">
      <td><input type ="checkbox" name="served[]" value=<?php echo $orderid;?>/></td>

     
     <td height="50"> <?php echo $orderid;?></td>
     <td height="50"> <?php echo $userid;?></td>
      <td height="50"> <?php echo $pro1;?></td>
       <td height="50"> <?php echo $pro2;?></td>
        <td height="50"> <?php echo $pro3;?></td>
         <td height="50"> <?php echo $rib1;?></td>
          <td height="50"> <?php echo $rib2;?></td>
           <td height="50"> <?php echo $vase;?></td>
            <td height="50"> <?php echo $ex;?></td>
             <td height="50"> <?php echo $desc;?></td>
              <td height="50"> <?php echo $loc;?></td>
     

    </tr>


    <?php }  ?>

  

    <td><br>
    
    <tr height="90" align="center">
      <td colspan="2"><b><input type="submit" name="update" value="update" /></td>

    </tr>

     </td>
     
    
 </table>
        </form>

        <?php
  function update()
{
    
     $con = new mysqli("localhost","root","jmi1944","blossom");

                if ($con->connect_error) {
               die("Connection failed: " . $con->connect_error);
                  }
   

  if(isset($_POST['update']))
  {
         
        
    foreach($_POST['served'] as $serve_id)
    {
      

      $delete = "delete from custom where order_ID='$serve_id'";

    

       //$row1 = mysqli_query($con,$delete1);

      $row = mysqli_query($con,$delete);

      if($row)
      {
        //echo "removed";
         echo "<script><window.open('custommanage.php','_self)</script>"; 
       
        //echo "<script><window.open('custommanage.php')</script>";

      }
    }
  }
   
}

  echo @$update_cart = update();

//update();
?>   


 
    </div>
</div>
</body>



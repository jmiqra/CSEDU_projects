
<!DOCTYPE html>
<?php
include("db/tot_price.php");
//include("db/order.php");

session_start();

//session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
  header("Location: sign_in.php");
}
$res = "select * from user where User_name=.$_SESSION[user] ";
$qu=mysqli_query($con,$res);

$user = $_SESSION['user'];
$uid= $_SESSION['id'];

?>

<head>
  <title> Your Cart </title>
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

<body background="image/or.jpg">
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
    $sql= "select * from user where user_ID= '$uid'";
     $result = mysqli_query($con, $sql);
     //echo $search;
    
    $row = $result->fetch_assoc();
    $pro_image = $row['user_image'];
      if($pro_image){

    echo "<img src = 'prod_image/$pro_image'  class='img-circle' width=60 height =60>";
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

  <form action="" method="post" enctype="multipart/form-data">

            <table align="center" width="1000" bgcolor="AliceBlue">

                <tr align="center"  height="50">
                    <td td colspan="4"><h2>Here's your cart</h2></td>
                </tr>


                <tr align=" center">
                  <th height="50">Remove</th>
                  <th height="50">Product</th>
                  <th height="50">Quantity</th>
                  <th height="50">Price</th>
                </tr>
           
       
        <?php
        $total=0;

                $con = new mysqli("localhost","root","jmi1944","blossom");

                if ($con->connect_error) {
               die("Connection failed: " . $con->connect_error);
                  }

                  //local var
                   $userid=$_SESSION['id'] ;
                  $pro_ID;
                  $pro_qty=1;
     $sql = "select * from cart where user_ID=$userid";
     $result = mysqli_query($con, $sql);
     
      //if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {


       $pro_ID = $row['pro_id'];
       if(!$row['amount'])
        {
          $pro_qty=1;
        }
      else 
       {
        $pro_qty = $row['amount'];
      }

       $pro_price = "select * from products where product_ID = $pro_ID";

       $result1 = mysqli_query($con, $pro_price);
       while($row1 = $result1->fetch_assoc())
       {
              $price = array($row1['price']);

               $pro_title = $row1['name'] ;
               $pro_image = $row1['image'];
               $single = $row1['price'];

              $val = array_sum($price);

              $total+= $val;
       
    ?>
  
    
 
    <tr  align="left">
      <td height="80"><input type ="checkbox" name="remove[]" value=<?php echo $pro_ID;?>/></td>

      <td height="80"><?php echo $pro_title;?><br>

      <img src="prod_image/<?php echo $pro_image;?>"width="60" height ="60"/>
      </td>
      <td height="80"><input type="text" size="6" name="amount" value="<?php echo $pro_qty;?>"></td>

      <?php

     $in=1;
     if(isset($_POST['update']))
     {
      $amount = $_POST['amount'];
      $update = "update cart set amount = '$amount'";

      $row1= mysqli_query($con,$update);
   
       $total = $total*$amount;

       $single = $single*$amount*$in;


     }

      ?>
      <td height="80"><?php echo $single;?><br></td>

    </tr>


    <?php } } ?>

    <tr align="right">
      <td height="80" colspan="4"><b>Total : </b></td>
      <td height="80"><?php echo $total;?></td>
    </tr>

    <td>

     
    
    <tr align="center">
      <td height="100"colspan="2"><b><input type="submit" name="update" value="update" /></td>

    </tr>

     <tr>

<td height="60"><input type="text" name="address" placeholder="Your Address" size="60"/></td>
</tr>

    <tr>
         <td height="100"><input type ="submit" name="Order" value="Order"/></td>
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
         
      //echo "<script><window.open('cart.php','_self)</script>";    
    foreach($_POST['remove'] as $remove_id)
    {

      $delete = "delete from cart where pro_id='$remove_id'";

      $row = mysqli_query($con,$delete);

      if($row)
      {
        //echo "removed";
        
         echo "<script><window.open('cart.php')</script>"; 

      }
    }
  }
   
}

  echo @$update_cart = update();

//update();
?>   

 



<?php
$cartid="";
$insert_pro="";
if(isset($_POST['Order']))
    {
        
        $uid = $_SESSION['id'];
         $con = new mysqli("localhost","root","jmi1944","blossom");
         $address = $_POST['address'];

     if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
         }
         
        //echo $uid;
          $sql = "select * from cart where user_ID=$uid";
         $result = mysqli_query($con, $sql);
     
      //if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {

       //$uID = $row['pro_id'];
       $cartid = $row['cart_ID'];
     
     
      //echo $cartid;
       
        $insert_product = "insert into ordertable (user_ID,cart_id,location) 
        values ('$uid','$cartid','$address')";
        
        
        $insert_pro = mysqli_query($con,$insert_product);
      }

        if($insert_pro)
        {

          
            //echo "<script>alert('ORDER has been inserted !')</script>";
            echo "<script>window.open('order.php','_self')</script>";
        }
        echo "not inserted";

////////////////////////////////////////////////////////////////////

if(isset($_SESSION['id']))
{
  $uid=$_SESSION['id'];
  $que="select cart_id from ordertable where user_ID='$uid'";
     $res = mysqli_query($con, $que);
     //echo $search; 
  if ($res->num_rows > 0) 
    { 
      while($row = $res->fetch_assoc()) 
      {  
          $cart_id = $row['cart_id'];
          $qu2="select pro_id from cart where cart_ID='$cart_id'";
          $res2= mysqli_query($con,$qu2);

          if($res2->num_rows > 0)
          {
            while($row2 = $res2->fetch_assoc())
            {
              $pro_id=$row2['pro_id'];
              $up="update products set pro_sold=pro_sold+1 where product_ID='$pro_id'";
              $res_up=mysqli_query($con,$up);

              if($res_up)
              {
                echo "Record updated successfully";
              }
              else
                echo "Error updating record: " . $conn->error;  
            }
          }
          echo"
          <div class='col-md-4'>
            <div class='itm'>
            </div>
          </div>";
      }
    }     
    else 
    {
      echo "0 results";
    }
}

    }
    ?>

    </div>
</div>
</body>



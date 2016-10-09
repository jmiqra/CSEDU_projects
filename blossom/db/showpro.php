<?php
       //include("insert_cart.php"); 

        function get()
        {
        $con = new mysqli("localhost","root","jmi1944","blossom");


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

     
     $sql= "select * from products where keyword like '%birth%'";
     $result = mysqli_query($con, $sql);
    
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
              
              <img src = 'prod_image/$pro_image' class='img-thumbnail'>
              <p><b>BDT $pro_price</b></p>
             

              <a href='birthday.php?add=$pro_ID'><img src='image/add.png' alt='add to cart'></a>

             

             </div>
          </div>";
          
   }
         
} else {
    echo "0 results";
}
}
?>
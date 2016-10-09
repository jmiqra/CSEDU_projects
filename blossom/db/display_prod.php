<?php


function dis_prod()

{
    $con = new mysqli("localhost","root","jmi1944","blossom");

//get the cat

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
//global $con;
	//local var
     $sql = "select * from products";
     $result = mysqli_query($con, $sql);
    
      if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	
        //$cat_id = $row[cat_ID];
        $pro_name = $row['name'];
        $pro_image = $row['image'];
        $pro_price = $row['price'];

        echo "
          <div id='product'>
              
              <h3>$pro_name</h3>
              
              <img src = 'prod_image/$pro_image' class='img-thumbnail' width='180' height ='180'>
              <p class='text-center'><b>$pro_price</b></p>

          </div>";
   }
         
} else {
    echo "0 results";
}
	
}

dis_prod();
//$con->close();
?>

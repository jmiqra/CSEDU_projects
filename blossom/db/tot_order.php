            <?php

            function price()
            {
                $total=0;

                $con = new mysqli("localhost","root","jmi1944","blossom");

                if ($con->connect_error) {
               die("Connection failed: " . $con->connect_error);
                  }

                  //local var
                  $pro_ID;
     $sql = "select * from cart";
     $result = mysqli_query($con, $sql);
     
      if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $pro_ID = $row['pro_id'];
       $pro_price = "select * from products where product_ID = $pro_ID";
       $result1 = mysqli_query($con, $pro_price);
       while($row1 = $result1->fetch_assoc())
       {
              $price = array($row1['price']);

              $val = array_sum($price);
              $total+= $val;
       }
    }
    echo "<div class ='col-md-6'> 
    <h1>$total</h1>
    </div>";
} else {
    echo "0 results";
}
}
  
                ?>
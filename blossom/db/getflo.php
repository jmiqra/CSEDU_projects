<?php


function get_flower()

{

    $con = new mysqli("localhost","root","jmi1944","blossom");

//get the cat

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
//global $con;
    //local var
     $sql = "select * from products where category=3";
     $result = mysqli_query($con, $sql);

    
      if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        //$cat_id = $row[cat_ID];
        $pro_image = $row['image'];
       //echo "<option style='background-image:url(prod_image/$pro_image);' value=$row[name]><$row[name]></options>";
       echo "<option value=$row[name]>$row[name] </options>";
       //echo "<option><img src = 'prod_image/$pro_image' class='img-thumbnail' size='20'></option>";
    }
} else {
    echo "0 results";
}
    
}

//get_flower();
//$con->close();
?>

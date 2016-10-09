<?php


function get_cat()

{

    $con = new mysqli("localhost","root","jmi1944","blossom");

//get the cat

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
//global $con;
    //local var
     $sql = "select * from category";
     $result = mysqli_query($con, $sql);
    
      if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        //$cat_id = $row[cat_ID];
       echo "<option value=$row[cat_ID]>$row[cat_name]</options>";
    }
} else {
    echo "0 results";
}
    
}

//get_cat();
//$con->close();
?>

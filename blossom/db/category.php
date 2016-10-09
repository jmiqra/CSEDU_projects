<?php

$con = new mysqli("localhost","root","jmi1944","blossom");

//get the cat

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

function get_cat()

{
global $con;
	//local var
     $sql = "select * from category";
     $result = mysqli_query($con, $sql);
     //$con->query($sql);

	//$get_cat = "select * from category";

	//$run_cat = mysqli_query($con, $get_cat);
      if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo "<li><a href='#'>  $row[cat_name]</a></li>";
        //echo "  $row[cat_ID]";
    }
} else {
    echo "0 results";
}
	
}

//get_cat();
//$con->close();
?>

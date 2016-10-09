<?php



function get_pur()

{
//global $con;
    $con = new mysqli("localhost","root","jmi1944","blossom");

//get the cat

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
	//local var
     $sql = "select * from purpose";
     $result = mysqli_query($con, $sql);
    
      if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	
        //$cat_id = $row[cat_ID];
       echo "<option value=$row[pur_ID]>$row[pur_name]</options>";
    }
} else {
    echo "0 results";
}
	
}

//get_pur();
//$con->close();
?>

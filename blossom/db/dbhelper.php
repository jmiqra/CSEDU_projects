<?php

class dbhelper
{
	public function dbconnect()
	{
		$con = new mysqli("localhost","root","jmi1944","blossom");
		if ($con->connect_error) 
		{
		    die("Connection failed: " . $con->connect_error);
		} 
	}

	public function price()
  	{
	    $total=0;

	    $con = new mysqli("localhost","root","jmi1944","blossom");

	    if ($con->connect_error) 
	    {
	      die("Connection failed: " . $con->connect_error);
	    }

	    //local var
	    $pro_ID;
	    $sql = "select * from cart";
	    $result = mysqli_query($con, $sql);

	    if ($result->num_rows > 0) 
	    {
	      while($row = $result->fetch_assoc()) 
	      {
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
	    } 
	    else 
	    {
	      echo "0 results";
	    }
  	}

  	public function update()
	{
	     $con = new mysqli("localhost","root","jmi1944","blossom");

	                if ($con->connect_error) {
	               die("Connection failed: " . $con->connect_error);
	                  }
		 

		if(isset($_POST['update']))
		{
	         
	        
			foreach($_POST['remove'] as $remove_id)
			{

				$delete = "delete from cart where pro_id='$remove_id'";

				$row = mysqli_query($con,$delete);

				if($row)
				{
					echo "<script><window.open('cart.php')</script>";

				}
			}
		}
	   
	}

	public function get_vase()
	{
	  

	    $con = new mysqli("localhost","root","jmi1944","blossom");

	//get the cat

		if ($con->connect_error) 
		{
		    die("Connection failed: " . $con->connect_error);
		} 
	//global $con;
	    //local var
	     $sql = "select * from products where keyword like '%vase%'";
	     $result = mysqli_query($con, $sql);

	    
	    if ($result->num_rows > 0) 
	    {
	    // output data of each row
	    	while($row = $result->fetch_assoc()) 
	    	{
	        	//$cat_id = $row[cat_ID];
	        	$pro_image = $row['image'];
	       		//echo "<option style='background-image:url(prod_image/$pro_image);' value=$row[name]><$row[name]></options>";
	       		echo "<option value=$row[name]>$row[name] </options>";
	       		//echo "<option><img src = 'prod_image/$pro_image' class='img-thumbnail' size='20'></option>";
	    	}
		} 
		else 
		{
	    	echo "0 results";
		}
	}

	public function get_cat()
	{
	    $con = new mysqli("localhost","root","jmi1944","blossom");

	//get the cat

	    if ($con->connect_error) {
	        die("Connection failed: " . $con->connect_error);
	    } 
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

	public function get_flower()

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

}

    $db = new dbhelper();
?> 

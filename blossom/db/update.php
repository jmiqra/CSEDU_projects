<?php

function update()
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

	echo @$update_cart = update();	
//update();
?>
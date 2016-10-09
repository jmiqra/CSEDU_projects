<?php

		include_once 'dbconnect.php';


	if($_GET['code'])
	{
		//echo "goru";
		$get_code = $_GET['code'];
		$get_email = $_GET['email'];

		$sel_c = "select * from user where e_mail = '$get_email'";

		$run_c = mysqli_query($con, $sel_c);

		$check_c = mysqli_num_rows($run_c);

		while($row_c = mysqli_fetch_array($run_c))
		{
			$db_code = $row_c['passreset']; 
			$db_email = $row_c['e_mail']; 
		}

		if($get_email == $db_email && $get_code==$db_code)
		{
			echo 
			"<form action = 'pass_reset_complete.php?code=$get_code' method = 'POST'>
				Enter a new password <br> <input type='password' name = 'newpass'> <p>
				Re-enter your password <br> <input type='password' name = 'newpass1'> <p>
				<input type='hidden' value='$db_email' name = 'email'> <p>
				<input type='submit' value='Update Password!' <p>
			</form>";
		}
	}


?>
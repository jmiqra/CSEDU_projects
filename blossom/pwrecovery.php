<?php
require 'dbconnect.php';
if(isset($_POST['user']))
{
     $user = $_POST['user'];
     if(!empty($user))
     {
          $query = "SELECT pass, email
          FROM UserName
          WHERE userName = '$user'";
          if($query_run = mysql_query($query))
          {
               $query_num_rows = mysql_num_rows($query_run);
               if($query_num_rows==0)
               {
                    echo "You are Not Listed Here"."<br>";
               }
               else
               {
                    while($query_row = mysql_fetch_assoc($query_run))
                    {
                         $email = $query_row['email'];
                         $pass = $query_row['pass'];
			 
                         $to=$email;
			//echo "email is ".$to;
                         $subject='Password Recovery';
                         $body='Your password is:'.$pass;
                         $headers='From: demouser PC <blah@example.com>';
                         if(mail($to, $subject, $body, $headers))
			 {
				echo "mail sent";
			 }
                         
                    }
               }
          }
          else{
               echo "query incorrect.";
          }
     }
}
?>

Re-enter your username. Your Password will be mailed to your email.<br> <br>
<form action="pswrecovery.php" method="POST">
      Username: <input type = "text" name = "user">
      <input type="submit" name="forgot_password" value="Forgot password?">
</form>

<?php
      
      
    function user()
    {
    
       if(isset($_POST['submit']))
       {
        //Getting the text data from text fields
       
         $con = new mysqli("localhost","root","jmi1944","blossom");


     if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
         }
          $sql = "select * from user";
     $result = mysqli_query($con, $sql);

         $name= $_POST['name'];
         $email = $_POST['email'];
         $password = $_POST['pass'];
         
         //$pro_quantity= $result->num_rows;
         //$price = $_GET[]
         
        $insert = "insert into user(User_name,e_mail,Password) 
        values ('$name','$email','$password')";
        
        
        $insert_user = mysqli_query($con,$insert);

        if($insert_user)
        {
            echo "<script>alert(' Complete!')</script>";
            echo "<script>window.open('sign.php','_self')</script>";
        }
        echo "not inserted";
    
   }
   //else echo "not set";
  
}

//cart();
?>

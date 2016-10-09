<?php
      
      session_start();
      
     function cart()
    {

        //echo "getCat called";

        

        if(isset($_GET['add_cart']))
        {
                if(isset($_SESSION['user']) && $_SESSION['id'])
          {
  
          
  
            //global $con;

            $con = mysqli_connect("localhost","root","jmi1944","Blossom");

           
            $pro_id = $_GET['add_cart'];
           

            $userid=$_SESSION['id'] ;

            $check_pro = "select * from cart where pro_id='$pro_id' and user_ID='$userid'";

            $run_check = mysqli_query($con,$check_pro);

            if(mysqli_num_rows($run_check)>0)
            {
                echo "";
            }
            else
            {
                $insert_pro = "insert into cart (pro_id,user_ID) values ('$pro_id','$userid')";
                $run_pro = mysqli_query($con,$insert_pro);
                //echo "insertd";
                echo "<script>window.open(','_self')</script>";
            

            }
        }
    }
}
    

//cart();
?>

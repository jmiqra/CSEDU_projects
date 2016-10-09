<!DOCTYPE html>

<?php

include("db/select_cat.php");
include("db/select_pur.php");


?>

    <head>

        <title> Inserting Product> </title>

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>

    </head>

    <body>

        <form action="in.php" method="post" enctype="multipart/form-data">

            <table align="center" width="700" border="2" bgcolor="AliceBlue">

                <tr align="center">
                    <td td colspan="5"><h2>Insert new post here</h2></td>
                </tr>

                <tr>
                    <td><b>Product Title:</b></td>
                    <td><input type="text" name="product_title" size="60"/></td>
                </tr>
                

                <tr>
				<td align ="center"><b>Product_cat</b></td>
				<td>
					<select name="prod_cat">

						<option>Select a category</option>
						<?php
						get_cat();
						?>
				</td>
			</tr>

			<tr>
                    <td><b>Product Image</b></td>
                    <td><input type="file" name="product_image" /></td>
                </tr>

			<tr>
                    <td><b>Product Price:</b></td>
                    <td><input type="text" name="product_price"/></td>
                </tr>

			<tr>
                    <td><b>Product Description:</b></td>
                    <td><textarea name="product_desc" cols="20" rows="10" ></textarea></td>
                </tr>
			
			<tr align="center">
                    <td colspan="5"><input type="submit" name="insert_post" value="Insert Now"/></td>
                </tr>
            </table>

        </form>

    </body>

<?php
    if(isset($_POST['insert_post']))
    {
        //Getting the text data from text fields
       
         $con = new mysqli("localhost","root","jmi1944","blossom");

     if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
         }
        $product_title = $_POST['product_title'];
        $product_cat = $_POST['prod_cat'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];

        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];

        move_uploaded_file($product_image_tmp,"prod_image/$product_image");

        $insert_product = "insert into product (product_name,product_cat,product_image,price,description) 
        values ('$product_title','$product_cat','$product_image','$product_price',
        	'$product_desc')";
        
        

        $insert_pro = mysqli_query($con,$insert_product);

        if($insert_pro)
        {
            echo "<script>alert('Product has been inserted !')</script>";
            echo "<script>window.open('in.php','_self')</script>";
        }
        echo "not inserted";

    }
    echo "not set";

?>

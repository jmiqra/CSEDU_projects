<?php
$con = new mysqli("localhost","root","jmi1944","blossom");


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

?>

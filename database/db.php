<?php
$servername="sql202.epizy.com";
$username="epiz_32884724";
$password='P44tn8ecU9aqD';
$dbname="epiz_32884724_users";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
    die('could not conflict MySql server:' .mysql_error());
}


?>

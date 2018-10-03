<?php 
ob_start();
session_start();
if($_SESSION['name'] != "my_admin")
{
header('location: login.php');
}

?>
<?php

session_start();
session_destroy();
header('location: login.php');
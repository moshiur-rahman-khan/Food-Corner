<?php

ob_start();
session_start();
if($_SESSION['name'] != "my_admin")
{
header('location: login.php');
}

?>

<?php
include ('header.php');
?>
<pre>
<span id="content">
        
    Select Any Option</span>
<pre>


<?php
include ('footer.php');
?>


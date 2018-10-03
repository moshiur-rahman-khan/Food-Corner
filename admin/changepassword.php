<?php
ob_start();
session_start();
if($_SESSION['name']!='my_admin')
{
	header('location: login.php');
}
include("./database_file.php");
?>

<?php

if(isset($_POST['change_password'])){
    try {
        if(empty($_POST['old_password'])){
            throw new Exception("Old password field can't be empty");
        }
        if(empty($_POST['new_password'])){
            throw new Exception("New password field can't be empty");
        }
        if(empty($_POST['con_new_password'])){
            throw new Exception("Confirm password field can't be empty");
        }
        
        $statement = $db->prepare("SELECT * FROM login WHERE id = 1");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row){
            $old_pass = md5($_POST['old_password']);
            if($old_pass != $row['password']){
                throw new Exception("Old password is wrong.");
            }
        }
        if($_POST['new_password'] != $_POST['con_new_password']){
            throw new Exception("New password and confirm password doesn't match.");
        }
        
        $new_password = md5($_POST['new_password']);
        
        $statement = $db->prepare("UPDATE login SET password = ? WHERE id = 1");
	$statement->execute(array($new_password));
        
        $success_message = "Password successfully changed.";
        
    } catch (Exception $e) {
        $error_message1 = $e->getMessage();
    }

}


?>


<?php include './header.php';?>
<form action="" method="post">
    <table>
        <?php
        if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
        if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
        ?>
        <tr>
            <td>Old Password</td>
            <td><input class="short" type="password" name="old_password"></td>
        </tr>
        <tr>
            <td>New Password</td>
            <td><input class="short" type="password" name="new_password"></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input class="short" type="password" name="con_new_password"></td>
        </tr>
        <tr>
            <td></td>
            <td><input style="float: right;" type="submit" value="Save" name="change_password"></td>
        </tr>
    </table>
</form>
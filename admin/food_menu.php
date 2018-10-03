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

if(isset($_POST['form1'])) {


	try {
	
		if(empty($_POST['restaurant_name'])) {
			throw new Exception("Restayrant Name can not be empty.");
		}		
		if(empty($_POST['food_name'])) {
			throw new Exception("Restaurant Name can not be empty.");
		}
		if(empty($_POST['food_price'])) {
			throw new Exception("Price can not be empty.");
		}
		
		$statement = $db->prepare("SHOW TABLE STATUS LIKE 'resraurant_food_menu'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
                $new_id = $row[10];
					
		$up_filename=$_FILES["image"]["name"];
		$file_basename = substr($up_filename, 0, strripos($up_filename, '.'));
		$file_ext = substr($up_filename, strripos($up_filename, '.'));
		$f1 = $new_id . $file_ext;
		
		if(($file_ext!='.png')&&($file_ext!='.jpg')&&($file_ext!='.jpeg')&&($file_ext!='.gif'))
			throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");
		
		move_uploaded_file($_FILES["image"]["tmp_name"],"../food_image/" . $f1);
		
		$statement = $db->prepare("INSERT INTO resraurant_food_menu(restaurant_name,food_menu,food_image,price) VALUES(?, ?, ?, ?)");
		$statement->execute(array($_POST['restaurant_name'],$_POST['food_name'],$f1,$_POST['food_price']));
		
		$success_message = "Food details inserted successfully.";
		
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}


}

?>


<?php include("./header.php"); ?>

<h2>Add New Food</h2>

<?php
if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
?>

<form action="" method="post" enctype="multipart/form-data">
<table class="tbl1">
<tr>
            <td>
                <select name="restaurant_name">
                    <option value="">Select a Restaurant</option>
                    <?php
                    $statement = $db->prepare("SELECT * FROM restaurant ORDER BY restaurant_name ASC");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        ?>
                        <option><?php echo $row['restaurant_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
<tr><td>Food Name</td></tr>
<tr><td><input class="long" type="text" name="food_name"></td></tr>
<tr><td>Food Image</td></tr>
<tr><td><input type="file" name="image"></td></tr>
<tr><td>Price</td></tr>
<tr><td><input type="text" name="food_price"></td></tr>
<tr><td><input type="submit" value="SAVE" name="form1"></td></tr>
</table>	
</form>
<?php include("./footer.php"); ?>			
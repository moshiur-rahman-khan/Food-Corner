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
	
		if(empty($_POST['r_name'])) {
			throw new Exception("Title can not be empty.");
		}
		
		if(empty($_POST['description'])) {
			throw new Exception("Description can not be empty.");
		}
		if(empty($_POST['place'])) {
			throw new Exception("Place can not be empty.");
		}
		
		$statement = $db->prepare("INSERT INTO restaurant(restaurant_name,description,location) VALUES(?,?,?)");
                $statement->execute(array($_POST['r_name'],$_POST['description'],$_POST['place']));
		
		$success_message = "Restaurant inserted successfully.";
		
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}


}

?>


<?php include("./header.php"); ?>
<h2>Add New Restaurant</h2>

<?php
if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
?>

<form action="" method="post">
<table class="table table-responsive table-bordered">
<tr><td>Restaurant Name</td></tr>
<tr><td><input class="form-control" type="text" name="r_name"></td></tr>
<tr><td>Description</td></tr>
<tr>
<td>
<textarea name="description" cols="30" rows="10"></textarea>
<script type="text/javascript">
	if ( typeof CKEDITOR == 'undefined' )
	{
		document.write(
			'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
			'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
			'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
			'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
			'value (line 32).' ) ;
	}
	else
	{
		var editor = CKEDITOR.replace( 'description' );
		//editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );
	}

</script>
</td>
</tr>
<tr><td>Restaurant Location</td></tr>
<tr><td><input class="form-control" type="text" name="place"></td></tr>
<tr><td><input type="submit" class="btn btn-primary" value="SAVE" name="form1"></td></tr>
</table>	
</form>
<?php include("./footer.php"); ?>			
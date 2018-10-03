<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'my_admin') {
    header('location: login.php');
}
include('./database_file.php');
?>

<?php
if (isset($_POST['form_image'])) {
    try {

        if (empty($_POST['restaurant_name'])) {
            throw new Exception("Restaurant Name can not be empty.");
        }

        $statement = $db->prepare("SHOW TABLE STATUS LIKE 'image'");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row)
            $new_id = $row[10];


        $up_filename = $_FILES["image"]["name"];
        $file_basename = substr($up_filename, 0, strripos($up_filename, '.'));
        $file_ext = substr($up_filename, strripos($up_filename, '.'));
        $f1 = $new_id . $file_ext;

        if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif'))
            throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");

        move_uploaded_file($_FILES["image"]["tmp_name"], "../restaurant_image/" . $f1);

        $statement = $db->prepare("INSERT INTO image(restaurant_name,image) VALUES(?,?)");
        $statement->execute(array($_POST['restaurant_name'], $f1));

        $success_message = "Image Inserted Successfully";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<?php
include_once './header.php';
?>

<?php
if (isset($error_message)) {
    echo "<div class='error'>" . $error_message . "</div>";
}
if (isset($success_message)) {
    echo "<div class='success'>" . $success_message . "</div>";
}
?>



<form action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><h3>Choose Restaurant</h3></legend>
        <table class="table table-responsive">
            <tr>
                <td>Select a restaurant first : 
                    <select name="restaurant_name" class="form-control">
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
            <tr><td>Choose Image</td></tr>
            <tr><td><input type="file" name="image" class="form-control"></td></tr>
            <tr><td><input type="submit" class="btn btn-success" value="SAVE" name="form_image"></td></tr>
        </table>
    </fieldset>

</form>

<?php
include ('./footer.php');
?>
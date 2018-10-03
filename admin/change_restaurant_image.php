<?php
ob_start();
session_start();
if ($_SESSION['name'] != "my_admin") {
    header('location: login.php');
}
include ('./database_file.php');
?>

<?php
if (!isset($_POST['form2'])) {
    //header('location: change_restaurant_image.php');
} else {
    try {

        $id = $_POST['hdn'];
        $up_filename = $_FILES["image"]["name"];
        $file_basename = substr($up_filename, 0, strripos($up_filename, '.'));
        $file_ext = substr($up_filename, strripos($up_filename, '.'));
        $f1 = $id . $file_ext;

        if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif'))
            throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");


        $statement = $db->prepare("SELECT * FROM image WHERE id=?");
        $statement->execute(array($id));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $real_path = "../image/" . $f1;
            unlink($real_path);
        }
        move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $f1);



        $statement = $db->prepare("UPDATE image set image = ? WHERE id=?");
        $statement->execute(array($f1, $id));

        $success_message = "Restaurant image has been updated successfully.";
    } catch (Exception $e) {
        echo $e->$e->getMessage();
    }
}
?>


<?php
include ('./header.php');
?>

<div id="content" style="clear: both;">
    <h4 style=" padding-top: 5px;">
        All Image</h4>


    <?php
    if (isset($error_message)) {
        echo "<div class='error'>" . $error_message . "</div>";
    }
    if (isset($success_message)) {
        echo "<div class='success'>" . $success_message . "</div>";
    }
    ?>

    <?php
    $i = 0;
    $statement = $db->prepare("SELECT * FROM image ORDER BY id ASC");
    $statement->execute(array());
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $i++;
        ?>

    <img src="../restaurant_image/<?php echo $row['image']; ?>" alt="" style="width:200px; height: 100px;">
        <a class="fancybox" href="#inline<?php echo $i; ?>">Change</a>
        <div id="inline<?php echo $i; ?>" style="width:400px;display: none;">

            <h3>Change</h3>
            <p>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="hdn" value="<?php echo $row['id']; ?>">
                <table>
                    <tr>
                        <td>Choose Image</td>
                    </tr>
                    <tr><td><input type="file" name="image" ></td></tr>
                    <tr>
                        <td><input type="submit" value="UPDATE" name="form2"></td>
                    </tr>
                </table>
            </form>
            </p>
        </div>
        <?php
    }
    ?>

</div>
<?php
include ('./footer.php');
?>
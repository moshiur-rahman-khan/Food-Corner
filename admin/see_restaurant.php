<?php
ob_start();
session_start();
if ($_SESSION['name'] != "my_admin") {
    header('location: login.php');
}
include ('./database_file.php');
?>

<?php

try {
    if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $statement = $db->prepare("DELETE FROM restaurant WHERE id=?");
    $statement->execute(array($id));

    $success_message = "Restaurant Name has been deleted successfully.";
}
} catch (Exception $e) {
    echo $e->$e->getMessage();
}
?>

<?php
include ('./header.php');
?>

<span id="content" style="clear: both;">
    <h4 style=" padding-top: 5px;">
        All Restaurant</h4></span>

<?php
if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
?>

<table class="table table-bordered table-hover" width="50%" style="padding-top: 5px;">
    <tr>
        <th width="10%">Serial</th>
        <th width="60%">Restaurant Name</th>
        <th width="20%">Action</th>
    </tr>

<?php
$i = 0;
$statement = $db->prepare("SELECT * FROM restaurant ORDER BY id ASC");
$statement->execute(array());
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $i++;
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['restaurant_name'] ?></td>

            &nbsp;&nbsp;
            <td>
                <a onclick="return confirm_delete();"  href="see_restaurant.php?id=<?php echo $row['id']; ?>">Delete</td>
        </tr>
    <?php
}
?>
</table>

    <?php
    include ('./footer.php');
    ?>
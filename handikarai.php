<?php
include_once './admin/database_file.php';
$statement = $db->prepare("SELECT food_image FROM resraurant_food_menu WHERE restaurant_name = 'Handi Karai'");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once './header.php'; ?>

<!-- contact section -->
<section id="restaurants" class="parallax-section" style="margin-top: 10%;">


    <div class="container menu_images">
        <h2>Food Menus:</h2>
        <div class="row">
            <div class="col-sm-4">
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                    ?>
                    <img src="food_image/<?php echo $row['food_image']; ?>" class="img-responsive" style="width:100%; height: 200px; margin-top:2px;"/>
                </div>
                <?php
            }
            ?>
        </div>


    </div>



    <div class="container">

        <!--Restaurant individually show in this div-->
        <div class="restaurant-single">

            <div class="widget">
                <?php
                $statement = $db->prepare("SELECT * FROM restaurant WHERE restaurant_name = 'Handi Karai'");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    ?>
                    <h2 class="text-primary"><?php echo $row['restaurant_name']; ?></h2><hr />
                    <h2>Address: </h2>
                        <h3>
                    <?php echo $row['location']; ?>
                        </h3>
                    <img src="images/gallery-img1.jpg" class="img-responsive"/>
                    <div class="description">
                        <h3>Restaurant Description:</h3>
                        <p>
                            <?php echo $row['description']; ?>
                        </p>
                    </div>
                    <?php
                }
                ?>
                <div class="food_menu">
                    <!-- menu section -->
                    <section id="menu" class="parallax-section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
                                    <h1 class="heading">Menu List of Handi karai</h1>
                                    <hr>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <?php
                                    $statement = $db->prepare("SELECT * FROM resraurant_food_menu WHERE restaurant_name = 'Handi Karai'");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        ?>
                                        <h4><?php echo $row['food_menu']; ?><span></span><?php echo $row['price']; ?></h4>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>		

                </div>
                <div class="online_order">
                    <p>Do you want to make an online order to handi karai </p>
                    <a href="" class="btn btn-warning">Order now</a>
                </div>
                <div class="padding-bottom30"></div>

            </div>

        </div>



    </div>
</section>

<?php
include_once './footer.php';
?>
<?php
include_once './admin/database_file.php';
$id = $_REQUEST['id'];
?>

<?php include_once './header.php'; ?>

<!-- contact section -->
<section id="restaurants" class="parallax-section" style="margin-top: 10%;">


    <div class="container menu_images">
        
        <div class="row">
            <?php
                $statement = $db->prepare("SELECT * FROM resraurant_food_menu WHERE restaurant_name = ?");
                $statement->execute(array($id));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                    ?>
            <div class="col-sm-4">
                <div class="clear">
                    <img src="food_image/<?php echo $row['food_image']; ?>" class="img-responsive" style="max-width:300px; height: 200px; margin-top:2px;"/>
                    </div>
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
                $statement = $db->prepare("SELECT * FROM restaurant WHERE restaurant_name = ?");
                $statement->execute(array($id));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    ?>
                <h2 class="well" style="color: #FFF"><?php echo $row['restaurant_name']; ?></h2><hr />
                    <h3>Address: </h3>
                    <h4>
                        <?php echo $row['location']; ?>
                    </h4>
                    <div class="description">
                        <h3>Details:</h3>
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
                                    <h1 class="heading">Food Menu</h1>
                                    <hr>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <ol class="list-group">


                                        <?php
                                        $statement = $db->prepare("SELECT * FROM resraurant_food_menu WHERE restaurant_name = ?");
                                        $statement->execute(array($id));
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        $i = 1;
                                        foreach ($result as $row) {
                                            ?>
                                            <li class="list-group-item"><h4> Menu No : <?php echo $i.' <span class="text-primary btn btn-warning">' .$row['food_menu']. "</span>"; ?><span> </span><?php echo '<span class="text-primary btn btn-info">' . $row['price'] . "</span>"; ?></h4></li>

                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </section>		

                </div>
                <div class="online_order">
                    <p>Do you want to make an online order </p>
                    <a href="" class="btn btn-warning">Order now</a>
                </div>
                <div class="padding-bottom30"></div>

            </div>

        </div>



    </div>
</section>


<!-- footer section -->
<footer class="parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
                <h2 class="heading">Contact Info.</h2>
                <div class="ph">
                    <p><i class="fa fa-phone"></i> Phone</p>
                    <h4>090-080-0760</h4>
                </div>
                <div class="address">
                   
                </div>
            </div>
            <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
                
                
                <?php
                $statement = $db->prepare("SELECT * FROM restaurant WHERE restaurant_name = ?");
                $statement->execute(array($id));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    ?>
                
                
                <h2 class="heading">Open Hours</h2>
                <p>Sunday <span><?php echo $row['time'];echo $row['shift']; ?> - <?php echo $row['closing_time'];echo $row['closing_shift'] ?></span></p>
                <p>Mon-Fri <span>9:00 AM - 8:00 PM</span></p>
                <p>Saturday <span>11:30 AM - 10:00 PM</span></p>
                <?php
                }
                ?>
            </div>
            <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
                <h2 class="heading">Follow Us</h2>
                <ul class="social-icon">
                    <li><a href="https://web.facebook.com/moshiur.rahman006" class="fa fa-facebook wow bounceIn" data-wow-delay="0.3s"></a></li>
                    <li><a href="#" class="fa fa-twitter wow bounceIn" data-wow-delay="0.6s"></a></li>
                    <li><a href="#" class="fa fa-behance wow bounceIn" data-wow-delay="0.9s"></a></li>
                    <li><a href="#" class="fa fa-dribbble wow bounceIn" data-wow-delay="0.9s"></a></li>
                    <li><a href="#" class="fa fa-github wow bounceIn" data-wow-delay="0.9s"></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<!-- copyright section -->
<section id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>Food Corner</h3>
                <p>Copyright © Food corner 

                    | Design:Moshiur Rahman 
            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT JS FILES -->	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>

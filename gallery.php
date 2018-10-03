
<?php include_once './header.php'; ?>
<!-- home section -->
<section id="home" class="parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h1>FOOD CORNER</h1>
                <h3>CHECK OUT YOUR RESTAURANT HERE!</h3>
                <a href="" class="smoothScroll btn btn-default">LEARN MORE</a>
            </div>
        </div>
    </div>		
</section>


<!-- gallery section -->
<section id="gallery" class="parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
                <h1 class="heading">Food Gallery</h1>
                <hr>
            </div>
            <?php
            include ('admin/database_file.php');
            $statement = $db->prepare("SELECT * FROM resraurant_food_menu ORDER BY id DESC LIMIT 10");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                ?>
                <div class="col-md-3 col-sm-3 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="food_image/<?php echo $row['food_image']; ?>" data-lightbox-gallery="zenda-gallery">
                    <img src="food_image/<?php echo $row['food_image']; ?>" alt="" style="max-width: 300px; max-height: 300px">
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>


<?php
include_once './footer.php';
?>
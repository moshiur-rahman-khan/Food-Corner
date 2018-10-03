<?php
include ('./admin/database_file.php');
?>




<?php include_once './header.php'; ?>
<!-- home section -->
<section id="home" class="parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h1>FOOD CORNER</h1>
                <h2>Check Out Your Restaurant Here!</h2>
                <a href="#gallery" class="smoothScroll btn btn-default">LEARN MORE</a>
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
            $statement = $db->prepare("SELECT * FROM image ORDER BY id DESC");
            $statement->execute();
            $i = 0;
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $i++;
                ?>
                <div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.3s">
                    <!--                    <a href="images/gallery-img1.jpg" data-lightbox-gallery="zenda-gallery">-->
                    <img src="restaurant_image/<?php echo $row['image']; ?>" alt="">
                    <div>
                    </div>
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
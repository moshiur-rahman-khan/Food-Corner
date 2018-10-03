<?php include ('admin/database_file.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Food Corner</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/nivo-lightbox.css">
        <link rel="stylesheet" href="css/nivo_themes/default/default.css">
        <link rel="stylesheet" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    </head>
    <body>


        <!-- navigation section -->
        <section class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                    </button>
                    <a href="./" class="navbar-brand">Food Corner</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="./" class="smoothScroll">HOME</a></li>
                        <li><a href="gallery.php" class="smoothScroll">FOOD GALLERY</a></li>
                        <li><a href="all_restaurants.php" class="smoothScroll">All Restaurants</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Top Restaurants In Barisal
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">

                                <?php
                                $statement = $db->prepare("SELECT * FROM restaurant");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <li><a href="resraurant-details.php?id=<?php echo $row['restaurant_name']; ?>"><?php echo $row['restaurant_name'] ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li><a href="about.php" class="smoothScroll">About</a></li>
                    </ul>
                </div>
            </div>
        </section>
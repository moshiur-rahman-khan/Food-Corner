<?php
include ('./admin/database_file.php');
/* ===================== Pagination Code Starts ================== */

$adjacents = 7;

$statement = $db->prepare("SELECT * FROM restaurant ORDER BY id DESC");
$statement->execute();
$total_pages = $statement->rowCount();


$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
$limit = 1;                                 //how many items to show per page
$page = @$_GET['page'];
if ($page)
    $start = ($page - 1) * $limit;          //first item to display on this page
else
    $start = 0;


$statement = $db->prepare("SELECT * FROM restaurant ORDER BY id DESC LIMIT $start, $limit");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);


if ($page == 0)
    $page = 1;                  //if no page var is given, default to 1.
$prev = $page - 1;                          //previous page is page - 1
$next = $page + 1;                          //next page is page + 1
$lastpage = ceil($total_pages / $limit);      //lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;
$pagination = "";
if ($lastpage > 1) {
    $pagination .= "<div class=\"pagination\">";
    if ($page > 1)
        $pagination.= "<a href=\"$targetpage?page=$prev\">&#171; previous</a>";
    else
        $pagination.= "<span class=\"disabled\">&#171; previous</span>";
    if ($lastpage < 7 + ($adjacents * 2)) {   //not enough pages to bother breaking it up
        for ($counter = 1; $counter <= $lastpage; $counter++) {
            if ($counter == $page)
                $pagination.= "<span class=\"current\">$counter</span>";
            else
                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
        }
    }
    elseif ($lastpage > 5 + ($adjacents * 2)) {    //enough pages to hide some
        if ($page < 1 + ($adjacents * 2)) {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
            $pagination.= "...";
            $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
            $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
        }
        elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            $pagination.= "...";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
            $pagination.= "...";
            $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
            $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
        }
        else {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            $pagination.= "...";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
        }
    }
    if ($page < $counter - 1)
        $pagination.= "<a href=\"$targetpage?page=$next\">next &#187;</a>";
    else
        $pagination.= "<span class=\"disabled\">next &#187;</span>";
    $pagination.= "</div>\n";
}
/* ===================== Pagination Code Ends ================== */
?>

<?php include_once './header.php'; ?>

<!-- gallery section -->

<section id="all_restaurants container" class="parallax-section" style="margin-top: 10%">
    <?php
foreach ($result as $row) {
    ?>
    <div class="container widget">
        <h2><?php echo $row['restaurant_name']; ?> : </h2>
        <h3>About: </h3>
        <?php echo $row['description']; ?>

    </div>
    <?php
    }
    ?>
</section>

<div style="clear: both"></div>
<div class="pagination">
    <?php
    echo $pagination;
    ?>
</div>


<?php 
include_once './footer.php'; 
?>
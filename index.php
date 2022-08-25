<?php include "./includes/_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php"; ?>
    <?php include "logincheck.php"; ?>
    <title>sWH</title>
</head>
<body>
    
        <?php $page = "home"; include "includes/header.php"; ?>


        <div id="carouselSlider" class="carousel slide" data-ride="carousel" data-interval="500">
        <ol class="carousel-indicators">
          <li class="indicator" data-target="#carouselSlider" data-slide-to="0" class="active"></li>
          <li class="indicator" data-target="#carouselSlider" data-slide-to="1"></li>
          <li class="indicator" data-target="#carouselSlider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
                   <?php
                 $prod_query = "select * from products where `featured` = 1";
                 $total_prods = sizeof(mysqli_fetch_assoc(mysqli_query($conn, $prod_query)));
                 echo $total_prods;
                 $prod_result = mysqli_query($conn, $prod_query);
                 $numbers = range(1, $total_prods);
                 shuffle($numbers);
                 $rand_prod1 = $numbers[0]; $rand_prod2 = $numbers[1]; $rand_prod3 = $numbers[2];
                 $prod_number = 1; $rand_prod_number = 0;
                 $prod_result = mysqli_query($conn, $prod_query);
                 $rand_prods = array(3);
                 $rand_prod_ids = array(3);
                 while($row = mysqli_fetch_assoc($prod_result)){
                     if($prod_number===$rand_prod1){
                         $rand_prods[0] = $row['prod_title'];
                         $rand_prod_ids[0] = $row['prod_id'];
                     }else if($prod_number===$rand_prod2){
                         $rand_prods[1] = $row['prod_title'];
                         $rand_prod_ids[1] = $row['prod_id'];
                     }else if($prod_number===$rand_prod3){
                         $rand_prods[2] = $row['prod_title'];
                         $rand_prod_ids[2] = $row['prod_id'];
                     }
                     $prod_number++;
                 }
                 for($i=0; $i<sizeof($rand_prods); $i++){  ?>
                    <div class="carousel-item <?php if($i===0) echo 'active'; ?>">
                     <img class="d-block w-100" src="./img/carousel/<?= $i+1?>.png" alt="First slide">
                     <a href="#">
                         <div class="carousel-caption text-center">
                         <a style="text-decoration:none; color: white; " href="details.php?product_id=<?=$rand_prod_ids[$i]?>"><h5><?= $rand_prods[$i]?></h5></a>
                         </div>
                     </a>
                   </div>
        <?php      }
        ?>
        </div>
        <a class="carousel-control-prev" href="#carouselSlider" role="button" data-slide="prev">
          <i class="carousel-arrow fa fa-chevron-left"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselSlider" role="button" data-slide="next">
          <i class="carousel-arrow fa fa-chevron-right"></i>
          <span class="sr-only">Next</span>
        </a>
      </div>

        <br><br><br>
       
        
        <?php
            function isPresent($ar, $val){
                for($i=0; $i<sizeof($ar); $i++){
                    if($ar[$i]==$val) return true;
                }
            return false;
            }
        ?>
        <div>
            <form class="form padding" method = "post" action="index.php">
                <?php 
                    $tag_query = "select * from tags";
                    $result = mysqli_query($conn, $tag_query);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            $tag_name = $row['tag'];
                            $tag_id = $row['tag_id'];?>
                    <div class="form-check form-check-inline tag-boxes">
                        <input <?php if(!isset($_POST['tags'])||isPresent($_POST['tags'], $tag_id)) echo "checked"; ?> type = "checkbox" class="form-check-input" name="tags[]" value=<?= $tag_id?>><?= $tag_name?></input>
                    </div>
                <?php }
                    }

                ?>
                <br>
                <input type = "submit" class="btn btn-secondary btn-sm filter-btn" name="filter" value="Filter"></input>
            </form>
        </div>
        
<br><br><hr><h1 style="text-align: center;">Featured Products</h1>
                <hr>
        <div class="container-fluid text-center">
            <div class="row">
        <?php 
            $prod_query = "select * from products where `featured` = 1";
            $prod_result = mysqli_query($conn, $prod_query);
            if(mysqli_num_rows($prod_result)){
                while($row = mysqli_fetch_assoc($prod_result)){
                    $prod_id = $row['prod_id'];
                    $prod_title = $row['prod_title'];
                    $list_price = $row['list_price'];
                    $discount = $row['discount'];
                    $price = $list_price - ($list_price*$discount/100);
                    $prod_category = $row['prod_category'];
                    $description = $row['description'];
                    $rating = $row['rating']; ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 prod-tile">
                <a href="details.php?product_id=<?=$prod_id?>" class="tile">
                    <table class="">
                        <tr>
                            <td>
                                <img class="card-img-top" src="./admin/uploads/product_images/<?= $prod_id?>.png" alt="Product">   
                                <br>                            
                                <h6 class="prod-title"><?= $prod_title?></h6>
                            </td>
                            <td class="prod-det">
                                        <span class="list-price text-danger">List Price: <s>$<?= $list_price ?></s></span><br>
                                        Our Price: $<?= $price ?><br>
                                        Save $<?= $list_price-$price ?> (<?=$discount ?>%)<br>
                                       <!-- <button type="button" class="btn btn-secondary">Details</button>-->
                                       <?php for($i=0; $i<$rating; $i++) echo '<i class="fa fa-star"></i>'; ?>

                            </td>
                        </tr>
                    </table>
                </a>
                    <br><br>
            </div>
                    
            <?php }
            }
        ?>
        </div>
        </div>
        <hr>
        <br><br><br><br><br>
        <?php include "includes/footer.php" ?>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
</body>
</html> 









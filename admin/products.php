<?php include "./includes/_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/head.php"; ?>
    <title>Products</title>
    <style>
        .fa-star{
            color: #FF9529;
        }
    </style>
</head>
<body>
   <?php include "includes/header.php"; ?>
   <br><br><br><br><br><br>
	<h2 class="text-center">Admin Panel Authors Page</h2>
	<br><br><br><br><br><br>       
    <h4 class="text-center">Products</h4>
    <table class="table table-bordered text-center">
	<thead>
		<th></th><th>Product Name</th><th>List Price</th><th>Discount</th><th>Price</th><th>Rating</th>
	</thead>
	<tbody>
		<?php
		$prod_query = "select * from products";
		$result = mysqli_query($conn, $prod_query);
		if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $prod_id = $row['prod_id'];
                $prod_title = $row['prod_title'];
                $list_price = $row['list_price'];
                $discount = $row['discount'];
                $price = $list_price - ($list_price*$discount/100);
                $prod_category = $row['prod_category'];
                $description = $row['description'];
                $rating = $row['rating']; ?>
            <tr><td></td><td><?= $prod_title?></td><td><?= $list_price?></td><td><?= $discount ?></td><td><?=$price ?></td><td><?= $rating ?><?php for($i=0; $i<$rating; $i++) echo '<i class="fa fa-star"></i>'?></td></tr>
            <?php }
            } ?>
	</tbody>
	</table>
</body>
</html>
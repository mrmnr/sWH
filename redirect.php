<?php include "./includes/_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payment Successful</title>
 <?php include 'includes/head.php'; ?>
</head>
<body>
<?php include 'logincheck.php'; ?>
<?php include 'includes/header.php'; ?>


	<div class="container-fluid padding">
	<div class="padding">
	<br><br><br><br><br><br>
    <?php if(isset($_SESSION['customer_id'])){ ?>
	<h2 class="text-center"><?php $result = mysqli_query($conn, "select * from customers where customer_id = ".$_SESSION['customer_id']); $row = mysqli_fetch_array($result); echo $row['full_name']; ?></h2>
    <?php } ?>
	<a href = "index.php"><h1 class="text-center"><i class="fa fa-home"></i></h1></a>
	<a href = "index.php"><p class="text-center">Back to Homepage</p></a>
	<br><br>
	</div>
	</div>
	<hr>

<?php if(isset($_GET['payment_id'])){
    $payment_id = $_GET['payment_id']; ?>
<div class="bg-success text-center"><p>Your Payment <?php if(isset($_SESSION['cart_total'])){ echo "of ".$_SESSION['cart_total'];}?> was successfully processed with Payment ID:<?php echo $payment_id;?></p></div>
<?php } 
    $buy_date = time() + 16200;
    ?>

        <div class="text-center">
            
        </div>
                    
            <?php
            if(isset($_SESSION['cart_id'])){//purchase succesful ?>
                     <div class="final-cart-details">
                        <h4 class="text-center"><?= date("Y-m-d h:i:sa", $buy_date);?></h4>
                        <table class="table table-bordered">
                            <thead><th>Product</th><th>List Price</th><th>Discount</th><th>Our Price</th></thead>
                            <tbody>
    <?php
                $cart_id = $_SESSION['cart_id'];
                //add cart_rows into 'purchased' table
                $cart_total = 0; 
                $conn = mysqli_connect('localhost', 'root', '', 'newbase');
                $cart_query = "select * from carts where cart_id = ".$_SESSION['cart_id'];
                $result_cart = mysqli_query($conn, $cart_query);
                if(mysqli_num_rows($result_cart)>0){
                    while($row = mysqli_fetch_assoc($result_cart)){
                        $activation_period = $row['activation_period'];
                        $prod_id = $row['prod_id'];
                        $prod_details = mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "", "newbase"), "select * from products where prod_id = ".$prod_id)); 
                        $prod_title = $prod_details['prod_title'];
                        $list_price = $prod_details['list_price']/$activation_period; 
                        $list_price = number_format($list_price, 2, '.'); 
                        $discount = $prod_details['discount'];
                        $discount = number_format($discount, 0, '.'); 
                        $price = $list_price - ($list_price*$discount/100); 
                        $price = number_format($price, 2, '.');
                        $savings = ($list_price*$discount/100);  
                        $savings = number_format($savings, 2, '.'); 
                        $cart_total = $cart_total + $price; ?>
                    
                                <tr><td><?=$prod_title ?></td><td><?= $list_price ?></td><td><?= $discount ?>%</td><td><?= $price?></td></tr>
                            
    <?php               $insert_query = "insert into purchases (cart_id, prod_id, buy_date) values ('$cart_id', '$prod_id','$buy_date')";
                        $delete_query = "delete from carts where cart_id = ".$cart_id." AND prod_id = ".$prod_id;
                        mysqli_query($conn, $insert_query);
                        mysqli_query($conn, $delete_query); 
                        
                }
            }
                    unset($_SESSION['cart_id']);
            ?>
                                <tr class="bg-light"><td colspan = "3" class="text-center">Total </td><td><?= $cart_total ?></td></tr>
                            </tbody>
                        </table>
                    </div>
    <?php } ?>

<br><br><br><br>
<?php include 'includes/footer.php'; ?>
       
</body>
</html>
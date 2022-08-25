<?php include "./includes/_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./includes/head.php"; ?>
    <title>Purchases</title>
</head>
<body>
    <?php include "./logincheck.php"; ?>
    <?php include "./includes/header.php"; ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12">
             <h3>Purchases</h3>
              <table class="table table-bordered">
                    <thead><th></th><th>Product</th><th>Date of Purchase</th><th>Customer Name</th><th>Customer Email</th></thead>
                    <tbody>
                    <?php
                        $purchase_query = "select * from purchases";
                        $purchase_result = mysqli_query($conn, $purchase_query);
                        if(mysqli_num_rows($purchase_result)>0){
                            $row_num = 1; 
                            while($row = mysqli_fetch_assoc($purchase_result)){
                                $customer_id = $row['cart_id'];
                                $prod_id = $row['prod_id'];
                                $purchase_date = $row['buy_date'];
                                $customer_info_array = mysqli_fetch_assoc(mysqli_query($conn, "select * from customers where customer_id = ".$customer_id));
                                $customer_full_name = $customer_info_array['full_name'];
                                $customer_email = $customer_info_array['email'];
                                $prod_info_array = mysqli_fetch_assoc(mysqli_query($conn, "select * from products where prod_id = ".$prod_id));
                                $prod_title = $prod_info_array['prod_title'];?>
                                <tr><td><?= $row_num ?></td><td><?= $prod_title?></td><td><?= date("Y-m-d h:i:sa", $purchase_date)?></td><td><?= $customer_full_name?></td><td><?= $customer_email?></td></tr>
                                <?php
                                $row_num++;
                                
                            }
                        }else{
                            echo "NO RESULTS FOR TIMINGS";
                        }

                    ?>
                    </tbody>
        </table>
            </div>
        </div>
    </div>
        
    <br><br><br><br>
</body>
</html>
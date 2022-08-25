<?php include "./includes/_conn.php"; ?>
<?php include 'logincheck.php'; ?>
<?php
if(isset($_POST['checkout'])){
	$customer_id = $_SESSION['customer_id'];
	$customer_name = $_POST['full_name'];
	$customer_email = $_POST['email'];
	$card_no = $_POST['card_number'];
	$exp_month = $_POST['card_exp_month'];
	$exp_year = $_POST['card_exp_year'];
	$cvv = $_POST['cvv'];
	$card_name = $_POST['card_name'];
		$cart_result = mysqli_query($conn, "select * from carts where cart_id = ".$customer_id);
		$cart_total = 0;
		//calculation of cart_total starts
		while($row = mysqli_fetch_assoc($cart_result)){
				$prod_id = $row['prod_id'];
				$activation_period = $row['activation_period'];
				$prod_array = mysqli_fetch_assoc(mysqli_query($conn, "select * from products where prod_id = ".$prod_id));
				$price = $prod_array['list_price'] - $prod_array['list_price']*$prod_array['discount']/100;
				$price = $price/$activation_period;
				$cart_total = $cart_total + $price;
		}
		//cart total calculated
		$_SESSION['cart_id'] = $_SESSION['customer_id'];
		$cart_total = number_format($cart_total, 2, ".");
include "./instamojo/Instamojo.php"; 
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_cb2fff04e9049fca0690aa1dfe3",
                  "X-Auth-Token:test_9c4046bcbdcd928f58ed0e79ad0"));
$payload = Array(
    'purpose' => 'Software from sWH',
    'amount' => $cart_total,
    //'phone' => '9682344507',
    'buyer_name' => $customer_name,
    'redirect_url' => 'http://localhost:1234/sWH/redirect.php',
    'send_email' => true,
  //  'webhook' => 'http://www.example.com/webhook/',
   // 'send_sms' => true,
    'email' => $customer_email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
$response = json_decode($response);
if (!empty($response->payment_request->longurl)) {
	$payment_link = $response->payment_request->longurl;
} 
if(!empty($response->payment_request->id)){
	$_SESSION['tid'] = $response->payment_request->id; 
}
header("Location: ".$payment_link); 
die(); 

}?>
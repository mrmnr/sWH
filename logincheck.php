<?php include "./includes/_conn.php"; ?>
<?php 
session_start();
if(isset($_POST['login'])){
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	unset($_POST);
	$conn = mysqli_connect("localhost", "root", "", "newbase");
	$admin_query = "select * from customers where email = '$email' and pwd = '$pwd'";
	$result = mysqli_query($conn, $admin_query);
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		$_SESSION['customer_id'] = $row['customer_id'];
	}else{
		echo "no results";
	}
}
if(false){
if(!isset($_SESSION['customer_id'])){ ?>
<br><br><br><br>
    <div class="container-fluid">
	<div class="col-12 text-center">
	<h1 class="bg-light">Customer Login</h1>
	</div>
	<form action="index.php" method="post">
		<div class="row">
			<div class="col-12">
			<input type="email" name="email" class="form-control" placeholder="Customer Email">
			<br>
			</div>
			<div class="col-12">
			<input type="password" name="pwd" class="form-control" placeholder="Password">
			<br>
			</div>
			<div class="col-12 text-center">
			<input type="submit" name="login" class="btn btn-primary" value="Login">
			</div>
		</div>
	</form>
	</div>
<?php exit; } 
}
?>
<?php include "./includes/_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <?php include "./includes/head.php"; ?>
</head>
<body>
    
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
</body>
</html>
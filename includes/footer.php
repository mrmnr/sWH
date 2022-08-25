<footer style="background-image: linear-gradient(-90deg, #d0d0d0, #ffffff);" id="footer">
	<div class="container-fluid padding">
	<div class="row text-center">
	<div class="col-md-4">
	<hr class="light">
	<p><i class="fa fa-compass" aria-hidden="true" style="font-size:3em"></i></p>
	<hr class="light">
	<?php 
		$display = 1;
		$sql_query = "select * from addresses where `display` = $display";
		$query_result = mysqli_query($conn, $sql_query);
		if(mysqli_num_rows($query_result)>0){
			while($row = mysqli_fetch_assoc($query_result)){
				$office_name = $row['office_name'];
				$city = $row['city_name'];
				$state = $row['state'];
				$pincode = $row['pin_code'];
				print('<p>'.$office_name.'</p>
						<p>'.$city.' </p>
						<p>'.$state.' - '.$pincode.'</p>');
			}
		}else{
			echo "no results";
		}


	?>
	</div>
	<div class="col-md-4">
	<hr class="light">
	<p><i class="fa fa-clock-o" aria-hidden="true" style="font-size:3em"></i></p>
	<hr class="light">
	<?php 
		$display = 1;
		$sql_query = "select * from timings where `display` = $display";
		$query_result = mysqli_query($conn, $sql_query);
		if(mysqli_num_rows($query_result)>0){
			while($row = mysqli_fetch_assoc($query_result)){
				$day= $row['day'];
				$time_range = $row['time_range'];
				print('<p>'.$day.'	'.$time_range.'</p>');
			}
		}
	?>
	</div>
	<div class="col-md-4">
	<hr class="light">
	<p><i class="fa fa-list" aria-hidden="true" style="font-size:3em"></i></p>
	<hr class="light">
	<?php
		$sql_query = "select * from categories where `parent` = 1";
		$query_result = mysqli_query($conn, $sql_query);
		if(mysqli_num_rows($query_result)>0){
			while($row = mysqli_fetch_assoc($query_result)){
				$cat_id = $row['cat_id'];
				$category = $row['category'];
				print('<p><a style="text-decoration:none;" href="products.php?category='.$cat_id.'">'.$category.'</a></p>');
			}
		}
	?>
	</div>
	
	<div class="col-12">
	<hr class="light">
	<h5>&copy; Ershad Tantry</h5>
	</div>	
	</div>
	</div>
</footer>
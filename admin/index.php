<?php include "./includes/_conn.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
<?php include 'includes/head.php'; ?>
<style>
.category{
    background-color: #f0f0f0;
}
.fa-remove{
    color: red;
}
</style>
</head>
<body>
<?php include "logincheck.php"; ?>
<!-- MODAL. -->
        <div class="modal edit-category" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="edit-category" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="text-center">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="ajax_response">
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="modal edit-category" id="edit-address" tabindex="-1" role="dialog" aria-labelledby="edit-address" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="text-center">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="ajax_response">
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="modal edit-category" id="edit-timing" tabindex="-1" role="dialog" aria-labelledby="edit-timing" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="text-center">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Timing</h5>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="ajax_response">
                    
                    </div>
                </div>
            </div>
        </div>
<!-- ... MODALS -->
<!-- ... MODALS -->

	<?php include 'includes/header.php';?> 
    <?php
            if(isset($_POST['edit_category']) && !isset($_POST['new_parent'])){
                    $new_category = $_POST['new_category'];
                    $cat_id = $_POST['cat_id'];
                    $display = $_POST['new_display'];
                    $edit_query = "update categories set `category` = '$new_category', `display` = $display where `cat_id` = $cat_id";
                    mysqli_query($conn, $edit_query);
            }else if(isset($_POST['edit_category']) && isset($_POST['new_parent'])){
                echo  $_POST['new_parent'];
                $new_category = $_POST['new_category'];
                $cat_id = $_POST['cat_id'];
                $display = $_POST['new_display'];
                $new_parent = $_POST['new_parent'];
                $edit_query = "update categories set `category` = '$new_category', `display` = $display, `parent` = $new_parent where `cat_id` = $cat_id";
                    mysqli_query($conn, $edit_query);
            }
            
    ?>
	<div class="container-fluid padding">
	<div class="padding">
	<br><br><br><br><br><br>
	<h2 class="text-center">Admin Panel Home Page</h2>
    <div class="bg-light">
    <p class="text-center text-success">
	<?php
    $admin_id = $_SESSION['admin_id'];
	$admin_info_query = "select * from admins where admin_id = ".$admin_id;
	$info_result = mysqli_query($conn, $admin_info_query);
	$info_arr = mysqli_fetch_assoc($info_result);
	$admin_full_name = $info_arr['full_name'];
	echo $admin_full_name;
    print('<p class="text-center"><a href="logout.php" >Logout</a><p>');
    //session_destroy();
	?>
	</p>
	</div>
	<br><br><br><br><br><br>
	</div>
	</div>
	<div class="container-fluid">
	<div class="row text-center">
		<div class="col-md-4 bg-light">
		<h5>Categories & Sub-Categories</h5>
       <?php if(isset($_GET['delete'])){ ?>
        <p class="text-center text-danger">Deleted!</p>
        <?php } ?>
		<table class="table table-bordered">
			<thead>
				<th></th><th>Category Name</th><th>Display</th><th></th>
			</thead>
			<tbody>
            <?php
                $sql_query = "select * from categories where `parent` = 0";
                $query_result = mysqli_query($conn, $sql_query);
                if(mysqli_num_rows($query_result) > 0){
                    $categoryNo = 1;
                    while($row = mysqli_fetch_assoc($query_result)){
                        $category = $row['category'];
                        $cat_id = $row['cat_id'];
                        $display = $row['display'];
                        $display = ($display==0)?"NO":"YES";
                        print('<tr class="category"><td><a type="button" class="modal-btn modal-btn-1" data-id='.$cat_id.'><i class="fa fa-pencil"></i></a></td><td>'.$category.'</td><td>'.$display.'</td><td><a href="index.php?delete=category&id='.$cat_id.'"><i class="fa fa-remove"></i></a></td></tr>');
                        $sub_query = "select * from categories where `parent` = $cat_id";
                        $sub_result = mysqli_query($conn, $sub_query);
                        if(mysqli_num_rows($sub_result)>0){
                            while($sub_row = mysqli_fetch_assoc($sub_result)){
                                $sub_id = $sub_row['cat_id'];
                                $sub_category = $sub_row['category'];
                                $sub_display = $sub_row['display'];
                                $sub_display = ($sub_display)?"YES":"NO";
                                print('<tr class = "sub-category"><td><a type="button" class="modal-btn modal-btn-1" data-id='.$sub_id.'><i class="fa fa-pencil"></i></a></td><td>'.$sub_category.'</td><td>'.$sub_display.'</td><td><a href="index.php?delete=sub-category&id='.$sub_id.'"><i class="fa fa-remove"></i></a></td></tr>');
                            }
                        }else{
                            echo "NO RESULTS FOR SUB-CATEGORIES";
                        }
                        $categoryNo++;
                    }
                }else{
                    echo "NO RESULTS FOR CATEGORIES";
                }
				?>
			</tbody>
		</table>
		</div>
		<div class="col-md-8 bg-light">
		<h5>Offices & Support</h5>
		<table class="table table-bordered">
			<thead>
				<th></th><th>Office Name</th><th>City</th><th>State</th><th>Pincode</th><th>Display</th><th></th>
			</thead>
			<tbody>
					<?php
                    $office_query = "select * from addresses";
                    $office_result = mysqli_query($conn, $office_query);
                    if(mysqli_num_rows($office_result) > 0){
                        $addressNo = 1;
                        while($office_row = mysqli_fetch_assoc($office_result)){
                            $address_id = $office_row['address_id'];
                            $office_name = $office_row['office_name'];
                            $city_name = $office_row['city_name'];
                            $state_name = $office_row['state'];
                            $pincode = $office_row['pin_code'];
                            $display = $office_row['display'];
                            $display = ($display)?"YES":"NO";
                            print('<tr><td><a type="button" class="modal-btn modal-btn-2" data-id='.$address_id.'><i class="fa fa-pencil"></i></a></td><td>'.$office_name.'</td><td>'.$city_name.'</td><td>'.$state_name.'</td><td>'.$pincode.'</td><td>'.$display.'</td><td><a href="index.php?delete=address&id='.$address_id.'"><i class="fa fa-remove"></i></a></td></tr>');
                        }
                    }else{
                        echo "NO RESULTS FOR OFFICES";
                    }
					?>
			</tbody>
		</table>
        <h5>Customer Service Timings</h5>
        <table class="table table-bordered">
                    <thead><th></th><th>Day</th><th>Working Hours</th><th>Display</th><th></th></thead>
                    <tbody>
                    <?php
                        $timing_query = "select * from timings";
                        $timing_result = mysqli_query($conn, $timing_query);
                        if(mysqli_num_rows($timing_result)>0){
                            while($timing_row = mysqli_fetch_assoc($timing_result)){
                                $timing_id = $timing_row['timing_id'];
                                $day = $timing_row['day'];
                                $working_hours = $timing_row['time_range'];
                                $display = $timing_row['display'];
                                $display = ($display)?"YES":"NO";
                                print('<tr><td><a type="button" class="modal-btn modal-btn-3" data-id='.$timing_id.'><i class="fa fa-pencil"></i></a></td><td>'.$day.'</td><td>'.$working_hours.'</td><td>'.$display.'</td><td><a href="index.php?delete=timing&id='.$timing_id.'"><i class="fa fa-remove"></i></a></td></tr>');
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
    <script type='text/javascript' src="includes/modals.js"></script>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</html>
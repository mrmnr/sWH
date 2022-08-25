<?php include "./includes/_conn.php"; ?>
<?php
if(isset($_POST['cat_id'])){//for editing categories
    $cat_id = $_POST['cat_id'];
    $sql_query = "select * from categories where `cat_id` = $cat_id";
    $query_result = mysqli_query($conn, $sql_query);
    if(mysqli_num_rows($query_result)>0){
        $row = mysqli_fetch_assoc($query_result);
        $category_name = $row['category'];
        $parent_id = $row['parent'];
        $display = $row['display'];
        $parent_query = "select * from categories where `cat_id` = $parent_id";
        $parent_result = mysqli_query($conn, $parent_query);
        if(mysqli_num_rows($parent_result)>0){
            $parent_name = mysqli_fetch_assoc($parent_result)['category'];
        }else{
            $parent_name = "NONE";
        }
        
        $response = '<div class="container-fluid">
            <div class="row padding">
                <div class="col-12">
                    <form action="index.php?edit=success" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="cat_id" class="form-control col-12" value="'.$cat_id.'"><br>
                            <p>Category</p>
                            <input type="text" name="new_category" id="new_category" class="form-control" value="'.$category_name.'"><br>';
                            if($parent_id){
                            $response = $response . '<p>Parent</p>
                                                     <select class="form-control" id="new_parent" name="new_parent" value="'.$parent_name.'">
                                                     <option value="0">Make Parent</option>';
                                $parents_query = "select * from categories where parent = 0";
                                $parents_result = mysqli_query($conn, $parents_query);
                                if(mysqli_num_rows($parents_result)>0){
                                    while($row = mysqli_fetch_assoc($parents_result)){
                                        $new_parent_id = $row['cat_id'];
                                        $parent = $row['category'];
                                        $default_value = '';
                                        if($new_parent_id == $parent_id){
                                            $default_value = "selected";
                                        }
                                        $response = $response . '<option value="'.$new_parent_id.'" '.$default_value.'>'.$parent.'</option>';
                                    }
                                  }
                                  $response = $response . '</select>';
                                }
                                $response = $response . '<br><p>Display</p>
                                <select class="form-control" id="new_display" name="new_display" value="'.$display.'">
                            <option value='.$display.'>Display</option>';
                            if($display){
                                $response = $response . '<option value="0">No</option>
                                                         <option value="1" selected>Yes</option>
                                                         </select>';
                            }else{
                                $response = $response . '<option value="0" selected>No</option>
                                                         <option value="1">Yes</option>
                                                         </select>';
                            }
                                $response = $response . '<br><div class="text-right"><input type="submit" name="edit_category" value="Update" class="btn btn-secondary padding"></div>
                            </div>
                    </form>
                </div>
            </div>
        </div>';
    }else{
        echo "NO RESULTS";
    }
    echo $response;
    exit;
}

if(isset($_POST['add_id'])){//for editing office addresses
    $add_id = $_POST['add_id'];
    $add_query = "select * from addresses where `address_id` = $add_id";
    $add_result = mysqli_query($conn, $add_query);
    $add_array = mysqli_fetch_assoc($add_result);
    $office_name = $add_array['office_name'];
    $city_name = $add_array['city_name'];
    $state_name = $add_array['state'];
    $pincode = $add_array['pin_code'];
    $display = $add_array['display'];
    $response = '<div class="container-fluid">
            <div class="row padding">
                <div class="col-12">
                    <form action="index.php?edit=success" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="add_id" class="form-control" value="'.$add_id.'"><br>
                            <p>Office</p>
                            <input type="text" name="new_office" id="new_office" class="form-control" value="'.$office_name.'"><br>
                            <p>City</p>
                            <input type="text" name="new_city" id="new_city" class="form-control" value="'.$city_name.'"><br>
                            <p>State</p>
                            <input type="text" name="new_state" id="new_state" class="form-control" value="'.$state_name.'"><br>
                            <p>Pincode</p>
                            <input type="text" name="new_pincode" id="new_pincode" class="form-control" value="'.$pincode.'"><br>
                            <p>Display</p>
                            <select class="form-control" id="new_display" name="new_display" value="'.$display.'">
                            <option value='.$display.'>Display</option>';
                            if($display){
                                $response = $response . '<option value="0">No</option>
                                                         <option value="1" selected>Yes</option>
                                                         </select>';
                            }else{
                                $response = $response . '<option value="0" selected>No</option>
                                                         <option value="1">Yes</option>
                                                         </select>';
                            }
                            $response = $response . '<br><div class="text-right"><input type="submit" name="edit_address" value="Update" class="btn btn-secondary padding"></div>
                            </div>
                    </form>
                </div>
            </div>
        </div>';

echo $response;
}
if(isset($_POST['timing_id'])){//for editing timing and schedules
    $timing_id = $_POST['timing_id'];
    $time_query = "select * from timings where `timing_id` = $timing_id";
    $time_result = mysqli_query($conn, $time_query);
    $time_array = mysqli_fetch_assoc($time_result);
    $day = $time_array['day'];
    $time_range = $time_array['time_range'];
    $display = $time_array['display'];
    $response = $day.'<br>'.$time_range.'<br>'.$display;
    $response = '<div class="container-fluid">
            <div class="row padding">
                <div class="col-12">
                    <form action="index.php?edit=success" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="timing_id" class="form-control" value="'.$timing_id.'"><br>
                            <p>Day(s)</p>
                            <input type="text" name="new_day" id="new_day" class="form-control" value="'.$day.'"><br>
                            <p>Active Time</p>
                            <input type="text" name="new_time_range" id="new_time_range" class="form-control" value="'.$time_range.'"><br>
                            <p>Display</p>
                            <select class="form-control" id="new_display" name="new_display" value="'.$display.'">
                            <option value='.$display.'>Display</option>';
                            if($display){
                                $response = $response . '<option value="0">No</option>
                                                         <option value="1" selected>Yes</option>
                                                         </select>';
                            }else{
                                $response = $response . '<option value="0" selected>No</option>
                                                         <option value="1">Yes</option>
                                                         </select>';
                            }
                            $response = $response . '<br><div class="text-right"><input type="submit" name="edit_timing" value="Update" class="btn btn-secondary padding"></div>
                            </div>
                    </form>
                </div>
            </div>
        </div>';

echo $response;
}
?>
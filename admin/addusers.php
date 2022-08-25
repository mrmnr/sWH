<?php include "./includes/_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./includes/head.php"; ?>
    <title>Add and Edit Users</title>
    <style>
        .add-user-form{
            margin-left: 15vw;
            margin-right: 15vw;
            width: 70vw;
            background-color: #f3f3f3;
            padding: 2px;
        }
        .form-group{
            width: 100%;
        }
        #add-user-btn{
            margin: 5px;
        }
    </style>
</head>
<body>
    <?php include "./logincheck.php"; ?>
    <?php 
        if(isset($_POST['add-user'])){
            $full_name = $_POST['name'];
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];
            $access = $_POST['access'];
            $add_query = "insert into admins (`full_name`, `email`, `pwd`, `access`) values ('$full_name', '$email', '$pwd', $access)";
            $result = mysqli_query($conn, $add_query);
            if($result===true) echo "Done";
            else echo mysqli_error($conn);
            
        }
    ?>
    <?php include "./includes/header.php"; ?>
    <br><br><br><br><br><br>
    <?php 
          $admin_id = $_SESSION['admin_id'];
          $privilege_query = "select * from admins where `admin_id` = ".$admin_id;
          $current_user_privilege = mysqli_fetch_assoc(mysqli_query($conn, $privilege_query))['access'];
          if($privilege>=3){ ?>
    <h2 class="text-center">Add/Edit Admin Information</h2>
	<br><br><br><br><br><br>       
    <h4 class="text-center">Registered Admins</h4>
    <table class="table table-bordered text-center">
	<thead>
		<th></th><th>Admin Name</th><th>Email</th><th>Privileges</th><th></th>
	</thead>
	<tbody>
            <?php  
              $admin_query = "select * from admins";
              $admin_result = mysqli_query($conn, $admin_query);
              if(mysqli_num_rows($admin_result) > 0){
                  while($row = mysqli_fetch_assoc($admin_result)){
                      $admin_id = $row['admin_id'];
                      $admin_name = $row['full_name'];
                      $admin_email = $row['email'];
                      $admin_pwd = $row['pwd'];
                      $admin_access = $row['access'];
                      if($admin_access==3){
                          $admin_access = "Super User";
                      }else if($admin_access==2){
                          $admin_access = "Simple User";
                      }else if($admin_access==1){
                          $admin_access = "Read-Only Access";
                      }?>
                    <tr><td></td><td><?= $admin_name?></td><td><?= $admin_email?></td><td><?= $admin_access ?></td><td></td></tr>

   <?php          }
              }

          }else{ ?>
                <div class="text-center text-danger">
                    <p>You are not authorized to access this page</p>
                    <a href="index.php">Back to Homepage</a>
                </div>
   <?php   }
      ?>
    </tbody>
	</table>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <?php if($current_user_privilege>=3){ ?>
    <div class="add-user-form">
        <h4 class="text-center">Add New Admin</h4>
    <form class="form" action="addusers.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Full Name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="pwd" placeholder="Password">
        </div>
        <div class="form-group">
                <select class="form-control" name="access">
                    <option value="3">Super User</option>
                    <option value="2">Simple User</option>
                    <option value="1">ReadOnly Access</option>
                </select>
        </div>
        
        <div class="text-right">
            <button id="add-user-btn" type="submit" class="btn btn-secondary mb-2" name="add-user">Add User</button>
        </div>
</form>
    </div>
    <br><br><br>
<?php } ?>
    <footer class="footer text-center">All Rights Reserved</footer>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</body>
</html>
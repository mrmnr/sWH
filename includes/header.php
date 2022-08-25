<header>
    <div class="menu-bar">
        <nav class="navbar navbar-expand-md navbar-dark sticky-top fixed">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
              <!--     <img class="logo" alt="Logo" src="img/etlogo.png">-->
                 <span style="color: black;">E_T >></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <!--<span class="navbar-toggler-icon"></span>-->
                    <i class="fa fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php if($page=="home") echo "current-page"; ?>" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown" id="product-menu">
                            <a class="nav-link dropdown-toggle <?php if($page=="products") echo "current-page"; ?>" href="notAvailable.php" data-toggle="dropdown">Products<span class="caret"></span></a>
                            <div class="dropdown-menu mega-menu" aria-labelledby="dropdownMenuButton" style="background-color: #f6f6f6!important;width:calc(50vw); position: absolute; left: -300px;  box-shadow: 2px 2px #f3f3f3;  ">
                                                <div class="container-fluid" style="background-color: #f6f6f6!important; width: 100%; ">
                                                    <div class="row text-center" style="background-color: #f6f6f6!important">
                                                <?php
                                                        $sql_query = "select * from categories where `parent` = 0 and `display` = 1";
                                                        $query_result = mysqli_query($conn, $sql_query);
                                                        if(mysqli_num_rows($query_result)>0){
                                                            while($row = mysqli_fetch_assoc($query_result)){
                                                                $category = $row['category'];
                                                                $cat_id = $row['cat_id'];
                                                ?>
                                                                <div class="col-md-6 menu-items text-left">
                                                                <a class="no-style-links" href="products.php?category=<?= $cat_id?>"><h4><?= $category ?></h4></a>
                                                                    <div class="mega-menu-list">
                                                                        <?php $sub_query = "select * from categories where `parent` = $cat_id and `display` = 1";
                                                                                $sub_result = mysqli_query($conn, $sub_query);
                                                                                while($row = mysqli_fetch_assoc($sub_result)){
                                                                                    $cat_id = $row['cat_id'];
                                                                                    $sub_category = $row['category']; ?>
                                                                                    <p class="mega-menu-list-item" style="padding-left: 20px;padding-right: 30px; "><a class="no-style-links" href="products.php?category=<?= $cat_id?>"><?= $sub_category ?></a></p>
                                                                <?php        } ?>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        }
                                                        ?>
                                                            </div>
                                                </div>
                            </div>
                        </li>
                        <div id="smaller-product-menu">
                        <?php 
                            include "includes/init.php";
                            $sql_query = "select * from categories where `parent` = 0 and `display` = 1";
                            $query_result = mysqli_query($conn, $sql_query);
                            if(mysqli_num_rows($query_result)>0){
                                while($row = mysqli_fetch_assoc($query_result)){
                                    $category = $row['category'];
                                    $cat_id = $row['cat_id']; ?>
                                    <li class="nav-item dropdown" id="user-menu">
                                    <a class="nav-link dropdown-toggle" href="products.php?category=<?= $cat_id?>" data-toggle="dropdown"><?= $category?><span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                    <?php
                                        $sql_query = "select * from categories where `parent` = $cat_id and `display` = 1";
                                        $sub_query_result = mysqli_query($conn, $sql_query);
                                        if(mysqli_num_rows($sub_query_result)>0){
                                            while($row = mysqli_fetch_assoc($sub_query_result)){
                                                $sub_category = $row['category'];
                                                $cat_id = $row['cat_id']; ?>
                                                    <li><a class="dropdown-item" href="products.php?category=<?= $cat_id ?>"><?= $sub_category?></a></li>
                                            <?php
                                            }
                                        }else{
                                            echo "No results for sub-categories";
                                        } ?>
                                    </ul>
                                </li>

                          <?php      }
                            }else{
                                echo "No results for categories";
                            }
                        ?>
                        </div>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php if($page=="about") echo "current-page"; ?>" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($page=="contact") echo "current-page"; ?>" href="contact.php">Contacts</a>
                        </li>
            <?php if(isset($_SESSION['customer_id'])){
                $result = mysqli_query($conn, "select * from customers where `customer_id` = ".$_SESSION['customer_id']);
                $row = mysqli_fetch_assoc($result);
                $customer_name = $row['full_name']; ?>
                          <div id="logoutandchangepwd">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><?= $customer_name?><span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                                    <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                                                    <li><a class="dropdown-item" href="password.php">Change Password</a></li>
                                    </ul>
                                </li>
                         </div>
            <?php }else{ ?>
                <a class="nav-link" href="login.php">Login</a>
           <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

<nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="./index.php">Admin Panel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Categories</a>
      </li>
      <li class="nav-item dropdown">
        <div class="dropdown">
          <a style="cursor:pointer;" class="dropdown-toggle nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Product Tags
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <table class="table text-center">
                <?php
                  $tag_query = "select * from tags";
                  $result = mysqli_query($conn, $tag_query);
                  if(mysqli_num_rows($result)>0){
                    $elem = 0;
                    $numCols = 6;
                    while($row = mysqli_fetch_assoc($result)){
                      $tag_id = $row['tag_id'];
                      $tag = $row['tag'];
                      if($elem%$numCols==0) print('<tr><td><a href="#" class="nav-link">'.$tag.'</a></td>');
                      else if($elem%$numCols==$numCols-1) print('<td><a href="#" class="nav-link">'.$tag.'</a></td></tr>');
                      else print('<td><a href="#" class="nav-link">'.$tag.'</a></td>');
                      $elem++;
                    }
                  }
                  ?>
                </table>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="purchases.php">Purchases</a>
      </li>
      <?php 
        if(isset($_SESSION['admin_id'])){
          $admin_id = $_SESSION['admin_id'];
          $privilege_query = "select * from admins where `admin_id` = ".$admin_id;
          $privilege = mysqli_fetch_assoc(mysqli_query($conn, $privilege_query))['access'];
          if($privilege==3){ ?>
              <li id="addusers-btn">
                  <a class="nav-link" href="addusers.php">Add Users</a>
              </li>
   <?php  }

        }
      ?>
      <style>
      @media only screen and (min-width: 768px){
            #logout-btn{
              position:absolute; right: 10px;
            }
            #addusers-btn{
              position:absolute;
              right: 100px;
            }
      }
      </style>
      <li id="logout-btn">
          <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
        
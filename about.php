<?php include "./includes/_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./includes/head.php"; ?>
    <title>About</title>
</head>
<body>
    <?php $page="about"; include "./includes/header.php"; ?>

<br><br><br><br><br>

<div class="text-center text-success">
    <h2>About Page</h2>
</div>






    <br><br><br><br><br>

    <?php include "./includes/footer.php" ?>
        <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</html>
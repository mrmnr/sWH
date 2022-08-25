<?php include "./includes/_conn.php"; ?>
<?php
    session_start();
    session_destroy();
    header('Location: index.php');
exit();
?>